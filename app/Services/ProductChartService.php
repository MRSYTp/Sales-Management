<?php 

namespace App\Services;

use App\Interfaces\SaleItemInterface;

class ProductChartService
{
    public function __construct(
        private SaleItemInterface $saleItemRepo,
        private int $userId
    ){}


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
    

}
