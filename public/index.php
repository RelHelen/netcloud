<?php

//$query = rtrim($_SERVER['QUERY_STRING'], '/'); //обрезаем спава / в конце
//echo 'Путь к файлу[controller/action]: '. $query."<br>";
require_once dirname(__DIR__) . '/config/init.php';

require_once LIBS . '/functions.php';
require_once CONF . '/routes.php';
//функция атозагрузки объектов Registry
new \fw\core\App;

//из программы можно обратиттся к параметрам params
//веменно положили значение
//\fw\core\App::$app->setProperty('timer', 60);
//обращение к параметрам
//debug(\fw\core\App::$app->getProperties());
//die;
