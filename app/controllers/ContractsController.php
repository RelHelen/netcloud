<?php

/**   
 */

namespace app\controllers;

use app\models\Contracts;
use app\models\Contract;
use app\models\User;

class ContractsController extends AppController
{
  public $user;
  public $model;
  public $contracts;
  public function __construct($route)
  {
    parent::__construct($route); //сначало выполняем

    //проверка переменной из сессии при авторизации    
    if (!$this->isUserLog($this->route['action'], $this->route['controller'])) {
      redirect(PATH . '/user/login');
    } else {
      $this->model = new Contracts; //модель Контрактов
      $this->contracts = $this->model->getContractsAll(); //получили договора

      // debug($_SESSION['user']);
    }
  }


  /**
   * вывод всех договоров
   */
  public function indexAction()
  {

    $this->setTitle('Договора'); //установка заголовка

    // $contracts = $this->model->getContractsAll(); //получили договора
    // $this->contracts = $contracts;

    if ($this->contracts) {
      // debug($this->contracts);
      $contracts = $this->contracts;
      // die;
      $this->setData(compact('contracts'));
    };
  }

  /**
   * вывод конкретного договора
   */
  public function viewAction()
  {
    $alias = $this->route['alias'];
    $contract = $this->model->getContract($alias);
    $devices = $this->model->getDevicesAll($contract['id']);
    //debug($contract);
    //debug($devices);
    //die;
    $this->setData(compact('contract', 'devices'));
  }
}
