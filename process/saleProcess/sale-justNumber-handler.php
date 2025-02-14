<?php 
require '../../bootstrap/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest' ) {

        exit;
    }

    if (0 >= ($_POST['user_id']) || !is_numeric($_POST['justnumber'])) {
        exit;
    }


    $results['sale'] = null;

    if ($_POST['justnumber'] == 0) {
        $results['sale'] = $SaleRepo->findAll($_POST['user_id']);
    }

    if ($_POST['justnumber'] == 1) {
        $results['sale'] = $SaleRepo->sortByPhoneNumber($_POST['user_id']);
    }

    if (!is_null($results['sale'])) {

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