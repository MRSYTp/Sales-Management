<?php 

require 'bootstrap/init.php';

use App\Helpers\redirectHelper;
use App\Helpers\urlHelper;

if (!$Auth->isLoggedIn()) {

    redirectHelper::redirect(urlHelper::siteUrl('auth.php?action=login'));

}else {

    $_SESSION[$sessionConfig['user_id_session']] = $Auth->getUserLoggedIn();
    
}

$currentUserData = $UserRepo->findById($_SESSION[$sessionConfig['user_id_session']]);
$products = $ProductRepo->findAll($currentUserData->id);


include 'tpl/tpl-products.php';