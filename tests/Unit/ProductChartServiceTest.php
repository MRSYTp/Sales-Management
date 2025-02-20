<?php 

namespace Tests\Unit;

use Mockery;
use App\Services\ProductChartService;
use App\Interfaces\SaleItemInterface;
use PHPUnit\Framework\TestCase;

class ProductChartServiceTest extends TestCase
{
    private $saleItemRepoMock;

    protected function setUp(): void
    {
        $this->saleItemRepoMock = Mockery::mock(SaleItemInterface::class);
    }

    public function testGetPercentageProductBySaleWithNoData()
    {
        $this->saleItemRepoMock->shouldReceive('sortBySale')
            ->once()
            ->andReturn(null); 

        $service = new ProductChartService($this->saleItemRepoMock, 1);

        $result = $service->getPercentageProductBySale();

        $this->assertNull($result);
    }

    public function testGetPercentageProductBySaleWithValidData()
    {
        $salesData = [
            (object) ['product_name' => 'Product 1', 'total_quantity' => 100],
            (object) ['product_name' => 'Product 2', 'total_quantity' => 200],
            (object) ['product_name' => 'Product 3', 'total_quantity' => 300],
            (object) ['product_name' => 'Product 4', 'total_quantity' => 400],
            (object) ['product_name' => 'Product 5', 'total_quantity' => 500],
            (object) ['product_name' => 'Product 6', 'total_quantity' => 600],
        ];

        $this->saleItemRepoMock->shouldReceive('sortBySale')
            ->once()
            ->andReturn($salesData);

        $service = new ProductChartService($this->saleItemRepoMock, 1);

        $result = $service->getPercentageProductBySale();

        $this->assertNotNull($result);
        $this->assertCount(6, $result['labels']);
        $this->assertEquals('دیگر', end($result['labels']));
        $this->assertEquals(100, array_sum($result['data']));
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }
    
}
