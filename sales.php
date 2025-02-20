<?php 
require 'bootstrap/init.php';

use App\Helpers\redirectHelper;
use App\Helpers\urlHelper;
use App\Services\SaleAnalysisService;

if (!$Auth->isLoggedIn()) {

    redirectHelper::redirect(urlHelper::siteUrl('auth.php?action=login'));

}else {

    $_SESSION[$sessionConfig['user_id_session']] = $Auth->getUserLoggedIn();
    
}

$action = $_GET['action'] ?? null;
if ($action == 'logout') {
    session_destroy();
    $Auth->logout();
    redirectHelper::redirect(urlHelper::siteUrl('auth.php?action=login'));
}

$currentUserData = $UserRepo->findById($_SESSION[$sessionConfig['user_id_session']]);

$SaleAnalysis = new SaleAnalysisService($SaleRepo , $SaleItemRepo , $Auth->getUserLoggedIn());

$Sales = $SaleRepo->findAll($currentUserData->id);


include 'tpl/tpl-sales.php';