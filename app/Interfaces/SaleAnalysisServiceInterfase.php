<?php 

namespace App\Interfaces;

interface SaleAnalysisServiceInterfase
{
    public function getProfit(int $sale_id) : ?int;
    public function getBestSale() : ?object;
    
}