<?php
namespace vendor\core;
use vendor\core\Registry;
use vendor\core\ErrorHandler;
/**
 * Для создания объекта Registry
 * */
class App{
	public static $app;
	public function  __construct(){
		self::$app=Registry::instance();//заполняет объектом нашего реестра
		new ErrorHandler();
	}
}

