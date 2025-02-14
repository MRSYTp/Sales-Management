<?php 

require '../../bootstrap/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest' ) {

        exit;
    }

    $whiteList = ['name', 'cost_price', 'sell_price', 'id'];
    if (array_diff(array_keys($_POST), $whiteList) || !is_numeric($_POST['id'])) {
        exit;
    }

    $result = $ProductRepo->update($_POST['id'] , $_POST);

    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
    
}