<?php 

namespace App\Interfaces;

interface SaleAnalysisServiceInterface
{
    public function getProfit(int $sale_id) : ?int;
    public function getBestSale() : ?object;
    
}