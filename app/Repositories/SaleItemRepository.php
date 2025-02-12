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
        $query = "INSERT INTO {$this->sale_itemModel->table} (sale_id , product_id , product_name ,  quantity , cost_price ,sell_price , total_price) 
                  VALUES (:sale_id, :product_id, :product_name , :quantity, :cost_price , :sell_price , :total_price)";

        $stmt = $this->sale_itemModel->db->prepare($query);
        $stmt->execute([
            'sale_id'        => $data['sale_id'],
            'product_id'  => $data['product_id'],
            'product_name' => $data['product_name'],
            'quantity' => $data['quantity'],
            'cost_price'    => $data['cost_price'],
            'sell_price'    => $data['sell_price'],
            'total_price'      => $data['total_price']
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

    public function rollBack() : void 
    {
        $this->sale_itemModel->rollBack();
    }

    public function beginTransaction() : void 
    {
        $this->sale_itemModel->beginTransaction();
    }

}