<?php

namespace app\vendor\core;

use app\vendor\core\Registry;
use app\vendor\core\ErrorHandler;

/**
 * Для создания объекта Registry
 * */
class App
{
	public static $app;
	public function  __construct()
	{

		self::$app = Registry::instance(); //заполняет объектом нашего реестра
		new ErrorHandler();
	}
}
