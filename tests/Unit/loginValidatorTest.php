<?php 

namespace Tests\Unit;

use App\Interfaces\ValidatorInterface;
use PHPUnit\Framework\TestCase;
use App\Validators\LoginValidator;

class loginValidatorTest extends TestCase
{
    private ValidatorInterface $loginValidator;

    public function setUp(): void
    {
        parent::setUp();
        $this->loginValidator = new LoginValidator();
    }

    public function test_method_validate_should_return_false_when_email_and_password_is_not_set()
    {
        $params = [];
        $this->set_params_and_assert_false($params);
    }

    public function test_method_validate_should_return_false_when_email_is_not_set()
    {
        $params = ['password' => '123456'];
        $this->set_params_and_assert_false($params);
    }

    public function test_method_validate_should_return_false_when_password_is_not_set()
    {
        $params = ['email' => 'test@gmail.com'];
        $this->set_params_and_assert_false($params);
    }

    public function test_method_validate_should_return_false_when_email_structure_invalid()
    {
        $params = ['email' => 'testldkbLWEJNC', 'password' => '123456333'];
        $this->set_params_and_assert_false($params);
    }

    public function test_method_validate_should_return_false_when_keys_not_valid()
    {
        $params = ['test2' => 'testldkbLWEJNC', 'ssss' => '123456333'];
        $this->set_params_and_assert_false($params);
    }

    public function test_method_validate_should_return_true_if_email_and_password_is_set_and_valid()
    {
        $params = ['email' => 'test@gmail.com' , 'password' => '123456'];
        $result = $this->loginValidator->validate($params);
        $this->assertTrue($result);
    }

    public function test_static_method_valid_password_should_return_true_when_password_is_valid()
    {
        $result = LoginValidator::Validpassword('123456', password_hash('123456', PASSWORD_BCRYPT));
        $this->assertTrue($result);
    }

    public function test_static_method_valid_password_should_return_false_when_password_is_invalid()
    {
        $result = loginValidator::Validpassword('123456', password_hash('1234567', PASSWORD_BCRYPT));
        $this->assertFalse($result);
    }

    private function set_params_and_assert_false($params)
    {
        $result = $this->loginValidator->validate($params);
        $this->assertFalse($result);
    }
}