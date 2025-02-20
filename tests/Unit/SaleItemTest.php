<?php 

namespace Tests\Unit;
use PHPUnit\Framework\TestCase;
use App\Interfaces\SaleItemInterface;
use App\Repositories\SaleItemRepository;
use App\Config\config;
use App\Models\SaleItem;
use PDO;

class SaleItemTest extends TestCase
{
    private SaleItemInterface $SaleItemRepository;

    public function setUp() : void
    {
        $db_config = $this->getConfig();

        $connection = new PDO("mysql:host={$db_config['host']};dbname={$db_config['dbname']}", $db_config['username'], $db_config['password']);

        $this->SaleItemRepository = new SaleItemRepository(new SaleItem($connection));

        $this->SaleItemRepository->beginTransaction();

        parent::setUp();
    }


    public function test_method_create_can_insert_saleItem_in_DB_and_return_last_id()
    {
        $result = $this->InsertSaleItemInDB();

        $saleItem = $this->SaleItemRepository->findById($result);


        $this->assertIsInt($result);
        $this->assertNotNull($result);
        $this->assertNotNull($saleItem);
        $this->assertEquals(1,$saleItem->sale_id);
    }

    public function test_method_findById_should_return_object_when_saleItem_found()
    {
        $id = $this->InsertSaleItemInDB();

        $result = $this->SaleItemRepository->findById($id);

        $this->assertIsObject($result);
        $this->assertEquals($id, $result->id);
    }

    public function test_method_findById_should_return_null_when_saleItem_not_found()
    {
        $result = $this->SaleItemRepository->findById(111111);

        $this->assertNull($result);
    }

    public function test_method_findAll_should_return_array_of_objects() 
    {
        $this->InsertSaleItemInDB();
        $this->InsertSaleItemInDB();
        $this->InsertSaleItemInDB();

        $result = $this->SaleItemRepository->findAll(1);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertIsObject($result[0]);
        $this->assertCount(3, $result);
    }

    public function test_method_findAll_should_return_null_when_no_sale_found() 
    {
        $result = $this->SaleItemRepository->findAll(111111);

        $this->assertNull($result);
    }


    

    private function InsertSaleItemInDB(array $option = []) : int 
    {
        $userdata = array_merge([
            'user_id'        => 1,
            'sale_id'        => 1,
            'product_id'  => 1,
            'product_name' => 'product name test',
            'quantity' => 2,
            'cost_price'    => 200,
            'sell_price'    => 300,
            'total_price'      => 600,
            'sale_date'  =>  date('Y-m-d' , '1739118671')

        ], $option);
        
        return $this->SaleItemRepository->create($userdata);
    }

    private function getConfig() : array
    {
        return (config::get('database.SM_DB_TEST'));
    }

    public function tearDown() : void
    {
        $this->SaleItemRepository->rollBack();

        parent::tearDown();
    }
}