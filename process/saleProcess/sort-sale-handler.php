<?php 

require '../../bootstrap/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest' ) {

        exit;
    }
    if (!is_numeric($_POST['sort']) || !is_numeric($_POST['user_id'])) {
        exit;
    }

    $results['sale'] = null;

    if ($_POST['sort'] == 1) {
        $results['sale'] = $SaleRepo->sortByPrice($_POST['user_id'], 'DESC');
    }

    if ($_POST['sort'] == 2) {
        $results['sale'] = $SaleRepo->sortByPrice($_POST['user_id'], 'ASC');
    }

    if ($_POST['sort'] == 3) {
        $results['sale'] = $SaleRepo->sortByDate($_POST['user_id'], 'DESC');
    }

    if ($_POST['sort'] == 4) {
        $results['sale'] = $SaleRepo->sortByDate($_POST['user_id'], 'ASC');
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