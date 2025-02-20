<?php

use App\Services\SaleChartService;

require '../../bootstrap/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest' ) {

        exit;
    }

    if (!isset($_GET['time']) ) {
        exit;
    }

    $SaleAnalysis = new SaleChartService($SaleRepo , $Auth->getUserLoggedIn());

    $date = $_GET['time'];

    if ($date == '7-days-ago') {
        $TotalSalePriceForDay = $SaleAnalysis->getTotalSalePriceWeekAgo(6);
    }

    if ($date == '1-month-ago') {
        $TotalSalePriceForDay = $SaleAnalysis->getTotalSalePriceWeekAgo(30);
    }

    if ($date == '1-year-ago') {
        $TotalSalePriceForDay = $SaleAnalysis->getTotalSalePriceYearAgo();
    }

    
    header('Content-Type: application/json');
    echo json_encode($TotalSalePriceForDay);
    exit;
}