<?php

namespace App\Helpers;

use App\Config\config;

class urlHelper
{

    public static function siteUrl(string $ur = ''): string
    {
        $app_config = config::get('app');
        return $app_config['base_url'] . $ur;
    }
}
