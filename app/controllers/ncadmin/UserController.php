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
				$_SESSION['success'] = 'вы успешно авторизовались';
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
			$this->destSession();
		}
		redirect(ADMIN . '/user/login');
	}
}
