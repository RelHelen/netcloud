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
    //debug($route);

    //проверка переменной из сессии при авторизации    
    if (!$this->isUserLog($this->route['action'], $this->route['controller'])) {
      redirect(PATH . '/user/login');
    } else {
      $this->model = new Contracts; //модель Контрактов
      //unset($_SESSION['contract']);
      //unset($_SESSION['contracts']);
      //unset($_SESSION['contractsAll']);
      //unset($_SESSION['devices']);
      if (isset($_SESSION['contracts'])) {
        $this->contracts = $_SESSION['contracts']; //получили договора из сессии
        $this->contractsAll = $_SESSION['contractsAll'];
        // $this->devices = $_SESSION['devices'];
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
    if (User::isUser()) {
      if ($this->contracts) {
        $contracts = $this->contracts;
        $contractsAll = $this->contractsAll;
        //debug($contracts, true);
        $this->setData(compact('contracts'));
      }
    }
  }

  /**
   * Страница выбранного договора
   * вывод конкретного договора и устроуйств по договору
   */
  public function viewAction()
  {

    $this->setTitle('Договора');
    if (User::isUser()) {
      $alias = $this->route['alias'];
      $contract = [];
      $devices = [];
      $contracts = $this->contractsAll;
      //формирование договора $contract
      if ($alias) {
        // $contract = $this->model->getContract($alias);
        foreach ($contracts as $key => $val) {
          if ($val['contr_nomer'] == $alias) {
            $contract = $val;
            // debug($contract['id']);

            // запись в куки запрошенного контракта
            $this->model->setViewed($contract['id']);
          }
        }

        //вывод из кука просмотренных контрактов
        $r_viewed =  $this->model->getViewed();
        $recentlyViewed = null;
        if ($r_viewed) {
          $in  = str_repeat('?,', count($r_viewed) - 1) . '?';
          $sql = "SELECT * FROM contracts WHERE id IN ($in)";
          $recentlyViewed = $this->model->findSql($sql, $r_viewed);
          $recentlyViewed = $recentlyViewed->fetchAll();
        }
        //debug($recentlyViewed);


        //формирование устройств
        if ($contract) {

          if (!empty($contract['devices'])) {
            foreach ($contract['devices'] as $dev) {
              $devices[] = $dev;
            }
          }
          // debug($this->contractsAll);
          // debug($contract, true);

          //$devices = $this->model->getDevicesc($contract);
          //$devices = $this->model->getDevices($contract['id']);
          //$cust = $contract['cust'];
          // $period = $contract['period'];
          // [$devices, $cust]  = $this->model->getDevicesAll($contract['id']); 
          $this->setData(compact('contracts', 'contract', 'devices'));
        }
      };
    }
  }
  /**
   * Страница выбранного устройства
   *  
   */
  public function singleAction()
  {

    $this->setTitle('Параметры устройства'); //установка заголовка
    $alias = $this->route['alias'];
    $dev = $this->route['dev'];
    // debug($alias);
    // debug($dev);
    $device = [];
    $contract = [];
    //определение договора
    foreach ($this->contractsAll as $keys => $contracts) {
      if (!empty($contracts['contr_nomer']) && (!empty($alias))) {
        if ($contracts['contr_nomer'] == $alias) {
          $contract = $contracts;
          // debug($contract['contr_nomer']);
          foreach ($contract['devices'] as $devices) {
            if (!empty($devices['id']) && (!empty($dev))) {
              if ($devices['id'] == $dev)
                $device = $devices;
            }
          }
        }
      }
    }
    //debug($device);
    // debug($contract);
    //die;
    $this->setData(compact('contract', 'device'));
  }
  //ajax запрос 
  public function addAction()
  {
    // debug($_GET);
    // die;
    $this->model = new Contracts; //модель Контрактов
    $id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
    debug($id);
    if ($id) {
      $contract = $this->model->getContractSql($id);
      debug($contract);
      die;
      if (!$contract) {
        return false;
      }
    }
    if ($this->isAjax()) {
      // debug($contract);
      // die;
      $this->loadView('add', compact('contract'));
    }
    redirect();
  }
}
