<?php

use App\Helpers\redirectHelper;
use App\Helpers\urlHelper;

require 'bootstrap/init.php';

if (!$Auth->isLoggedIn()) {

    redirectHelper::redirect(urlHelper::siteUrl('auth.php?action=login'));

}else {

    $_SESSION[$sessionConfig['user_id_session']] = $Auth->getUserLoggedIn();
    
}

var_dump($_SESSION);