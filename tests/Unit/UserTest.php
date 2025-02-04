<?php 

namespace Tests\Unit;

use App\Repositories\UserRepository;
use PDO;
use PHPUnit\Framework\TestCase;
use App\Config\config;
use App\Models\User;

class UserTest extends TestCase
{
    private UserRepository $userRepository;

    public function setUp() : void
    {
        $db_config = $this->getConfig();

        $connection = new PDO("mysql:host={$db_config['host']};dbname={$db_config['dbname']}", $db_config['username'], $db_config['password']);

        $this->userRepository = new UserRepository(new User($connection));

        $this->userRepository->beginTransaction();

        parent::setUp();
    }



    public function test_it_can_create_User()
    {
        
        $result = $this->InsertUserInDB();

        
        $this->assertIsInt($result);
        $this->assertGreaterThan(0, $result);
    }


    public function test_it_cat_get_user_data_by_email()
    {
        $this->InsertUserInDB(['email' => 'dumy@gmail.com']);

        $result = $this->userRepository->findByEmail('dumy@gmail.com');


        $this->assertNotNull($result);
        $this->assertIsObject($result);
        $this->assertEquals('dumy@gmail.com',$result->email);
    }


    public function test_method_find_by_email_can_return_null_if_user_not_found()
    {
        $this->InsertUserInDB(['email' => 'dumy@gmail.com']);

        $result = $this->userRepository->findByEmail('dumyyyyyyyy@gmail.com');

        $this->assertNull($result);
    }

    public function test_method_find_by_id_can_return_user_data_by_id()
    {
        $id =  $this->InsertUserInDB();

        $result =  $this->userRepository->findById($id);


        $this->assertNotNull($result);
        $this->assertIsObject($result);
        $this->assertEquals($id,$result->id);

    }

    public function test_method_find_by_id_can_return_null_if_user_not_found()
    {
        $this->InsertUserInDB();

        $result =  $this->userRepository->findById(1000);

        $this->assertNull($result);
    }

    

    private function InsertUserInDB(array $option = []) : int 
    {
        $userdata = array_merge([
            'username' => 'johndoe',
            'email' => 'test@gmail.com',
            'password' => 'password'
        ], $option);
        
        return $this->userRepository->create($userdata);
    }

    private function getConfig() : array
    {
        return (config::get('database.SM_DB_TEST'));
    }

    public function tearDown() : void
    {
        $this->userRepository->rollBack();

        parent::tearDown();
    }
}