<?php 

require __DIR__ . '/../autoload.php';

use App\Config\config;
use App\Models\User;
use App\Repositories\UserRepository;


$app_config = config::get('app');
$db_config = config::get('database');

$PDO_connection = new PDO("mysql:host={$db_config['host']};dbname={$db_config['dbname']}", $db_config['username'], $db_config['password']);

$UserRepo = new UserRepository(new User($PDO_connection));

