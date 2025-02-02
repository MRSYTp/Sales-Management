<?php
namespace App\Services;

use App\Interfaces\AuthServiceInterface;
use App\Services\JWTService;
use App\Helpers\cookieHelper;

class authService implements AuthServiceInterface
{
    

    public function __construct(
        private JWTService $jwtService,
        private array $cookieConfig 
    
    ){}


    public function login(int $id) : void
    {
        
        $token = $this->jwtService->generateToken([
            'user_id' => $id
        ]);
        
        cookieHelper::setCookie($this->cookieConfig['name'], $token, 2592000 , '/' , $this->cookieConfig['domain']);

    }


    public function logout(): void
    {
        cookieHelper::deleteCookie($this->cookieConfig['name']);
    }

    public function getUserLoggedIn() : int 
    {
        $token = cookieHelper::getCookie($this->cookieConfig['name']);

        $payload = $this->jwtService->decodeToken($token);

        return $payload->user_id;
    }

    public function isLoggedIn(): bool
    {
        $token = cookieHelper::getCookie($this->cookieConfig['name']);
        if (!$token) {
            return false;
        }
        
        return $this->jwtService->validateToken($token);
    }
}
