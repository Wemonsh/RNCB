<?php

require 'application/lib/Dev.php';

use application\core\Router;
use application\lib\Db;

// Функция автозагрузки классов
spl_autoload_register(function ($class){
   $path = str_replace('\\','/',$class.'.php');
   if (file_exists($path)){
       require $path;
   }
});

//Старт сессии
session_start();

$router = new Router;

$router->run();
