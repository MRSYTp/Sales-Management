<?php 
require 'bootstrap/init.php';

use App\Helpers\redirectHelper;
use App\Helpers\urlHelper;
use App\Services\GravatarService;
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

$SaleAnalysis = new SaleAnalysisService($SaleRepo , $SaleItemRepo , $salePriceService ,$Auth->getUserLoggedIn());

$Gravatar = new GravatarService($currentUserData->email);
$profileURL = $Gravatar->getGravatarUrl();


if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    $date = $_GET['analysisBy'] ?? null;
    $time = 7;

    $totalSalePrice = $SaleAnalysis->getTotalPrice($time);
    $totalSaleProfit = $SaleAnalysis->getTotalProfit($time);
    $totalSaleCount = !is_null($SaleRepo->findAll($currentUserData->id , $time)) ? count($SaleRepo->findAll($currentUserData->id , $time)) : null;
    $totalSaleProductCount = $SaleItemRepo->getTotalQuantity($currentUserData->id , $time);
    $title = 'یک هفته اخیر';


    if (!is_null($date) && $date == '7-days-ago') {
       
        $time = 7;

        $totalSalePrice = $SaleAnalysis->getTotalPrice($time);
        $totalSaleProfit = $SaleAnalysis->getTotalProfit($time);
        $totalSaleCount = !is_null($SaleRepo->findAll($currentUserData->id , $time)) ? count($SaleRepo->findAll($currentUserData->id , $time)) : null;
        $totalSaleProductCount = $SaleItemRepo->getTotalQuantity($currentUserData->id , $time);
        $title = 'یک هفته اخیر';
    }

    if (!is_null($date) && $date == '1-month-ago') {
       
        $time = 30;

        $totalSalePrice = $SaleAnalysis->getTotalPrice($time);
        $totalSaleProfit = $SaleAnalysis->getTotalProfit($time);
        $totalSaleCount = !is_null($SaleRepo->findAll($currentUserData->id , $time)) ? count($SaleRepo->findAll($currentUserData->id , $time)) : null;
        $totalSaleProductCount = $SaleItemRepo->getTotalQuantity($currentUserData->id , $time);
        $title = 'یک ماه اخیر';
    }

    if (!is_null($date) && $date == '1-year-ago') {
       
        $time = 365;

        $totalSalePrice = $SaleAnalysis->getTotalPrice($time);
        $totalSaleProfit = $SaleAnalysis->getTotalProfit($time);
        $totalSaleCount = !is_null($SaleRepo->findAll($currentUserData->id , $time)) ? count($SaleRepo->findAll($currentUserData->id , $time)) : null;
        $totalSaleProductCount = $SaleItemRepo->getTotalQuantity($currentUserData->id , $time);
        $title = 'یک سال اخیر';
    }

}


include 'tpl/tpl-analysis.php';