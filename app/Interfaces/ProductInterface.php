<?php

namespace App\Interfaces;

interface ProductInterface
{

    public function findById(int $id): ?object;
    public function findAll(): ?object;
    public function create(array $data): ?int;
    public function update(int $id, array $data) : bool;
    public function delete(int $id): bool;
    public function search(array $criteria): ?object;
    
}
