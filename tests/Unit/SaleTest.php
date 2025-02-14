<?php 

namespace Tests\Unit;

use App\Models\Sale;
use PHPUnit\Framework\TestCase;
use App\Repositories\SaleRepository;
use PDO;
use App\Config\config;


class SaleTest extends TestCase
{
    private SaleRepository $SaleRepository;

    public function setUp() : void
    {
        $db_config = $this->getConfig();

        $connection = new PDO("mysql:host={$db_config['host']};dbname={$db_config['dbname']}", $db_config['username'], $db_config['password']);

        $this->SaleRepository = new SaleRepository(new Sale($connection));

        $this->SaleRepository->beginTransaction();

        parent::setUp();
    }

    public function test_method_create_should_return_int()
    {
        $result = $this->InsertDataInDB();

        $this->assertIsInt($result);
        $this->assertGreaterThan(0, $result);

    }

    public function test_method_create_should_return_int_with_null_phone()
    {
        $result = $this->InsertDataInDB(['customer_phone' => null]);

        $this->assertIsInt($result);
        $this->assertGreaterThan(0, $result);
    }

    public function test_method_findById_should_return_object() 
    {
        $id = $this->InsertDataInDB();

        $result = $this->SaleRepository->findById($id);

        $this->assertIsObject($result);
        $this->assertEquals($id, $result->id);
    }

    public function test_method_findById_should_return_null_when_sale_not_found() 
    {
        $result = $this->SaleRepository->findById(999999);

        $this->assertNull($result);
    }

    public function test_method_findAll_should_return_array_of_objects() 
    {
        $this->InsertDataInDB();
        $this->InsertDataInDB();
        $this->InsertDataInDB();

        $result = $this->SaleRepository->findAll(1);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);
        $this->assertIsObject($result[0]);
        $this->assertCount(3, $result);
    }

    public function test_method_findAll_should_return_null_when_no_sale_found() 
    {
        $result = $this->SaleRepository->findAll(1);

        $this->assertNull($result);
    }

    public function test_method_delete_should_return_true() 
    {
        $id = $this->InsertDataInDB();

        $result = $this->SaleRepository->delete($id);

        $this->assertTrue($result);
    }

    public function test_method_delete_should_return_false_when_sale_not_found() 
    {
        $result = $this->SaleRepository->delete(999999);

        $this->assertFalse($result);
    }

    public function test_method_search_can_return_product_data()
    {
        $this->InsertDataInDB();
        $this->InsertDataInDB(['customer_name' => 'John Doe test 2']);
        $this->InsertDataInDB(['customer_name' => 'John Doe test dkem']);
        $this->InsertDataInDB(['customer_name' => 'John Doe test 23']);
        $this->InsertDataInDB(['customer_name' => 'John Doe 43']);

        $result1 = $this->SaleRepository->search(['customer_name' => 'John Doe' , 'user_id' => 1]);
        $result2 = $this->SaleRepository->search(['customer_name' => 'John Doe test', 'user_id' => 1]);
        $result3 = $this->SaleRepository->search(['customer_name' => 'John Doe 43', 'user_id' => 1]);

        $this->assertNotNull($result1);
        $this->assertNotNull($result2);
        $this->assertNotNull($result3);


        $this->assertIsArray($result1);
        $this->assertIsArray($result2);
        $this->assertIsArray($result3);

        $this->assertCount(5, $result1);
        $this->assertCount(3, $result2);
        $this->assertCount(1, $result3);
    }

    public function test_method_search_can_return_null_if_no_product_found()
    {
        $result = $this->SaleRepository->search(['customer_name' => 'Test John Doe 43', 'user_id' => 1]);

        $this->assertNull($result);
    }

    public function test_method_sortByPrice_should_return_array()
    {   
        $this->InsertDataInDB();
        $this->InsertDataInDB(['total_price' => 800]);
        $this->InsertDataInDB(['total_price' => 1200]);
        $this->InsertDataInDB(['total_price' => 44444]);
        $this->InsertDataInDB(['total_price' => 233]);


        $result = $this->SaleRepository->sortByPrice(1,'ASC');
        $result2 = $this->SaleRepository->sortByPrice(1,'DESC');

        $this->assertNotNull($result);
        $this->assertIsArray($result);
        $this->assertCount(5,$result);
        $this->assertEquals(233,$result[0]->total_price);
        $this->assertEquals(44444,$result2[0]->total_price);
    }

    public function test_method_sortByPrice_should_return_null_when_sale_not_found()
    {
        $result = $this->SaleRepository->sortByPrice(1,'ASC');

        $this->assertNull($result);
    }


    public function test_method_sortByDate_should_return_array()
    {
        $this->InsertDataInDB();
        $this->InsertDataInDB(['sale_date' => date('Y-m-d' , '1739198671')]);
        $this->InsertDataInDB(['total_price' => 300 , 'sale_date' => date('Y-m-d' , '1719112671')]); //k
        $this->InsertDataInDB(['sale_date' => date('Y-m-d' , '1739118641')]);
        $this->InsertDataInDB(['total_price' => 200 , 'sale_date' => date('Y-m-d' , '1759128671')]);//z


        $result = $this->SaleRepository->sortByDate(1,'ASC');
        $result2 = $this->SaleRepository->sortByDate(1,'DESC');


        $this->assertNotNull($result);
        $this->assertIsArray($result);
        $this->assertCount(5,$result);
        $this->assertEquals(300,$result[0]->total_price);
        $this->assertEquals(200,$result2[0]->total_price);
    }

    public function test_method_sortByDate_should_return_null_when_sale_not_found()
    {
        $result = $this->SaleRepository->sortByDate(1,'ASC');

        $this->assertNull($result);
    }


    public function test_method_sortByPhoneNumber_should_return_array()
    {
        $this->InsertDataInDB();
        $this->InsertDataInDB();
        $this->InsertDataInDB(['customer_phone' => null]);


        $result = $this->SaleRepository->sortByPhoneNumber(1);

        $this->assertIsArray($result);
        $this->assertCount(2,$result);
        // $this->assertEquals(09123456789, $result[0]->customer_phone);
    }


    public function test_method_sortByPhoneNumber_should_return_null_when_sale_not_found()
    {
        $result = $this->SaleRepository->sortByPhoneNumber(11111);

        $this->assertNull($result);
    }

    
    private function InsertDataInDB(array $option = []) : int
    {
        $data = [
            'user_id' => 1,
            'customer_name' => 'John Doe',
            'customer_phone' => '09123456789',
            'total_price' => 1000,
            'sale_date' => date('Y-m-d' , '1739118671')
        ];

        $data = array_merge($data, $option);

        return $this->SaleRepository->create($data);
    }

    private function getConfig() : array 
    {
        return (config::get('database.SM_DB_TEST'));
    }


    public function tearDown() : void
    {
        $this->SaleRepository->rollBack();

        parent::tearDown();
    }
}