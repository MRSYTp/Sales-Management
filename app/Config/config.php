<?php 
namespace App\Config;


class config
{
    public static function get(string $key)
    {
        $keys = explode('.', $key);
        $file = __DIR__ . '/../../configs/' . $keys[0] . '.php';

        if (!file_exists($file)) {
            throw new \Exception("Config file not found: {$keys[0]}");
        }

        $config = require $file;
        array_shift($keys);

        foreach ($keys as $k) {
            if (!isset($config[$k])) {
                throw new \Exception("Config key not found: {$key}");
            }
            $config = $config[$k];
        }

        return $config;
    }
}