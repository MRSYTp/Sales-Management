<?php

namespace App\Services;

use App\Interfaces\SaleAnalysisServiceInterface;
use App\Interfaces\SaleInterface;
use App\Interfaces\SaleItemInterface;

class SaleAnalysisService implements SaleAnalysisServiceInterface
{
    public function __construct(
        private SaleInterface $saleRepo,
        private SaleItemInterface $saleItemRepo,
        private SalePriceService $SalePriceService,
        private int $userId
    ) {}

    public function getProfit(int $saleId): ?int
    {   
        $saleItems = $this->saleItemRepo->findAll($saleId);
        $totalCostPrice = $this->SalePriceService->getTotalCostPriceForSale($saleItems);

        if ($totalCostPrice === null) {
            return null; 
        }
        
        return $this->SalePriceService->getTotalSellPriceForSale($saleId) - $totalCostPrice;
    }

    public function getTotalProfit(?int $time = null) : ?int 
    {   

        if ($time !== null) {
            $totalPrice = $this->getTotalPrice($time);
            $saleItems = $this->saleItemRepo->findAllByUserId($this->userId , $time);
        }else {

            $totalPrice = $this->getTotalPrice();
            $saleItems = $this->saleItemRepo->findAllByUserId();
        }

        if ($saleItems === null) {
            return null;
        }

        return $totalPrice - $this->SalePriceService->getTotalCostPriceForSale($saleItems);
 
    }

    public function getBestSale(): ?object
    {   
        $sales = $this->saleRepo->sortByPrice($this->userId, 'DESC');
        
        return $sales ? $sales[0] : null;
    }

    public function getBestSellingProduct(): ?object
    {
        $saleItems = $this->saleItemRepo->sortBySale($this->userId, 'DESC');

        return $saleItems ? $saleItems[0] : null;
    }

    public function getBestCustomer(): ?object
    {
        $customers = $this->saleRepo->sortByBestCustomer($this->userId, 'DESC');

        return $customers ? $customers[0] : null;
    }

    public function getBestProductByProfit() : ?object
    {
        $products = $this->saleItemRepo->sortBySale($this->userId , 'DESC'); 

        $porductProfits = $this->sortProductByProfit($products);

        return  $porductProfits ? (object)$porductProfits[0] : null;

    }

    public function getTotalPrice(?int $date = null): ?int
    {
        if ($date !== null) {

            $sales = $this->saleRepo->findAll($this->userId , $date);

        }else {

            $sales = $this->saleRepo->findAll($this->userId);
        }

        if ($sales === null) {
            return null;
        }

        return array_sum(array_map(fn($sale) => (int)$sale->total_price, $sales));
    }


    private function sortProductByProfit(?array $products) : ?array
    {

        if (is_null($products)) {
            return null;
        }
    
        $sellPrice = $this->SalePriceService->TotalSellPriceForProduct($products);
        $costPrice = $this->SalePriceService->TotalCostPriceForProduct($products);
        
        for ($i = 0; $i < count($sellPrice); $i++) { 
            $result = ['product_name' => $sellPrice[$i]['product_name'] , 'profit' => $sellPrice[$i]['total_sell_price'] - $costPrice[$i]['total_cost_price']];
            $results[] = $result;
        }

        usort($results, function($a, $b) {
            return $b['profit'] - $a['profit'];
        });

        return $results;
    }

}
