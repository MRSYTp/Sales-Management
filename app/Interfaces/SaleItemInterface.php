<?php 

namespace App\Interfaces;

interface SaleItemInterface
{
    public function create(array $data) : ?int;
    public function findAll(int $sale_id) : ?array;
    public function findById(int $id) : ?object;
}