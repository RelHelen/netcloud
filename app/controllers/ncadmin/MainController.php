<?php

/**
 * контроллер админской части  
 */

namespace app\controllers\ncadmin;

use fw\core\Db;
use app\models\User;

use fw\core\base\View;

class MainController extends AppadminController
{

	public function indexAction()
	{
		// echo __METHOD__;
		//debug($this->route);
		View::setMeta('Админка | Главная страница');
		$this->setTitle('Панель администратора');
		$user = new User;
		$contracts = $user->getAll('contracts');
		$this->setParams(compact('contracts'));
	}
	public function testAction()
	{
		//смена шаблона
		$this->layout = 'default';
		//echo __METHOD__;
	}
}
