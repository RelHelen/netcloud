<?php 
 
//подключаем Router
use vendor\core\Router;
use vendor\core\App;
$query=rtrim($_SERVER['QUERY_STRING'], '/');//обрезаем спава / в конце

//echo 'Путь к файлу[controller/action]: '. $query."<br>";

//require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';

/**Функция автозагруки классов
 * загрузка классов из APP/controllers * 
 */
define("DEBUG",1);//вывод ошибок DEBUG=1
//define("DEBUG",0);// омена вывода ошибок  DEBUG=0
define('WWW',__DIR__);//ТЕКУЩАЯ ПАПКА public
define('CORE',dirname(__DIR__).'/vendor/core');
define('ROOT',dirname(__DIR__));//это корень 
define('APP',dirname(__DIR__).'/app');//заходит в папку APP
define('LIBS',dirname(__DIR__).'/vendor/libs');//заходит в папку libs
define('LAYOUT','default');//шаблон по умолчаню
define('PATH','/freimwork/');
define('CACHE',dirname(__DIR__).'/tmp/cache');

//функция атозагрузки страниц
spl_autoload_register(function($class){
    //   debug($class);
    $file = ROOT.'/'.str_replace('\\','/',$class).'.php';//определяем место класса Router  замена обратного слеша \на прямой / 
    //debug($file);
       //$file = APP."/controllers/$class.php";//загрузка из папки APP
       if (is_file($file)){
           require_once $file;
       }
   });
   //функция атозагрузки объектов Registry
   //new \vendor\core\App;
   new vendor\core\App;

Router::add('^pages/?(?P<action>[a-z-]+)?$',['controller'=>'Main','action'=>'index']);
Router::add('^page/(?P<action>[a-z-]+)/(?P<alias>[a-z-]+)$',['controller'=>'Page']);
Router::add('^page/(?P<alias>[a-z-]+)$',['controller'=>'Page','action'=>'view']);
Router::add('^page$',['controller'=>'Page','action'=>'view']);
Router::add('^$',['controller'=>'Main','action'=>'index']);
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
 
Router::dispatch($query);
 

