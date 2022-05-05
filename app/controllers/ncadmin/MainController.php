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
		// $this->setTitle('Панель администратора');
		$user = new User;
		$contracts = $user->findAll('contracts');
		$this->setData(compact('contracts'));
	}
	public function testAction()
	{
		//смена шаблона
		$this->layout = 'default';
		//echo __METHOD__;
	}
}
