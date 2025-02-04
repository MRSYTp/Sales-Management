<?php 

namespace Tests\Unit;

use App\Services\JWTService;
use PHPUnit\Framework\TestCase;

class JWTServiceTest extends TestCase
{
    private JWTService $jwtService;

    protected function setUp() : void
    {
        $this->jwtService = new JWTService('secret', 'HS256', 3600);

        parent::setUp();
    }


    public function test_generate_token_return_token()
    {
        $token = $this->jwtService->generateToken(['user_id' => 1]);
        
        $this->assertNotNull($token);
        $this->assertIsString($token); 
    }


    public function test_method_validate_token_return_true_if_token_valid()
    {
        $token = $this->jwtService->generateToken(['user_id' => 1]);
        
        $this->assertTrue($this->jwtService->validateToken($token));

    }

    public function test_method_validate_token_return_false_if_token_invalid()
    {
        $this->assertFalse($this->jwtService->validateToken('invalid_token'));

    }

    public function test_method_decode_token_return_object_if_token_valid()
    {
        $token = $this->jwtService->generateToken(['user_id' => 1]);
        
        $this->assertIsObject($this->jwtService->decodeToken($token));
        $this->assertNotEmpty($this->jwtService->decodeToken($token)->user_id);
    }

    public function test_method_decode_token_return_null_if_token_invalid()
    {
        $this->assertNull($this->jwtService->decodeToken('invalid_token'));
    }
}