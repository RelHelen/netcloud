<?php

/**Функция автозагруки классов
 * загрузка классов из APP/controllers *
 */
define("DEBUG", 1); //вывод ошибок DEBUG=1
//define("DEBUG",0);// омена вывода ошибок DEBUG=0
//C:\xampp\htdocs\netcloud
define('ROOT', dirname(__DIR__));

//C:\xampp\htdocs\netcloud\public
define('WWW', ROOT . '/public');

define('CORE',  ROOT . '/vendor/fw/core');
define('CONF',  ROOT . '/config');
define('APP',  ROOT . '/app'); //заходит в папку APP
define('LIBS',  ROOT . '/vendor/fw/libs'); //заходит в папку libs

define('CACHE', ROOT . '/app/tmp/cache');
define('LAYOUT', 'default'); //шаблон по умолчаню

// http://localhost/netcloud/public/index.php
$app_path = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";

// http://localhost/netcloud/public/
//ищем все, кроме слеш начиная с конца
$app_path = preg_replace("#[^/]+$#", '', $app_path);

// http://localhost/netcloud
//заменяем /public/ на пустую строку
$app_path = str_replace('/public/', '', $app_path);


//http://localhost/netcloud
define("HPATH", $app_path);
//define('PATH', '/netcloud');
define('PATH', $app_path);
//http://localhost/netcloud/ncadmin
define("ADMIN", HPATH . '/ncadmin');

//функция атозагрузки страниц
require_once ROOT . '/vendor/autoload.php';
