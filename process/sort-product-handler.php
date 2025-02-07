<?php 

require '../bootstrap/init.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest' ) {

        exit;
    }
    if (!is_numeric($_POST['sort']) || !is_numeric($_POST['user_id'])) {
        exit;
    }

    if ($_POST['sort'] == 1) {
        $result = $ProductRepo->sortByPrice($_POST['user_id'], 'DESC');
    }

    if ($_POST['sort'] == 2) {
        $result = $ProductRepo->sortByPrice($_POST['user_id'], 'ASC');
    }


        header('Content-Type: application/json');
        echo json_encode($result);
        exit;


}