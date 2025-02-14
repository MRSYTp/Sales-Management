<?php 

require '../../bootstrap/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest' ) {

        exit;
    }
    if (!is_numeric($_POST['product_id']) || !is_numeric($_POST['quantity'])) {
        exit;
    }
    if (0 > ($_POST['product_id']) || 0 > ($_POST['quantity']) ) {
        exit;
    }

    $product = $ProductRepo->findById($_POST['product_id']);

    $response = [
        'id' => $product->id,
        'name' => $product->name,
        'quantity' => (int)$_POST['quantity'],
        'cost_price' => $product->cost_price,
        'sell_price' => $product->sell_price,
    ];


    if ($_POST['quantity'] == 1) {

        $response['total_price'] = $product->sell_price;

    }

    if ($_POST['quantity'] > 1) {

        $response['total_price'] = $product->sell_price * $_POST['quantity'];

    }

    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}