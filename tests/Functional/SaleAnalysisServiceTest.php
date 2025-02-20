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

        $this->SaleAnalysis = new SaleAnalysisService($this->SaleRepository , $this->SaleItemRepository , 1);

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

    private function InsertSaleDataInDB(array $saleOption = []) : int
    {
        $saleData = [
            'user_id' => 1,
            'customer_name' => 'John Doe',
            'customer_phone' => '09123456789',
            'total_price' => 1000,
            'sale_date' => date('Y-m-d' , '1739118671')
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
            'sale_date' => date('Y-m-d' , '1739118671')
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
