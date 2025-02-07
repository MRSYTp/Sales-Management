<?php

require 'bootstrap/init.php';

use App\Helpers\redirectHelper;
use App\Helpers\urlHelper;
use App\Helpers\messageHelper;
use App\Validators\addProductValidator;

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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $params = $_POST;

    handleAddProduct($params);

}


function handleAddProduct ($params)
{
    global $ProductRepo, $currentUserData; 

    $productValidator = new addProductValidator();

    if (!$productValidator->validate($params)) {
        $errors = $productValidator->getErrors();
        messageHelper::showErrorMessageWithTimeout($errors[0],3000);
        return;
    }

    if (!is_null($ProductRepo->findByName($params['name'] , $currentUserData->id))) {
        messageHelper::showErrorMessageWithTimeout('محصولی با این نام قبلا ثبت شده است.',3000);
        return;
    }

    $result = $ProductRepo->create([
        'user_id'    => $currentUserData->id,
        'name'       => $params['name'],
        'cost_price' => $params['cost_price'],
        'sell_price' => $params['sell_price']
    ]);

    if ($result) {
        messageHelper::showSuccessMessageWithTimeout('محصول با موفقیت ثبت شد.',3000);
    } else {
        messageHelper::showErrorMessageWithTimeout('خطا در ثبت محصول.',3000);
    }
}


include 'tpl/tpl-add-product.php';