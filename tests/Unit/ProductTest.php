<?php 

namespace Tests\Unit;

use App\Models\Product;
use PHPUnit\Framework\TestCase;
use App\Repositories\ProductRepository;
use PDO;
use App\Config\config;

class ProductTest extends TestCase
{
    private ProductRepository $productRepository;

    public function setUp() : void
    {
        $db_config = $this->getConfig();

        $connection = new PDO("mysql:host={$db_config['host']};dbname={$db_config['dbname']}", $db_config['username'], $db_config['password']);

        $this->productRepository = new productRepository(new Product($connection));

        $this->productRepository->beginTransaction();

        parent::setUp();
    }

    public function test_method_create_can_insert_in_db()
    {
        $result = $this->InsertDataInDB();


        $this->assertIsInt($result);
        $this->assertGreaterThan(0, $result);
    }

    public function test_method_find_by_id_can_return_product_data()
    {
        $id = $this->InsertDataInDB();

        $result = $this->productRepository->findById($id);

        $this->assertNotNull($result);
        $this->assertIsObject($result);
        $this->assertEquals('Test Product', $result->name);
    }

    public function test_method_find_by_id_can_return_null_if_product_not_found()
    {
        $result = $this->productRepository->findById(100000);

        $this->assertNull($result);
    }

    public function test_method_findByName_can_return_product_data()
    {
        $this->InsertDataInDB();

        $result = $this->productRepository->findByName('Test Product');

        $this->assertNotNull($result);
        $this->assertIsObject($result);
        $this->assertEquals('Test Product', $result->name);
    }

    public function test_method_findByName_can_return_null_if_product_not_found()
    {
        $result = $this->productRepository->findByName('Test Product1112222221');

        $this->assertNull($result);
    }

    public function test_method_findAll_can_return_all_product_data()
    {
        $this->InsertDataInDB();
        $this->InsertDataInDB(['name' => 'Test Product 2']);

        $result = $this->productRepository->findAll();

        $this->assertNotNull($result);
        $this->assertIsArray($result);
        $this->assertCount(2, $result);
    }

    public function test_method_findAll_can_return_null_if_no_product_found()
    {
        $result = $this->productRepository->findAll();

        $this->assertNull($result);
    }


    public function test_method_search_can_return_product_data()
    {
        $this->InsertDataInDB();
        $this->InsertDataInDB(['name' => 'Test Product 2']);
        $this->InsertDataInDB(['name' => 'Test Product dkem']);
        $this->InsertDataInDB(['name' => 'Test 23']);
        $this->InsertDataInDB(['name' => 'Test Product 43']);

        $result1 = $this->productRepository->search(['name' => 'Test']);
        $result2 = $this->productRepository->search(['name' => 'Test Product']);
        $result3 = $this->productRepository->search(['name' => 'Test Product 43']);

        $this->assertNotNull($result1);
        $this->assertNotNull($result2);
        $this->assertNotNull($result3);


        $this->assertIsArray($result1);
        $this->assertIsArray($result2);
        $this->assertIsArray($result3);

        $this->assertCount(5, $result1);
        $this->assertCount(4, $result2);
        $this->assertCount(1, $result3);
    }

    public function test_method_search_can_return_null_if_no_product_found()
    {
        $result = $this->productRepository->search(['name' => 'Test Product 43']);

        $this->assertNull($result);
    }

    public function test_method_update_can_update_product_data()
    {
        $id = $this->InsertDataInDB();

        $result = $this->productRepository->update($id, ['name' => 'Updated Product']);
        $product = $this->productRepository->findById($id);


        $this->assertTrue($result);
        $this->assertEquals('Updated Product', $product->name);
    }


    public function test_method_update_can_return_false_if_product_not_found()
    {
        $result = $this->productRepository->update(100000, ['name' => 'Updated Product']);

        $this->assertFalse($result);
    }


    public function test_method_delete_can_delete_product_data()
    {
        $id = $this->InsertDataInDB();

        $result = $this->productRepository->delete($id);
        $product = $this->productRepository->findById($id);

        $this->assertTrue($result);
        $this->assertNull($product);
    }

    public function test_method_delete_can_return_false_if_product_not_found()
    {
        $result = $this->productRepository->delete(100000);

        $this->assertFalse($result);
    }

    

    private function InsertDataInDB(array $option = []) : int
    {
        $data = [
            'user_id' => 1,
            'name' => 'Test Product',
            'cost_price' => 100,
            'sell_price' => 200
        ];

        $data = array_merge($data, $option);

        return $this->productRepository->create($data);
    }

    private function getConfig() : array 
    {
        return (config::get('database.SM_DB_TEST'));
    }



    public function tearDown() : void
    {
        $this->productRepository->rollBack();

        parent::tearDown();
    }

}