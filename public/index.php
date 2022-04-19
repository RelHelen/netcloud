<?php

//подключаем Router
use fw\core\Router;
// use \fw\core\App;

$query = rtrim($_SERVER['QUERY_STRING'], '/'); //обрезаем спава / в конце

//echo 'Путь к файлу[controller/action]: '. $query."<br>";

require '../vendor/fw/libs/functions.php';
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
define('LIBS', dirname(__DIR__) . '/vendor/libs'); //заходит в папку libs
define('LAYOUT', 'default'); //шаблон по умолчаню
define('PATH', '/netcloud/');
define('CACHE', dirname(__DIR__) . '/app/tmp/cache');


//функция атозагрузки страниц
require_once ROOT . '/vendor/autoload.php';

spl_autoload_register(function ($class) {
    // debug($class);
    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_file($file)) {
        require_once $file;
    }
});


//функция атозагрузки объектов Registry
new \fw\core\App;
/**
 * при обращении к несуществующему контролеру и методу  (pages) переходим на main/index
 */
Router::add('^pages/?(?P<action>[a-z-]+)?$', ['controller' => 'Main', 'action' => 'index']);
/**
 * просмотр для контроллера:Page дефолтного вида
 */
Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$', ['controller' => 'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$', ['controller' => 'Page', 'action' => 'view']);
Router::add('^page$', ['controller' => 'Page', 'action' => 'view']);
/**
 * правило админки
 * ЧПУ для админсской части не нужен
 * боты не должны индексировать этот каталог
 * admin/user - поиск в адресной строке * 
 * user - контроллер
 * 'prefix'=>'admin' - название папки
 */
Router::add('^admin$', ['controller' => 'Main', 'action' => 'index', 'prefix' => 'admin']);
Router::add('^admin/?(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['prefix' => 'admin']);

/**
 * правило для пустой строки
 * defaults routers
 */
Router::add('^$', ['controller' => 'Main', 'action' => 'index']);
/**
 * правило для всех контроллеров и методов(видов)
 */
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');

Router::dispatch($query);
