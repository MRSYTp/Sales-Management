<?php 
require 'bootstrap/init.php';

use App\Helpers\redirectHelper;
use App\Helpers\urlHelper;
use App\Helpers\messageHelper;
use App\Services\GravatarService;
use App\Validators\addSaleItemValidator;
use App\Validators\addSaleValidator;

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
$products = $ProductRepo->findAll($currentUserData->id);

$Gravatar = new GravatarService($currentUserData->email);
$profileURL = $Gravatar->getGravatarUrl();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $params = $_POST;

    $saleDataHandler = array_slice($params, 0, 4);
    
    $saleItemsDataHandler = [];
    $items = array_slice($params, 4);
    foreach (array_keys($items) as $key) {
        preg_match('/(.+?)_(\d+)$/', $key, $matches);
        if (!isset($matches[1]) || !isset($matches[2])) {
            continue;
        }
        $field = $matches[1];
        $id = $matches[2];

        if (!isset($saleItemsDataHandler[$id])) {
            $saleItemsDataHandler[$id] = [];
        }

        $saleItemsDataHandler[$id][$field] = $items[$key];
    }


    handlerAddSale($saleDataHandler , $saleItemsDataHandler);

    
}



function handlerAddSale(array $saleDataHandler , array $saleItemsDataHandler)
{
    global $SaleRepo , $ProductRepo , $SaleItemRepo , $currentUserData;

    $SaleValidator = new addSaleValidator();
    $SaleItemValidator = new addSaleItemValidator();


    if (!$SaleValidator->validate($saleDataHandler)) {
        $errors = $SaleValidator->getErrors();
        messageHelper::showErrorMessageWithTimeout($errors[0], 3000);
        return;  
    }


    foreach ($saleItemsDataHandler as $key => $saleItemData) {
    
        if (!$SaleItemValidator->validate($saleItemData)) {
            $errors = $SaleItemValidator->getErrors();
            messageHelper::showErrorMessageWithTimeout($errors[0], 3000);
            return;
        }
    }

    foreach ($saleItemsDataHandler as $key => $value) {

        if (is_null($ProductRepo->findById($value['id']))) {
            messageHelper::showErrorMessageWithTimeout('محصول یافت نشد.', 3000);
            return;
        }
    }


    $sale_id = $SaleRepo->create([
        'user_id' => $currentUserData->id,
        'customer_name' => $saleDataHandler['customer_name'],
        'customer_phone' => empty($saleDataHandler['customer_phone']) ? null : $saleDataHandler['customer_phone'],
        'total_price' => $saleDataHandler['total_price'],
        'sale_date' => date('Y-m-d' , $saleDataHandler['sale_date'])
    ]);

    if (is_null($sale_id)) {
        messageHelper::showErrorMessageWithTimeout('خطا در ثبت محصول.',3000);
        return;
    }

    foreach ($saleItemsDataHandler as $key => $value) {
        $result = $SaleItemRepo->create([
            'user_id' => $currentUserData->id,
            'sale_id' => $sale_id,
            'product_id' => $value['id'],
            'product_name' => $value['productName'],
            'quantity' => $value['quantity'],
            'cost_price' => $value['costPrice'],
            'sell_price' => $value['sellPrice'],
            'total_price' => $value['totalPrice'],
            'sale_date' => date('Y-m-d' , $saleDataHandler['sale_date'])

        ]);

        if (is_null($result)) {
            messageHelper::showErrorMessageWithTimeout('خطا در ثبت محصول.',3000);
            return;
        }
    }

    messageHelper::showSuccessMessageWithTimeout('فروش با موفقیت ثبت شد.',3000);
}

include 'tpl/tpl-add-sale.php';


