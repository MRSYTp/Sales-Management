<?php



spl_autoload_register(function($class){

 

    $file_path = __DIR__ . "/". $class . ".php";


    include $file_path;

});