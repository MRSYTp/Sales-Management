<?php 

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../autoload.php';

session_start();
date_default_timezone_set('Asia/Tehran');

use App\Config\config;

use App\Repositories\UserRepository;
use App\Repositories\SaleItemRepository;
use App\Repositories\SaleRepository;
use App\Repositories\ProductRepository;


use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\User;

use App\Services\authService;
use App\Services\JWTService;
use App\Services\SalePriceService;

$app_config = config::get('app');
$db_config = config::get('database.SM_DB');
$JWTConfig = config::get('JWT');
$cookieConfig = config::get('cookie');
$sessionConfig = config::get('session');

$PDO_connection = new PDO("mysql:host={$db_config['host']};dbname={$db_config['dbname']}", $db_config['username'], $db_config['password']);
$PDO_connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$UserRepo = new UserRepository(new User($PDO_connection));
$ProductRepo = new ProductRepository(new Product($PDO_connection));
$SaleRepo = new SaleRepository(new Sale($PDO_connection));
$SaleItemRepo = new SaleItemRepository(new SaleItem($PDO_connection));

$JWTService = new JWTService(
    $JWTConfig['key'],
    $JWTConfig['algo'],
    $JWTConfig['expiry']
);
$Auth = new authService($JWTService , $cookieConfig);
$salePriceService = new SalePriceService($SaleRepo);





