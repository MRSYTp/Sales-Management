<?php

use App\Services\SaleAnalysisService;

require '../../bootstrap/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest' ) {

        exit;
    }
    if (!isset($_POST['customer_name']) || !isset($_POST['user_id'])) {
        exit;
    }

        $SaleAnalysis = new SaleAnalysisService($SaleRepo , $SaleItemRepo , $Auth->getUserLoggedIn());
        $results['sale'] = $SaleRepo->search($_POST);

        if (is_null($results['sale'])) {

            $results['sale'] =  null;

        }else{

            foreach($results['sale'] as $result)
            {
                $result->sale_date = verta($result->sale_date)->format('%d  %B  %Y');
                $result->sell_profit = $SaleAnalysis->getProfit($result->id);
            }
    
            foreach($results['sale'] as $result)
            {
                $results['saleItem'][$result->id] = $SaleItemRepo->findAll($result->id);
                
            }

             
        }

        header('Content-Type: application/json');
        echo json_encode($results);
        exit;


}