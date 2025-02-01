<?php 
require 'bootstrap/init.php';

use App\Helpers\MessageHelper;
use App\Helpers\urlHelper;
use App\Validators\RegisterValidator;


$action = $_GET['action'] ?? 'login';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $params = $_POST;

    if ($action === 'register') {

        handleRegister($params);

    } 
    
    if ($action === 'login') {

        handleLogin($params);

    }
}

if ($action === 'register') {
    include 'tpl/tpl-register.php';
}else {
    include 'tpl/tpl-login.php';
}


function handleRegister(array $params)
{
    global $UserRepo;  

    $validator = new RegisterValidator();


    if (!$validator->validate($params)) {
        MessageHelper::showErrorMessageWithTimeout($validator->getErrors()[0], 3000);
        return;
    }
    

    if ($UserRepo->findByEmail($params['email'])) {
        MessageHelper::showErrorMessageWithTimeout('ایمیل وارد شده قبلا ثبت شده است', 3000);
        return;
    }
    

    if (is_null($UserRepo->create($params))) {
        MessageHelper::showErrorMessageWithTimeout('خطا در ثبت نام', 3000);
        return;
    }
    
    MessageHelper::showSuccessMessageWithTimeout(
        'ثبت نام با موفقیت انجام شد', 
        3000, 
        urlHelper::siteUrl('auth.php?action=login')
    );
}


function handleLogin(array $params)
{
    // کد مربوط به ورود کاربر در اینجا قرار می‌گیرد
}
