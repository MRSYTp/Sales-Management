<?php 

namespace App\Repositories;

use PDO;
use App\Models\SaleItem;
use App\Interfaces\SaleItemInterface;

class SaleItemRepository implements SaleItemInterface
{
    private SaleItem $sale_itemModel;

    public function __construct(SaleItem $sale_itemModel)
    {
        $this->sale_itemModel = $sale_itemModel;
    }


    public function create(array $data): ?int
    {
        $query = "INSERT INTO {$this->sale_itemModel->table} (user_id ,sale_id , product_id , product_name ,  quantity , cost_price ,sell_price , total_price , sale_date) 
                  VALUES (:user_id ,:sale_id, :product_id, :product_name , :quantity, :cost_price , :sell_price , :total_price , :sale_date)";

        $stmt = $this->sale_itemModel->db->prepare($query);
        $stmt->execute([
            'user_id'        => $data['user_id'],
            'sale_id'        => $data['sale_id'],
            'product_id'  => $data['product_id'],
            'product_name' => $data['product_name'],
            'quantity' => $data['quantity'],
            'cost_price'    => $data['cost_price'],
            'sell_price'    => $data['sell_price'],
            'total_price'      => $data['total_price'],
            'sale_date'  =>  $data['sale_date']
        ]);

        $id = (int)$this->sale_itemModel->db->lastInsertId();

        return $id > 0 ? $id : null;
    }

    public function findById(int $id): ?object
    {
        return $this->sale_itemModel->findById($id);
    }

    public function findAll(int $sale_id) : ?array
    {
        $stmt = $this->sale_itemModel->db->query("SELECT * FROM {$this->sale_itemModel->table} WHERE sale_id = $sale_id");
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return empty($results) ? null : $results;
    }

    public function findAllByUserId(int $user_id , int $time = null) : ?array
    {        
        $condition = '';
        if ($time !== null) {
            $condition = "AND sale_date >= DATE_SUB(NOW(), INTERVAL {$time} DAY)";
        }

        $stmt = $this->sale_itemModel->db->query("SELECT * FROM {$this->sale_itemModel->table} WHERE user_id = $user_id {$condition}");
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return empty($results) ? null : $results;
    }


    public function getTotalQuantity(int $user_id ,  int $time = null) : int
    {

        $condition = '';
        if ($time !== null) {
            $condition = "AND sale_date >= DATE_SUB(NOW(), INTERVAL {$time} DAY)";
        }

        $stmt = $this->sale_itemModel->db->query(" SELECT SUM(quantity) as total_sold_products FROM {$this->sale_itemModel->table} WHERE user_id = $user_id {$condition}");

        $results = $stmt->fetch(PDO::FETCH_OBJ);
        return (int)$results->total_sold_products;
        
    }

    public function sortBySale(int $user_id,string $sort) : ?array
    {
        $stmt = $this->sale_itemModel->db->query("SELECT * , SUM(quantity) as total_quantity 
        FROM {$this->sale_itemModel->table} WHERE user_id = {$user_id} GROUP BY product_id, product_name ORDER BY total_quantity $sort");

        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return empty($results) ? null : $results;
    }


    public function rollBack() : void 
    {
        $this->sale_itemModel->rollBack();
    }

    public function beginTransaction() : void 
    {
        $this->sale_itemModel->beginTransaction();
    }

}