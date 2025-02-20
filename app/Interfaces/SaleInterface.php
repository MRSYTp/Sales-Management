<?php 

namespace App\Interfaces;

interface SaleInterface
{
    public function create(array $data) : ?int;
    public function findAll(int $user_id , $time , $date) : ?array;
    public function findById(int $id) : ?object;
    public function delete(int $id) : bool;
    public function search(array $criteria) : ?array;
}