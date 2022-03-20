<?php 
error_reporting(-1); //вывод ошибок для теста
//подключаем Router
use vendor\core\Router;
$query=rtrim($_SERVER['QUERY_STRING'], '/');//обрезаем спава / в конце
//$query=($_SERVER['QUERY_STRING']);
echo 'Путь к файлу[controller/action]: '. $query;

//require '../vendor/core/Router.php';
require '../vendor/libs/functions.php';

/**Функция автозагруки классов
 * загрузка классов из APP/controllers * 
 */
define('WWW',__DIR__);//ТЕКУЩАЯ ПАПКА public
define('CORE',dirname(__DIR__).'/vendor/core');
define('ROOT',dirname(__DIR__));//это корень 
define('APP',dirname(__DIR__).'/app');//заходит в папку APP
spl_autoload_register(function($class){
 //   debug($class);
 $file = ROOT.'/'.str_replace('\\','/',$class).'.php';//определяем место класса Router  замена обратного слеша \на прямой / 
 //debug($file);
    //$file = APP."/controllers/$class.php";//загрузка из папки APP
    if (is_file($file)){
        require_once $file;
    }
});
// require '../app/controllers/Main.php';
// require '../app/controllers/Post.php';
// require '../app/controllers/PostNew.php';
// require '../app/controllers/Contracts.php';
// require '../app/controllers/Operation.php';
// require '../app/controllers/Personal.php';
//правила создания маршрутов
    //класс- Router и метод -add
    //вызываем котролер 'controller'=>'Posts'
    // и метод  'action'=>'add'
 //Router::add('',['controller'=>'Main','action'=>'index']);

/**
 * при обращении к несуществующему контролеру и методу  (pages) переходим на main/index
 */
Router::add('^pages/?(?P<action>[a-z-]+)?$',['controller'=>'Main','action'=>'index']);
/**
 * дефолтное правило
 */
Router::add('^$',['controller'=>'Main','action'=>'index']);//по умолчанию пустая срока
Router::add('^(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$');
 /** ?(?P<action>[a-z-]+)? -не обязателен */

/**выа=вод всех строк
 */
//debug(Router::getRoutes());
// res: Array ( [post/add] => Array ( [controller] => Posts [action] => add ) )

/**проверяем, если адрес строки совпадает с имеющимся правилом маршрутов, то его печатаем
 * 
 * */
Router::dispatch($query);

