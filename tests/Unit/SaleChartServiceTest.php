<?php 
namespace Tests\Unit;

use App\Services\SaleChartService;
use App\Repositories\SaleRepository;
use PHPUnit\Framework\TestCase;
use Mockery;

class SaleChartServiceTest extends TestCase
{
    private SaleChartService $saleChartService;
    private SaleRepository $saleRepository;
    private $saleRepoMock;

    protected function setUp(): void
    {
        parent::setUp();

        $this->saleRepository = $this->createMock(SaleRepository::class);
        $this->saleChartService = new SaleChartService($this->saleRepository, 1);
        $this->saleRepoMock = Mockery::mock(SaleRepository::class);
    }

    public function testGetTotalSalePriceWeekAgoWithValidData(): void
    {
        $salesMock = [
            (object)['total_price' => 100],
            (object)['total_price' => 200]
        ];

        $this->saleRepository->expects($this->exactly(8)) 
            ->method('findAll')
            ->willReturn($salesMock);

        $result = $this->saleChartService->getTotalSalePriceWeekAgo(7);

        $this->assertNotEmpty($result);
        $this->assertCount(8, $result['labels']);
        $this->assertCount(8, $result['data']);
        $this->assertEquals(300, $result['data'][0]);
    }

    public function testGetTotalSalePriceWeekAgoWithNoData(): void
    {

        $this->saleRepository->expects($this->exactly(8)) 
            ->method('findAll')
            ->willReturn([]);

        $result = $this->saleChartService->getTotalSalePriceWeekAgo(7);


        $this->assertNotEmpty($result);
        $this->assertCount(8, $result['labels']);
        $this->assertCount(8, $result['data']);
        $this->assertEquals(0, $result['data'][0]);
    }

    public function testGetTotalSalePriceYearAgoWithNoData()
    {
        $this->saleRepoMock->shouldReceive('findSalesByMonth')
            ->once()
            ->andReturn(null);


        $service = new SaleChartService($this->saleRepoMock, 1);

        $result = $service->getTotalSalePriceYearAgo();

        $this->assertNotEmpty($result);
        $this->assertCount(12, $result['labels']);
        $this->assertCount(12, $result['data']);
        $this->assertEquals(0, $result['data'][0]); 
    }

    public function testGetTotalSalePriceYearAgoWithValidData()
    {

        $this->saleRepoMock->shouldReceive('findSalesByMonth')
            ->once()
            ->andReturn([
                (object) ['total_price' => 100],
                (object) ['total_price' => 200]
            ]);

        $service = new SaleChartService($this->saleRepoMock, 1);

        $result = $service->getTotalSalePriceYearAgo();

        $this->assertNotEmpty($result);
        $this->assertCount(12, $result['labels']);
        $this->assertCount(12, $result['data']);
        $this->assertEquals(300, $result['data'][0]);
    }
    
}

