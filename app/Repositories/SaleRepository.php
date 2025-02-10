<?php 

namespace App\Repositories;

use App\Interfaces\SaleInterface;
use App\Models\Sale;
use PDO;

class SaleRepository implements SaleInterface
{
    private Sale $saleModel;

    public function __construct(Sale $saleModel)
    {
        $this->saleModel = $saleModel;
    }

    public function findById(int $id): ?object
    {
        return $this->saleModel->findById($id);

    }

    public function create(array $data): ?int
    {
        $query = "INSERT INTO {$this->saleModel->table} (user_id , customer_name, customer_phone, total_price , sale_date) 
                  VALUES (:user_id, :customer_name, :customer_phone, :total_price , :sale_date)";

        $stmt = $this->saleModel->db->prepare($query);
        $stmt->execute([
            'user_id'        => $data['user_id'],
            'customer_name'  => $data['customer_name'],
            'customer_phone' => $data['customer_phone'],
            'total_price'    => $data['total_price'],
            'sale_date'      => $data['sale_date']
        ]);

        $id = (int)$this->saleModel->db->lastInsertId();

        return $id > 0 ? $id : null;
    }

    public function findAll(int $user_id) : ?array
    {
        $stmt = $this->saleModel->db->query("SELECT * FROM {$this->saleModel->table} WHERE user_id = $user_id");
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return empty($results) ? null : $results;
    }

    public function delete(int $id) : bool
    {
        $query = "DELETE FROM {$this->saleModel->table} WHERE id = :id";
        $stmt = $this->saleModel->db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }

    public function search(array $criteria): ?array
    {
        $sql = "SELECT * FROM {$this->saleModel->table} WHERE user_id = :user_id AND customer_name LIKE :customer_name";
        $stmt = $this->saleModel->db->prepare($sql);
        
        $customer_name = $criteria['customer_name'] ?? '';
        
        $stmt->execute([
            'customer_name' => '%' . $customer_name . '%', 
            'user_id' => $criteria['user_id']
        ]);
        
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return empty($result) ? null : $result;
    }

    public function rollBack() : void 
    {
        $this->saleModel->rollBack();
    }

    public function beginTransaction() : void 
    {
        $this->saleModel->beginTransaction();
    }
    
}