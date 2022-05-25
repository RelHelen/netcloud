<?php

/**   
 */

namespace app\controllers;

use app\models\Contracts;
use app\models\Contract;
use app\models\User;
use app\models\Operation;
use fw\core\Cache;

class ContractsController extends AppController
{
  public $user;
  public $model;
  public $modelOperation;
  public $balanse;
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

      //поолучили log user и Customer из сессии
      $logUser = $this->logUser();
      $idCustomer = $this->idCustomer();

      $this->model = new Contracts; //модель Контрактов   

      //баланс 
      $this->modelOperation = new Operation; //модель Контрактов 
      $this->balanse  = isset($_SESSION['customer']['balanse']) ? hsc($_SESSION['customer']['balanse']) : null;
      if ($this->balanse) {
        $balanse = $this->modelOperation->getBalanse($this->idCustomer());
        $_SESSION['customer']['balanse'] = $balanse;
      }

      //unset($_SESSION['contracts']['nomer']);
      //unset($_SESSION['contractsAll']);


      //получаем договора
      //надо что то оставить
      // if (isset($_SESSION['contracts']['nomer'])) {
      //   //если в сессии лежат id договоров
      //   foreach ($_SESSION['contracts']['nomer'] as $keys => $vals) {
      //     $contracts[$keys] = $this->model->getContractByNum($vals);
      //   }
      // }
      // if (isset($_SESSION['contractsAll'])) {
      //   //если в сессии лежат id договоров
      //   foreach ($_SESSION['contractsAll'] as $keys => $vals) {
      //     $contractsAll[] = $vals;
      //   }
      //   $this->model->contracts = $contractsAll;
      // } else {
      //   //получили договора
      //   [$contracts, $contractsAll, $devices] = $this->model->getContractsAll($idCustomer);
      //   $this->model->contracts = $contractsAll;
      //   // $this->contractsAll = $contractsAll;
      //   // $this->devices = $devices;
      //   //положили в сессию id договоров
      //   foreach ($contracts as $keys => $contract) {
      //     $_SESSION['contracts']['nomer'][] = $contract['contr_nomer'];
      //   }
      //   foreach ($contractsAll as $keys => $contracts) {
      //     $_SESSION['contractsAll'][] = $contracts;
      //   }
      // }

      [$contracts, $contractsAll, $devices] = $this->model->getContractsAll($idCustomer);
      $this->model->contracts = $contractsAll;
      // [$contracts, $contractsAll, $devices] = $this->model->getContractsAll($idCustomer);
      $this->contracts = $contractsAll;
      // debug($_SESSION);
      //debug($this->model);
    }
  }
  /**
   * главный экран страницы Договора
   * вывод всех договоров
   */
  public function indexAction()
  {
    $this->setTitle('Договора'); //установка заголовка
    //$balanse = $this->balanse;

    if ($this->contracts) {
      $contracts = $this->contracts;
      //debug($contracts, true);
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

    //получили id  Customer из сессии
    $idCustomer = $this->idCustomer();

    //получили контракты из модели
    // $contracts =  $this->model->contracts;
    $contracts =  $this->contracts;

    //формирование договора $contract
    if ($alias) {

      foreach ($contracts as $key => $val) {
        if ($val['contr_nomer'] == $alias) {
          $contract = $val;
        }
      }
      //формирование устройств
      if ($contract) {
        if (!empty($contract['devices'])) {
          foreach ($contract['devices'] as $dev) {
            $devices[] = $dev;
          }
        }
        // debug($_SESSION);
        // debug($contracts);
        // debug($devices);

        $this->setData(compact('contracts', 'contract', 'devices'));
      }
    };
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
    // $contractsAll =  $this->model->contracts;
    $contractsAll =  $this->contracts;
    //определение договора
    foreach ($contractsAll as $keys => $contracts) {
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
  /**
   * Страница всех устройства
   *  
   */
  public function devicesAction()
  {

    $this->setTitle('Параметры устройств'); //установка заголовка

    $device = [];
    $contract = [];
    // $contracts=  $this->model->contracts;
    $contracts =  $this->contracts;

    // debug($contractsAll);
    //определение договора
    // foreach ($contracts as $keys => $contract) {
    //   debug($contract['devices']);

    //   foreach ($contract['devices'] as $devices) {
    //     if (!empty($devices['id']) && (!empty($dev))) {
    //       if ($devices['id'] == $dev)
    //         $device = $devices;
    //     }
    //   }
    // }

    // debug($device);
    // debug($contractsAll);
    // die;
    $this->setData(compact('contracts'));
  }

  //ajax запрос 
  public function addAction()
  {
    // debug($_GET);
    // die;
    $this->model = new Contracts; //модель Контрактов
    $id = !empty($_GET['id']) ? (int)$_GET['id'] : null;
    // debug($id);
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
