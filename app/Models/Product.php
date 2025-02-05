<?php

namespace App\Models;

use PDO;

class Product
{
    public PDO $db;

    public string $table = 'products';


    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findById(int $id): ?object
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();
        return $result !== false ? $result : null;
    }
    
}
