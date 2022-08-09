<?php

namespace fw\core;

use fw\core\Registry;
use fw\core\ErrorHandler;

use fw\core\Router;

/**
 * Для создания объекта Registry
 * */
class App
{
	public static $app;
	public function  __construct()
	{

		$query = trim($_SERVER['QUERY_STRING'], '/');
		session_start();
		//заполняет объектом нашего реестра
		self::$app = Registry::instance();
		new ErrorHandler();
		Router::dispatch($query);
		self::getParams(); //заполнили параметрами

		//var_dump(self::$app->getProperties());
	}

	protected function getParams()
	{
		$params = require_once CONF . '/params.php';
		if (!empty($params)) {
			foreach ($params as $k => $v) {
				self::$app->setProperty($k, $v);
			}
		}
	}
}
