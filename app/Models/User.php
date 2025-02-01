<?php 

namespace App\Models;

use PDO;

class User
{
    private PDO $db;
    private string $table = "users";

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function findById(int $id) : ?object
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
    
        return $result !== false ? $result : null;
    }

    public function findByEmail(string $email) : ?object
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
    
        return $result !== false ? $result : null;
    }

    public function create(array $data) : int|null
    {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (username, email, password) VALUES (:username, :email, :password)");
        $stmt->execute([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => password_hash($data['password'], PASSWORD_BCRYPT),
        ]);
        return $this->db->lastInsertId() ?? null;
    }
}
