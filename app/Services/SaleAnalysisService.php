<?php

namespace App\Services;

use App\Interfaces\SaleAnalysisServiceInterfase;
use App\Interfaces\SaleInterface;
use App\Interfaces\SaleItemInterface;
use stdClass;

class SaleAnalysisService implements SaleAnalysisServiceInterfase
{

    public function __construct(
        private SaleInterface $SaleRepo,
        private SaleItemInterface $SaleItemRepo,
        private int $userId
    ){}

    public function getProfit(int $sale_id): ?int
    {
        $totalCostPrice = $this->getTotalCostPrice($sale_id);

        if (is_null($totalCostPrice))
            return null; 
        
        $profit = $this->getTotalPrice($sale_id) - $totalCostPrice;
        
        return $profit;
    }


    
    public function getBestSale() : ?object
    {
        return new stdClass;
    }


    private function getTotalCostPrice(int $sale_id) : ?int
    {
        $saleItems = $this->SaleItemRepo->findAll($sale_id);

        if (is_null($saleItems))
            return null;

        $totalCostPrice = 0;
        foreach($saleItems as $saleItem){

            for ($i = 1; $i <= $saleItem->quantity ; $i++) { 

                $totalCostPrice += (int)$saleItem->cost_price;

            }

        }

        return $totalCostPrice;
    }

    private function getTotalPrice(int $sale_id) : int
    {
        $sale = $this->SaleRepo->findById($sale_id);
        return (int)$sale->total_price;
    }

    
        
}