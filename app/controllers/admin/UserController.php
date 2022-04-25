<?php

/**
 * контроллер админской части при авторизации
 */

namespace app\controllers\admin;

use app\models\User;
use fw\core\base\View;


class UserController extends AppadminController
{

	public function indexAction()
	{
		// echo __METHOD__;
		//debug($this->route);
		\fw\core\base\View::setMeta('Админка | Главная страница');

		$test = "тестовая переменная";
		$data = ['test', 3];

		//1вариант - передача данных в вид, в виде будут доступны  'test' и 'data'
		$this->setParams([
			'test' => $test,
			'data' => $data,
		]);

		//2вариант - передача данных в вид, в виде будут доступны  'test' и 'data'
		//$this->setParams(compact('test','data'));

	}

	public function loginAction()
	{
		if (!empty($_POST)) {
			$user = new User();
			if (!$user->isLogin(true)) {
				//ошибка подключения
				$_SESSION['error'] = 'Логин/пароль введены неверно';
			}
			if (User::isAdmin()) {
				redirect(ADMIN);
			} else {
				redirect();
			}
		}
		//смена шаблона		  
		$this->layout = 'login-admin';
		//echo __METHOD__;
	}
}
