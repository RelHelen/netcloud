<?php

/**   
 */

namespace app\controllers;

use app\models\Contracts;
use app\models\Contract;
use app\models\User;
use fw\core\Cache;

class ContractsController extends AppController
{
  public $user;
  public $model;
  public $contracts;
  public $contractsAll;
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
      // unset($_SESSION['contracts']);
      if (isset($_SESSION['contracts'])) {
        $this->contracts = $_SESSION['contracts']; //получили договора из сессии
        $this->contractsAll = $_SESSION['contractsAll'];
        $this->devices = $_SESSION['devices'];
      } else {
        [$contracts, $contractsAll, $devices] =
          $this->model->getContractsAll(); //получили договора

        $this->contracts = $contracts;
        $this->contractsAll = $contractsAll;
        $this->devices = $devices;
      }
      // $this->contracts = $this->model->getContractsAll();
      //debug($_SESSION['devices']);

      // debug($_SESSION['contracts']);

    }
  }


  /**
   * главный экран страницы Договора
   * вывод всех договоров
   */
  public function indexAction()
  {

    $this->setTitle('Договора'); //установка заголовка
    ////////
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

    $this->setTitle('Договора');
    $alias = $this->route['alias'];
    $contract = [];
    $devices = [];
    //формирование договора
    if ($alias) {
      // $contract = $this->model->getContract($alias);
      foreach ($this->contractsAll as $key => $val) {
        if ($val['contr_nomer'] == $alias) {
          $contract = $val;
        }
      }

      //формирование устройств
      if ($contract) {
        // debug($contract, true);
        foreach ($contract['devices'] as $dev) {
          $devices[] = $dev;
        }
        // debug($this->contractsAll);
        // debug($contract, true);

        //$devices = $this->model->getDevicesc($contract);
        //$devices = $this->model->getDevices($contract['id']);
        //$cust = $contract['cust'];
        // $period = $contract['period'];
        // [$devices, $cust]  = $this->model->getDevicesAll($contract['id']); 
        $this->setData(compact('contract', 'devices'));
      } else {
        echo 'ytn';
      }
    };
  }
}
