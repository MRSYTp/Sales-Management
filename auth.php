<?php 

require 'bootstrap/init.php';

use App\Helpers\MessageHelper;
use App\Helpers\redirectHelper;
use App\Helpers\urlHelper;
use App\Validators\RegisterValidator;
use App\Validators\loginValidator;

if ($Auth->isLoggedIn()) {

    redirectHelper::redirect(urlHelper::siteUrl());

}


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


function handleLogin(array $params){

    global $UserRepo;
    global $Auth;

    $validator = new loginValidator();

    

    if (!$validator->validate($params)) {
        MessageHelper::showErrorMessageWithTimeout($validator->getErrors()[0], 3000);
        return;
    }

    $user = $UserRepo->findByEmail($params['email']);
    
    if (is_null($user)) {
        MessageHelper::showErrorMessageWithTimeout('کاربری با این ایمیل یافت نشد', 3000);
        return;
    }

    if (!loginValidator::Validpassword($params['password'], $user->password)) {
        MessageHelper::showErrorMessageWithTimeout('پسورد اشتباه است', 3000);
        return;
    }

    $Auth->login($user->id);

    MessageHelper::showSuccessMessageWithTimeout("{$user->username} خوش امدید ", 3000 , urlHelper::siteUrl());
    return;
}
