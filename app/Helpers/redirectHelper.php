<?php


namespace App\Helpers;

class redirectHelper
{

    public static function redirect(string $url): void
    {
        header("Location: $url");
        die();
    }
}
