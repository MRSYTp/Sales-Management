<?php

namespace App\Interfaces;

interface ProductInterface
{

    public function findById(int $id): ?object;
    public function findAll(int $user_id): ?array;
    public function create(array $data): ?int;
    public function update(int $id, array $data) : bool;
    public function delete(int $id): bool;
    public function search(array $criteria): ?array;
    
}
