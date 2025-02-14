<?php 


require '../../bootstrap/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest' ) {

        exit;
    }
    if (!is_numeric($_POST['id'])) {
        exit;
    }

    $result = $ProductRepo->findById($_POST['id']);

    header('Content-Type: application/json');
    echo json_encode($result);
    exit;
}