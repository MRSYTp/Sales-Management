<?php

use App\Services\SaleAnalysisService;

require '../../bootstrap/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest' ) {

        exit;
    }


    $SaleAnalysis = new SaleAnalysisService($SaleRepo , $SaleItemRepo , $Auth->getUserLoggedIn());

    $percentageProducts = $SaleAnalysis->getPercentageProductBySale();
    

    if (is_null($percentageProducts)){
        $percentageProducts = null;
    }else {
        $percentageProducts['colors'] = ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc' , '#d2d6de'];
    }
        

    
    header('Content-Type: application/json');
    echo json_encode($percentageProducts);
    exit;
}