<?php
namespace App\Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTService
{


    public function __construct(
        private string $key,
        private string $algo,
        private int $expiry
    )
    {   
    }


    public function generateToken(array $payload): string
    {
        $payload['exp'] = time() + $this->expiry;
        return JWT::encode($payload, $this->key, $this->algo);
    }

    public function validateToken(string $token) : bool
    {
        try {
            
            JWT::decode($token, new Key($this->key, $this->algo));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function decodeToken(string $token): ?object
    {
        try {
            return JWT::decode($token, new Key($this->key, $this->algo));
        } catch (\Exception $e) {
            return null;
        }
    }
}
