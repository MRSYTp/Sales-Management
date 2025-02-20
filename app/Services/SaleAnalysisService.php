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
        private int $userId
    ) {}

    public function getProfit(int $saleId): ?int
    {   
        $saleItems = $this->saleItemRepo->findAll($saleId);
        $totalCostPrice = $this->getTotalCostPriceForSale($saleItems);

        if ($totalCostPrice === null) {
            return null; 
        }
        
        return $this->getTotalSellPriceForSale($saleId) - $totalCostPrice;
    }

    public function getTotalProfit(int $time = null) : ?int 
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

        return $totalPrice - $this->getTotalCostPriceForSale($saleItems);
 
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

    public function getTotalPrice(int $date = null): ?int
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

    public function getPercentageProductBySale(): ?array
    {
        $salesData = $this->saleItemRepo->sortBySale($this->userId, 'DESC');

        if ($salesData === null) {
            return null;
        }

        $result = $this->getBestFiveProductsPercentage($salesData);

        if (count($salesData) > 5) {
            $result['labels'][] = 'دیگر';
            $result['data'][] = $this->getRemainingProductsPercentage($salesData);
        }

        return $result;
    }


    public function getTotalSalePriceWeekAgo(int $days) : array
    {
        $today = date('Y-m-d');
    
        $data = [];
        $labels = [];
        
        for ($i = $days; $i >= 0; $i--) { 
    
            $date = date('Y-m-d', strtotime($today . ' - ' . $i . ' days'));
    

            $labels[] = verta($date)->format('%B %d'); 
    

            $sales = $this->saleRepo->findAll($this->userId, null , $date);
    

            $data[] = !is_null($sales) ? array_sum(array_map(fn($sale) => (int)$sale->total_price, $sales)) : 0;
        }
    
        $result = ['labels' => $labels , 'data' => $data];
    
        return $result;
    }


    public function getTotalSalePriceYearAgo() : array
    {

        $today = date('Y-m');

        $data = [];
        $labels = [];

        for ($i = 10; $i >= 0; $i--) {

            $month = date('Y-m', strtotime($today . ' - ' . $i . ' months'));


            $labels[] = verta($month)->format('%B %Y'); 

            $sales = $this->saleRepo->findSalesByMonth($this->userId, $month);

            $data[] = !is_null($sales) ? array_sum(array_map(fn($sale) => (int)$sale->total_price, $sales)) : 0;

        }

        $thisMonthSales = $this->saleRepo->findSalesByMonth($this->userId);

        $labels[] = verta()->format('%B %Y'); 
        $data[] = !is_null($thisMonthSales) ? array_sum(array_map(fn($sale) => (int)$sale->total_price, $thisMonthSales)) : 0;

        $result = ['labels' => $labels , 'data' => $data];
    
        return $result;
    }
    


    private function sortProductByProfit(?array $products) : ?array
    {

        if (is_null($products)) {
            return null;
        }
    
        $sellPrice = $this->TotalSellPriceForProduct($products);
        $costPrice = $this->TotalCostPriceForProduct($products);
        
        for ($i = 0; $i < count($sellPrice); $i++) { 
            $result = ['product_name' => $sellPrice[$i]['product_name'] , 'profit' => $sellPrice[$i]['total_sell_price'] - $costPrice[$i]['total_cost_price']];
            $results[] = $result;
        }

        usort($results, function($a, $b) {
            return $b['profit'] - $a['profit'];
        });

        return $results;
    }

    private function getBestFiveProductsPercentage(array $salesData): ?array
    {
        $totalSellProduct = array_sum(array_column($salesData, 'total_quantity'));
        $salesData = array_slice($salesData, 0, 5);

        return [
            'labels' => array_map(fn($sale) => $sale->product_name, $salesData),
            'data' => array_map(fn($sale) => round(($sale->total_quantity / $totalSellProduct) * 100, 2), $salesData)
        ];
    }

    private function getRemainingProductsPercentage(array $salesData): float
    {   
        $totalSellProduct = array_sum(array_column($salesData, 'total_quantity'));
        $remainingQuantity = array_sum(array_column(array_slice($salesData, 5), 'total_quantity'));

        return round(($remainingQuantity / $totalSellProduct) * 100, 2);
    }

    private function TotalCostPriceForProduct(?array $products): ?array
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

    private function TotalSellPriceForProduct(?array $products): ?array
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


    private function getTotalCostPriceForSale(?array $saleItems): ?int
    {
        if ($saleItems === null) {
            return null;
        }

        return array_sum(array_map(fn($saleItem) => (int)$saleItem->cost_price * $saleItem->quantity, $saleItems));
    }

    private function getTotalSellPriceForSale(int $saleId): int
    {
        $sale = $this->saleRepo->findById($saleId);
        return (int)$sale->total_price;
    }
}
