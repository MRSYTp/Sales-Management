<?php 

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../autoload.php';


use App\Config\config;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\authService;
use App\Services\JWTService;


$app_config = config::get('app');
$db_config = config::get('database');
$JWTConfig = config::get('JWT');
$cookieConfig = config::get('cookie');
$sessionConfig = config::get('session');

$PDO_connection = new PDO("mysql:host={$db_config['host']};dbname={$db_config['dbname']}", $db_config['username'], $db_config['password']);

$UserRepo = new UserRepository(new User($PDO_connection));


$JWTService = new JWTService(
    $JWTConfig['key'],
    $JWTConfig['algo'],
    $JWTConfig['expiry']
);
$Auth = new authService($JWTService , $cookieConfig);

