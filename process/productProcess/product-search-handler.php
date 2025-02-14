<?php 

require '../../bootstrap/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest' ) {

        exit;
    }
    if (!isset($_POST['name']) || !isset($_POST['user_id'])) {
        exit;
    }


        $result = $ProductRepo->search($_POST);

        header('Content-Type: application/json');
        echo json_encode($result);
        exit;


}