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

    public function findAll(int $user_id, ?int $time = null, ?string $date = null) : ?array
    {
        $condition = '';
        if ($time !== null) {
            $condition = "AND sale_date >= DATE_SUB(NOW(), INTERVAL {$time} DAY)";
        }
    
        $condition2 = '';
        if ($date !== null) {
            $condition2 = "AND DATE(sale_date) = :date ";
        }

        $stmt = $this->saleModel->db->prepare("SELECT * FROM {$this->saleModel->table} WHERE user_id = :user_id {$condition} {$condition2} ORDER BY created_at DESC");
        

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        
        if ($date !== null) {
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
        }
    
        $stmt->execute();
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        return empty($results) ? null : $results;
    }


    public function findSalesByMonth(int $user_id, ?string $month = null) : ?array
    {
        
        $condition = "AND DATE_FORMAT(sale_date, '%Y-%m') = :month"; 

        $month = !is_null($month) ? $month : date('Y-m');
    
        $stmt = $this->saleModel->db->prepare("SELECT * FROM {$this->saleModel->table} WHERE user_id = :user_id {$condition}");
        
    
        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->bindParam(':month', $month , PDO::PARAM_STR); 

        $stmt->execute();
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

    public function getCustomers(int $user_id) : ?array
    {
        $sql = "SELECT * FROM {$this->saleModel->table} WHERE user_id = :user_id GROUP BY customer_name";

        return $this->findinDB($sql , $user_id);
    }












    public function sortByBestCustomer(int $user_id, string $sort) : ?array
    {
        $sql = "SELECT *, SUM(total_price) as total_spent FROM {$this->saleModel->table} 
        WHERE user_id = :user_id GROUP BY customer_name ORDER BY total_spent $sort";

        return $this->findinDB($sql , $user_id);
    }

    public function sortByPrice(int $user_id,string $sort) :  ?array
    {

        $sql = "SELECT * FROM {$this->saleModel->table} WHERE user_id = :user_id ORDER BY total_price $sort";
        
        return $this->findinDB($sql , $user_id);

    }

    public function sortByDate(int $user_id,string $sort) :  ?array
    {

        $sql = "SELECT * FROM {$this->saleModel->table} WHERE user_id = :user_id ORDER BY sale_date $sort";

        return $this->findinDB($sql , $user_id);
    }


    public function sortByPhoneNumber(int $user_id) : ?array
    {
        $sql = "SELECT * FROM {$this->saleModel->table} WHERE user_id = :user_id AND customer_phone IS NOT NULL";
        
        return $this->findinDB($sql , $user_id);
    }


    private function findinDB(string $SQL  , int $user_id) : ?array
    {
        $stmt = $this->saleModel->db->prepare($SQL);
        $stmt->execute([
            'user_id' => $user_id
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