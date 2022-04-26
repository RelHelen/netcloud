<?php

$query = rtrim($_SERVER['QUERY_STRING'], '/'); //обрезаем спава / в конце
//echo 'Путь к файлу[controller/action]: '. $query."<br>";
require_once dirname(__DIR__) . '/config/init.php';
require_once LIBS . '/functions.php';

//функция атозагрузки объектов Registry
new \fw\core\App;
require_once CONF . '/routes.php';
