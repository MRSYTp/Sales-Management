<?php 

namespace App\Helpers;

class cookieHelper
{

    public static function setCookie(
        string $name, 
        string $value, 
        int $expiry, 
        string $path = '/',
        string $domain = 'localhost'
    ): void {
        setcookie($name, $value, time() + $expiry, $path , $domain);
    }

    public static function getCookie(string $name): ?string {
        return $_COOKIE[$name] ?? null;
    }


    public static function deleteCookie(string $name, string $path = '/',string $domain = 'localhost') : void {
        setcookie($name, '', time() - 3600, $path , $domain);
    }
}
