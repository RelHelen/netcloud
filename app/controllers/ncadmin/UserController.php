<?php

/**
 * контроллер админской части при авторизации
 */

namespace app\controllers\ncadmin;

use fw\core\Db;
use app\models\User;
//use fw\core\base\View;

class UserController extends AppadminController
{
	//public $layout = 'admin-login';
	public function indexAction()
	{
		//echo __METHOD__;
		//debug($this->route);
		//public $layout = 'admin-user';

		$test = "тестовая переменная";
		$data = ['test', 3];

		//1вариант - передача данных в вид, в виде будут доступны  'test' и 'data'
		$this->setData([
			'test' => $test,
			'data' => $data,
		]);

		//2вариант - передача данных в вид, в виде будут доступны  'test' и 'data'
		//$this->setParams(compact('test','data'));

	}

	//вход
	public function loginAction()
	{
		//смена шаблона		  
		$this->layout = 'admin-login';
		$this->setTitle('Панель администратора');
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

		//echo __METHOD__;
	}

	//выход
	public function logoutAction()
	{

		if (isset(($_SESSION['user']))) {
			unset($_SESSION['user']);
		}
		redirect(ADMIN . '/user/login');
	}
}
