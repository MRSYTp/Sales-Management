<?php 
namespace App\Interfaces;

interface UserInterface
{
    public function findById(int $id) : object|null;
    public function findByEmail(string $email) : object|null;
    public function create(array $data) : int|null ;
}