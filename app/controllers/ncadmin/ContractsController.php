<?php

/**
 * контроллер админской части  
 */

namespace app\controllers\ncadmin;

use fw\core\Db;
use app\models\ncadmin\Contracts;
use fw\core\base\View;
use fw\libs\Pagination;

class ContractsController extends AppadminController
{

	public $model;
	public function __construct($route)
	{
		$this->model = new Contracts;
		parent::__construct($route);
	}
	public function indexAction()
	{
		$model = new Contracts;
		$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
		$perpage = 10;
		$count = $model->count('contracts');
		$pagination = new Pagination($page, $perpage, $count);
		$start = $pagination->getStart();

		//все договора
		$contracts = $model->getContracts($perpage);

		$count = $model->count('contracts');
		//debug($contacts);
		//балансы
		$c = $model->dbQuery(
			"SELECT contracts.contr_nomer,SUM(devices.dev_cost) AS sum  FROM contracts
			JOIN devices ON contracts.id=devices.dev_id_contr 
			GROUP BY contracts.id"
		);
		//debug($c);
		foreach ($c  as $kay => $value) {
			//debug($value);
			$d[$kay] = $value;
		}

		$this->setTitle('Список договоров');
		$this->setData(compact('count', 'contracts', 'pagination'));
	}
}
