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
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result !== false ? $result : null;
    }

    public function rollBack() : void 
    {
        $this->db->rollBack();
    }

    public function beginTransaction() : void 
    {
        $this->db->beginTransaction();
    }
    
}
