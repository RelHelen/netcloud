<?php

namespace app\models;

use fw\core\base\Model;
use app\models\User;
use fw\core\Db;
//use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class Contracts extends Model
{
  public $table = 'contracts';
  // public $pk = 'contr_id_cust';
  public $pk = 'id';
  public $user;
  public $customers;
  public $contracts;
  public $contract;
  public $devices;
  public  $idUser;
  /**
   * получение  договоров по id клиенту
   */
  public function getContracts($id)
  {
    $contractsParam = [
      'id' => $id
    ];
    $contracts = $this->getAssoc("SELECT * FROM contracts WHERE contr_id_cust=:id AND contr_status='1' ", $contractsParam);
    if ($contracts) {
      return  $contracts;
    }
    return false;
  }
  /**
   * получение id договоров по id клиенту
   * незаконченный
   */
  public function getIdContracts($id)
  {
    $contractsParam = [
      'id' => $id
    ];
    $contracts = $this->getAssoc("SELECT * FROM contracts WHERE contr_id_cust=:id AND contr_status='0' ", $contractsParam);
    if ($contracts) {
      foreach ($contracts as $contract => $val) {
        debug($contract);
      }
      die;
      // $_SESSION['contracts'] = $contracts;
      return  $contracts;
    }
    return false;
  }

  /**
   * получение всех договоров и устройств по id клиенту
   * из бд
   */
  public function getContractsAll($id)
  {

    $contractsAll = [];
    $devicesAll = [];
    $related = [];

    $contractsParam = [
      'id' => $id
    ];
    $contracts = $this->getAssoc("SELECT * FROM contracts WHERE contr_id_cust=:id AND contr_status='1' ", $contractsParam);

    if ($contracts) {
      $i = 1;
      $contractsAll = $contracts;
      foreach ($contracts as $contract) {
        [$devices, $cust, $period] = $this->getDevicesAll($contract['contr_nomer']);

        if ($devices) {
          $devicesAll[] = $devices;
          $contracts[$i]['cust'] = $cust;
          $contracts[$i]['period'] = $period;

          $contractsAll[$i]['period'] = $period;
          $contractsAll[$i]['cust'] = $cust;
          $contractsAll[$i]['devices'] = $devices;
        }
        $i++;
      }
      // debug($contractsAll);
      if ($devicesAll) {
        //$this->devices = $devicesAll;
        $j = 0;
        foreach ($devicesAll as $keys =>  $vals) {
          foreach ($vals as $keyc => $valc) {
            $j++;
            foreach ($valc as $key => $val) {
              //debug($valc);
              if (
                $key == 'id' ||
                $key == 'dev_id_cust' ||
                $key == 'dev_id_contr' ||
                $key == 'dev_id_type' ||
                $key == 'dev_sernumber' ||
                $key == 'dev_mac' ||
                $key == 'dev_place' ||
                $key == 'dev_place' ||
                $key == 'dev_place'
              ) {
                //echo $val;
                //$_SESSION['devices'][$j][$key] = $val;
              }
            }
          }
        };
      }

      //debug($contractsAll);
      return  [$contracts, $contractsAll, $devices];
    }
    return false;
  }


  /**
   * получение договора  по id договора
   * из БД
   */
  public function getContractSql($num)
  {
    $contractParam = [
      'num' => $num
    ];
    $contract = $this->getAssocArr("SELECT * FROM contracts WHERE id=:num AND contr_status='1' LIMIT 1", $contractParam);
    // debug($contract);
    //unset($_SESSION['contract']);

    if ($contract) {
      // if (isset($_SESSION['contract'])) {
      //   unset($_SESSION['contract']);
      // }
      // $_SESSION['contract'] = $contract;
      // debug($_SESSION['contract']);
      return  $contract;
    } else {
      return false;
    }
  }
  /**
   * получение договора  по номеру договора
   * из БД
   */
  public function getContractByNum($num)
  {
    $contractParam = [
      'num' => $num
    ];
    $contract = $this->getAssocArr("SELECT * FROM contracts WHERE contr_nomer=:num AND contr_status='1' LIMIT 1", $contractParam);
    // debug($contract);
    //unset($_SESSION['contract']);

    if ($contract) {
      // if (isset($_SESSION['contract'])) {
      //   unset($_SESSION['contract']);
      // }
      // $_SESSION['contract'] = $contract;
      // debug($_SESSION['contract']);
      return  $contract;
    } else {
      return false;
    }
  }

  /**
   * получение всех устройств по договору
   * из БД
   */
  public function getDevicesAll($num)
  {
    $devParam = [
      'id' => $num
    ];
    //debug($contr);
    $devices = $this->getAssoc("SELECT id,dev_id_cust,dev_id_contr,dev_id_type,dev_sernumber,dev_sernumber,dev_mac,dev_place,dev_cost,dev_date_st,dev_period,dev_date_exp,dev_includ
     FROM devices WHERE dev_id_contr=:id ", $devParam);

    if ($devices) {
      $this->devices = $devices;
      [$cust, $period] = $this->getContractCost($devices);
      return [$devices, $cust, $period];
    } else {
      return false;
    }
  }
  /**
   * подсчет стоимости и периодда аренды по договору
   */
  public function getContractCost($devs)
  {
    $s = 0;
    $period = 0;
    foreach ($devs as $dev) {
      $s += $dev['dev_cost'];
      $period += $dev['dev_period'];
    }
    $n = count($devs);

    $period = intdiv($period, count($devs));

    return  [$s, $period];
  }

  /**
   * получение договора у клиента с конктретным номером
   * из массива сессии
   */
  public function getContract($num)
  {
    // debug($this->contracts);
    //debug($num);
    if (isset($_SESSION['contracts'])) {
      $this->contracts = $_SESSION['contracts'];
    } else {
      $contracts = $this->contracts;
    }
    // debug($_SESSION['user']);
    // debug($contracts);

    foreach ($contracts as $arr) {
      if ($arr['contr_nomer'] == $num && $arr['contr_status'] == 0) {
        $contract = $arr;
      }
    }
    $this->contract = $contract;

    if ($contract) {
      return  $contract;
    } else {
      return false;
    }
  }

  /**
   * получение всех устройств по договору
   * (данные берутся из из массива сессии)
   */
  public function getDevices($num)
  {
    $contracts = $this->contracts;
    $devs = $this->devices;
    //$devicesContract[] = '';
    foreach ($devs as $dev) {
      foreach ($dev as $arr) {
        if ($arr['dev_id_contr'] == $num) {
          $devicesContract[] = $arr;
        }
      }
    }
    if ($devicesContract) {
      return $devicesContract;
    } else return false;
  }
  /**
   * получение всех устройств по договору
   * (данные берутся  из массива сессии)
   */
  public function getDevicesc($contract)
  {
    foreach ($contract['devices'] as $dev) {
      $devicesContract[] = $dev;
    }
    if ($devicesContract) {
      return $devicesContract;
    } else return false;
  }
  //запись просомтренных контратов в куки 
  public function setViewed($id)
  {
    $recentlyViewed = $this->getAllViewed();
    if (!$recentlyViewed) {
      setcookie('recentlyViewed', $id, time() + 3600 * 24, '/'); //на сутки для всего сайта
    } else {
      //разединяем  explode
      $recentlyViewed = explode('.', $recentlyViewed);

      if (!in_array($id, $recentlyViewed)) {
        $recentlyViewed[] = $id;
        //соединяем  implode
        $recentlyViewed = implode('.', $recentlyViewed);
        setcookie('recentlyViewed', $recentlyViewed, time() + 3600 * 24, '/');
      }
    }
  }
  public function getViewed()
  {
    if (!empty($_COOKIE['recentlyViewed'])) {
      $recentlyViewed = $_COOKIE['recentlyViewed'];
      $recentlyViewed = explode('.', $recentlyViewed);
      // return array_slice($recentlyViewed, -3);
      return $recentlyViewed;
    }
    return false;
  }

  public function getAllViewed()
  {
    if (!empty($_COOKIE['recentlyViewed'])) {
      return $_COOKIE['recentlyViewed'];
    }
    return false;
  }
}
