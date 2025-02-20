<?php 
namespace Tests\Unit;

use App\Services\SalePriceService;
use App\Interfaces\SaleInterface;
use PHPUnit\Framework\TestCase;
use App\Models\Product;

class SalePriceServiceTest extends TestCase
{
    private SalePriceService $salePriceService;
    private SaleInterface $saleRepository;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->saleRepository = $this->createMock(SaleInterface::class);
        $this->salePriceService = new SalePriceService($this->saleRepository);
    }


    public function testTotalCostPriceForProductWithValidData(): void
    {
        $product1 = $this->createMock(Product::class);
        $product1->cost_price = 100;
        $product1->total_quantity = 5;
        $product1->product_name = 'Product 1';

        $products = [$product1];

        $result = $this->salePriceService->TotalCostPriceForProduct($products);

        $this->assertNotNull($result);
        $this->assertCount(1, $result);
        $this->assertEquals('Product 1', $result[0]['product_name']);
        $this->assertEquals(500, $result[0]['total_cost_price']);
    }

    public function testTotalCostPriceForProductWithNullData(): void
    {
        $result = $this->salePriceService->TotalCostPriceForProduct(null);
        $this->assertNull($result);
    }


    public function testTotalSellPriceForProductWithValidData(): void
    {
        $product1 = $this->createMock(Product::class);
        $product1->sell_price = 200;
        $product1->total_quantity = 3;
        $product1->product_name = 'Product 1';

        $products = [$product1];

        $result = $this->salePriceService->TotalSellPriceForProduct($products);

        $this->assertNotNull($result);
        $this->assertCount(1, $result);
        $this->assertEquals('Product 1', $result[0]['product_name']);
        $this->assertEquals(600, $result[0]['total_sell_price']);
    }

    public function testTotalSellPriceForProductWithNullData(): void
    {
        $result = $this->salePriceService->TotalSellPriceForProduct(null);
        $this->assertNull($result);
    }


    public function testGetTotalCostPriceForSaleWithValidData(): void
    {
        $saleItem1 = $this->createMock(Product::class);
        $saleItem1->cost_price = 100;
        $saleItem1->quantity = 5;

        $saleItems = [$saleItem1];

        $result = $this->salePriceService->getTotalCostPriceForSale($saleItems);

        $this->assertNotNull($result);
        $this->assertEquals(500, $result);
    }

    public function testGetTotalCostPriceForSaleWithNullData(): void
    {
        $result = $this->salePriceService->getTotalCostPriceForSale(null);
        $this->assertNull($result);
    }

    public function testGetTotalSellPriceForSaleWithValidSaleId(): void
    {
        $sale = $this->createMock(SaleInterface::class);
        $sale->total_price = 1000;

        $this->saleRepository->expects($this->once())
            ->method('findById')
            ->willReturn($sale);

        $result = $this->salePriceService->getTotalSellPriceForSale(1);

        $this->assertEquals(1000, $result);
    }

    public function testGetTotalSellPriceForSaleWithInvalidSaleId(): void
    {
        $this->saleRepository->expects($this->once())
            ->method('findById')
            ->willReturn(null);

        $result = $this->salePriceService->getTotalSellPriceForSale(999);

        $this->assertNull($result);
    }
}
