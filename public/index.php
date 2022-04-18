<?php

//подключаем Router
use app\vendor\core\Router;
use app\vendor\core\App;

$query = rtrim($_SERVER['QUERY_STRING'], '/'); //обрезаем спава / в конце

//echo 'Путь к файлу[controller/action]: '. $query."<br>";

require '../app/vendor/libs/functions.php';

/**Функция автозагруки классов
 * загрузка классов из APP/controllers * 
 */
define("DEBUG", 1); //вывод ошибок DEBUG=1
//define("DEBUG",0);// омена вывода ошибок  DEBUG=0
define('WWW', __DIR__); //ТЕКУЩАЯ ПАПКА public
//C:\xampp\htdocs\netcloud\public

define('CORE', dirname(__DIR__) . '/app/vendor/core');

define('ROOT', dirname(__DIR__)); //это корень
//C:\xampp\htdocs\netcloud

define('APP', dirname(__DIR__) . '/app'); //заходит в папку APP
define('LIBS', dirname(__DIR__) . '/app/vendor/libs'); //заходит в папку libs
define('LAYOUT', 'default'); //шаблон по умолчаню
define('PATH', '/netcloud/');
define('CACHE', dirname(__DIR__) . '/app/tmp/cache');


//функция атозагрузки страниц

spl_autoload_register(function ($class) {
    // debug($class);
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});


//функция атозагрузки объектов Registry
new App;

Router::add('^pages/?(?P<action>[a-z-]+)?$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);
Router::add('^page$', ['controller' => 'Page', 'action' => 'view']);
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);
