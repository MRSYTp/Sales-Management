<?php
namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;
use PDO;

class ProductRepository implements ProductInterface
{

    private Product $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    public function findById(int $id): ?object
    {
        return $this->productModel->findById($id);
    }

    public function findByName(string $name) : ?object
    {
        $sql = "SELECT * FROM {$this->productModel->table} WHERE name = :name";
        $stmt = $this->productModel->db->prepare($sql);
        $stmt->execute(['name' => $name]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result !== false ? $result : null;
        
    }

    public function findAll() : ?array
    {
        $stmt = $this->productModel->db->query("SELECT * FROM {$this->productModel->table}");
        $results = $stmt->fetchAll(PDO::FETCH_OBJ);
        return empty($results) ? null : $results;
    }

    public function create(array $data): ?int
    {
        $query = "INSERT INTO {$this->productModel->table} (user_id , name, cost_price, sell_price) 
                  VALUES (:user_id, :name, :cost_price, :sell_price)";
        $stmt = $this->productModel->db->prepare($query);
        $stmt->execute([
            'user_id'    => $data['user_id'],
            'name'       => $data['name'],
            'cost_price' => $data['cost_price'],
            'sell_price' => $data['sell_price']
        ]);

        $id = (int)$this->productModel->db->lastInsertId();


        return $id > 0 ? $id : null;

    }


    public function update(int $id, array $data) : bool
    {
        $query = "UPDATE {$this->productModel->table} 
                  SET name = :name, cost_price = :cost_price, sell_price = :sell_price 
                  WHERE id = :id";
        $stmt = $this->productModel->db->prepare($query);
        $stmt->execute([
            'name'       => $data['name'],
            'cost_price' => $data['cost_price'],
            'sell_price' => $data['sell_price'],
            'id'         => $id,
        ]);

        return $stmt->rowCount() > 0;
    }


    public function delete(int $id) : bool
    {
        $query = "DELETE FROM {$this->productModel->table} WHERE id = :id";
        $stmt = $this->productModel->db->prepare($query);
        $stmt->execute(['id' => $id]);
        return $stmt->rowCount() > 0;
    }


    public function search(array $criteria): ?array
    {
        $sql = "SELECT * FROM {$this->productModel->table} WHERE name LIKE :name";
        $stmt = $this->productModel->db->prepare($sql);
        $name = $criteria['name'] ?? '';
        $stmt->execute(['name' => '%' . $name . '%']);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        return empty($result) ? null : $result;
    }


    public function rollBack() : void 
    {
        $this->productModel->rollBack();
    }

    public function beginTransaction() : void 
    {
        $this->productModel->beginTransaction();
    }
}
