<?php 
namespace Tests\Functional;

use App\Config\config;
use App\Interfaces\SaleAnalysisServiceInterface;
use App\Interfaces\SaleInterface;
use App\Interfaces\SaleItemInterface;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Repositories\SaleItemRepository;
use App\Repositories\SaleRepository;
use App\Services\SaleAnalysisService;
use App\Services\SalePriceService;
use PDO;
use PHPUnit\Framework\TestCase;

class SaleAnalysisServiceTest extends TestCase
{
    private SaleAnalysisServiceInterface $SaleAnalysis;
    private SaleInterface $SaleRepository;
    private SaleItemInterface $SaleItemRepository;
    private PDO $connection;

    public function setUp() : void
    {
        $db_config = $this->getConfig();

        // Establishing DB connection
        $this->connection = new PDO("mysql:host={$db_config['host']};dbname={$db_config['dbname']}", $db_config['username'], $db_config['password']);

        $this->SaleItemRepository = new SaleItemRepository(new SaleItem($this->connection));
        $this->SaleRepository = new SaleRepository(new Sale($this->connection));

        $this->SaleAnalysis = new SaleAnalysisService($this->SaleRepository , $this->SaleItemRepository , new SalePriceService($this->SaleRepository), 1);

        // Start a single transaction for all repositories
        $this->connection->beginTransaction();

        parent::setUp();
    }

    public function test_method_getProfit_should_return_sale_profit_with_int()
    {
        $sale_id = $this->InsertSaleDataInDB();
        $this->InsertSaleItemDataInDB(['sale_id' => $sale_id , 'cost_price' => 400]);
        $this->InsertSaleItemDataInDB(['sale_id' => $sale_id , 'cost_price' => 300]);
        
        $profit = $this->SaleAnalysis->getProfit($sale_id);

        $this->assertIsInt($profit);
        $this->assertNotNull($profit);
        $this->assertEquals(300 , $profit);
    }

    public function test_method_getProfit_should_return_null_when_sale_not_found()
    {
        $profit = $this->SaleAnalysis->getProfit(1111111);

        $this->assertNull($profit);
    }

    public function test_method_getProfit_should_return_null_when_no_sale_items()
    {
        $sale_id = $this->InsertSaleDataInDB(); // Inserting sale but no sale items
        $profit = $this->SaleAnalysis->getProfit($sale_id);

        $this->assertNull($profit);  // Should return null if no sale items are associated
    }

    public function test_method_getTotalProfit_should_return_total_profit_with_int()
    {
        $this->InsertSaleItemDataInDB(['cost_price' => 200, 'sell_price' => 500]);
        $this->InsertSaleItemDataInDB(['cost_price' => 300, 'sell_price' => 700]);

        $profit = $this->SaleAnalysis->getTotalProfit(7);

        $this->assertIsInt($profit);
        $this->assertEquals(700, $profit); // Based on total price - cost price
    }

    public function test_method_getTotalProfit_should_return_null_when_no_sale_items()
    {
        $profit = $this->SaleAnalysis->getTotalProfit(1);
        $this->assertNull($profit); // No sales, so profit should be null
    }

    public function test_method_getBestSale_should_return_best_sale()
    {
        $this->InsertSaleDataInDB(['total_price' => 1000]);
        $this->InsertSaleDataInDB(['total_price' => 2000]);

        $bestSale = $this->SaleAnalysis->getBestSale();

        $this->assertNotNull($bestSale);
        $this->assertEquals(2000, $bestSale->total_price);
    }

    public function test_method_getBestSale_should_return_null_when_no_sales()
    {
        // No sales inserted
        $bestSale = $this->SaleAnalysis->getBestSale();
        $this->assertNull($bestSale);  // No best sale should be returned
    }

    public function test_method_getBestSellingProduct_should_return_best_selling_product()
    {
        $this->InsertSaleItemDataInDB(['quantity' => 10, 'sell_price' => 300]);
        $this->InsertSaleItemDataInDB(['quantity' => 5, 'sell_price' => 200]);

        $bestSellingProduct = $this->SaleAnalysis->getBestSellingProduct();

        $this->assertNotNull($bestSellingProduct);
        $this->assertEquals('product name test', $bestSellingProduct->product_name);
    }

    public function test_method_getBestSellingProduct_should_return_null_when_no_sale_items()
    {
        // No sale items inserted
        $bestSellingProduct = $this->SaleAnalysis->getBestSellingProduct();
        $this->assertNull($bestSellingProduct);  // No best selling product should be returned
    }

    public function test_method_getBestCustomer_should_return_best_customer()
    {
        $this->InsertSaleDataInDB(['customer_name' => 'John Doe', 'total_price' => 1000]);
        $this->InsertSaleDataInDB(['customer_name' => 'Jane Smith', 'total_price' => 1500]);

        $bestCustomer = $this->SaleAnalysis->getBestCustomer();

        $this->assertNotNull($bestCustomer);
        $this->assertEquals('Jane Smith', $bestCustomer->customer_name);
    }

    public function test_method_getBestCustomer_should_return_null_when_no_customers()
    {
        // No customer sales inserted
        $bestCustomer = $this->SaleAnalysis->getBestCustomer();
        $this->assertNull($bestCustomer);  // No best customer should be returned
    }

    private function InsertSaleDataInDB(array $saleOption = []) : int
    {
        $saleData = [
            'user_id' => 1,
            'customer_name' => 'John Doe',
            'customer_phone' => '09123456789',
            'total_price' => 1000,
            'sale_date' => date('Y-m-d' , time())
        ];

        $saleData = array_merge($saleData, $saleOption);

        return $this->SaleRepository->create($saleData);
    }

    private function InsertSaleItemDataInDB(array $saleItemOption) : void
    {
        $saleItemData = [
            'user_id' => 1,
            'sale_id'        => 1,
            'product_id'  => 1,
            'product_name' => 'product name test',
            'quantity' => 1,
            'cost_price'    => 200,
            'sell_price'    => 300,
            'total_price'      => 600,
            'sale_date' => date('Y-m-d' , time())
        ];

        $saleItemData = array_merge($saleItemData , $saleItemOption);

        $this->SaleItemRepository->create($saleItemData);
    }

    private function getConfig() : array 
    {
        return (config::get('database.SM_DB_TEST'));
    }

    public function tearDown() : void
    {
        // Rollback the transaction to ensure no data is persisted
        $this->connection->rollBack();

        parent::tearDown();
    }
}
