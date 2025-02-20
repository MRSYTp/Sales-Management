<?php 

namespace App\Services;

use App\Repositories\SaleRepository;

class SaleChartService
{
    public function __construct(
        private SaleRepository $saleRepo,
        private int $userId
    ){}


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


}
