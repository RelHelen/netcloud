<?php

/**
 * контроллер админской части  
 */

namespace app\controllers\ncadmin;

use fw\core\Db;
use app\models\AppModel;
use app\models\Contracts;
use fw\core\base\View;

class MainController extends AppadminController
{
	public $user;
	public $model;
	public function __construct($route)
	{
		$this->model = new AppModel;
		parent::__construct($route);
	}
	public function indexAction()
	{
		//$model = $this->model;
		$model = new AppModel;
		//договора со статусом =0, то есть не обработанные
		$countNewContracts = $model->count('contracts', "WHERE contr_status=0");
		//количество зарегестрированных пользователей
		$countUsers = $model->count('users', "WHERE users_id_rol=3 AND users_status=1");
		//количество новых пользователей
		$countUsersNew = $model->count('users', "WHERE users_id_rol=3 AND  users_status=0");
		//количество активных клиентов
		$countCustomers = $model->count('customers', "WHERE cust_status=1");

		// debug($countNewContracts);
		// debug($countUsers);
		// debug($countCustomers);



		//заявки на регистрацию пользователя - новые пользователи не авторизованные

		//договора, у которых истеает срок
		//не оплатившие клиенты по договорам
		$this->setData(compact('countNewContracts', 'countUsers', 'countCustomers', 'countUsersNew'));
	}
	public function testAction()
	{
		//смена шаблона
		$this->layout = 'default';
		//echo __METHOD__;
	}
}
