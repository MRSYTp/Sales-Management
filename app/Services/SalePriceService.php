<?php

namespace App\Services;

use App\Interfaces\SaleInterface;

class SalePriceService
{
    public function __construct(private SaleInterface $saleRepo) {}


    public function TotalCostPriceForProduct(?array $products): ?array
    {
        if (is_null($products)) {
            return null;
        }

        $handler = [];
        foreach ($products as $product) {

            $totalCostPrice = (int)$product->cost_price * (int)$product->total_quantity;
            $handler[] = ['product_name' => $product->product_name , 'total_cost_price' => $totalCostPrice];
        }

        return $handler;
    }

    public function TotalSellPriceForProduct(?array $products): ?array
    {
        if (is_null($products)) {
            return null;
        }

        $handler = [];
        foreach ($products as $product) {

            $totalSellPrice = (int)$product->sell_price * (int)$product->total_quantity;
            $handler[] = ['product_name' => $product->product_name , 'total_sell_price' => $totalSellPrice];
        }

        return $handler;
    }


    public function getTotalCostPriceForSale(?array $saleItems): ?int
    {
        if ($saleItems === null) {
            return null;
        }

        return array_sum(array_map(fn($saleItem) => (int)$saleItem->cost_price * $saleItem->quantity, $saleItems));
    }

    public function getTotalSellPriceForSale(int $saleId): ?int
    {
        $sale = $this->saleRepo->findById($saleId);

        if ($sale === null) {
            return null;
        }

        return (int)$sale->total_price;
    }

}
