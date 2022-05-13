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
  public $contract;
  public $devices;
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
   * главный экран страницы Договора
   * вывод всех договоров
   */
  public function indexAction()
  {

    $this->setTitle('Договора'); //установка заголовка
    if ($this->contracts) {
      $contracts = $this->contracts;
      $this->setData(compact('contracts'));
    }
  }

  /**
   * Страница выбранного договора
   * вывод конкретного договора и устроуйств по договору
   */
  public function viewAction()
  {
    $alias = $this->route['alias'];
    if ($alias) {
      $contract = $this->model->getContract($alias);
      if ($contract) {
        $devices = $this->model->getDevices($contract['id']);
        //$cust = $contract['cust'];
        // $period = $contract['period'];
        // [$devices, $cust]  = $this->model->getDevicesAll($contract['id']); 

        $this->setData(compact('contract', 'devices'));
      }
    };
  }
}
