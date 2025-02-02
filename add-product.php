<?php

require 'bootstrap/init.php';

use App\Helpers\redirectHelper;
use App\Helpers\urlHelper;


$action = $_GET['action'] ?? null;
if ($action == 'logout') {
    session_destroy();
    $Auth->logout();
    redirectHelper::redirect(urlHelper::siteUrl('auth.php?action=login'));
}


$currentUserData = $UserRepo->findById($_SESSION[$sessionConfig['user_id_session']]);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $params = $_POST;


}


include 'tpl/tpl-add-product.php';