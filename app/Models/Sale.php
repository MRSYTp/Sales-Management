<?php 

namespace App\Models;

use PDO;

class Sale {
    
    public PDO $db;
    public $table = 'sales';

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findById(int $id) : ?object
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
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