<?php

namespace app\models;

use fw\core\base\Model;
use fw\core\Db;
use JetBrains\PhpStorm\Internal\ReturnTypeContract;

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
  /**
   * получение всех договоров по клиенту
   */
  public function getContractsAll()
  {
    /*поиск id пользователя users*/
    if ($_SESSION['user']['users_login']) {
      $usersParam = [
        'login' => $_SESSION['user']['users_login']
      ];
      $user  = $this->getAssocArr("SELECT id FROM users WHERE users_login=:login LIMIT 1", $usersParam);
      // debug($user['id']);
      $this->user = $user;
      /*поиск заказчика - customers*/
      /*один пользователь==одному заказчику*/
      if ($user['id']) {
        $customersParam = [
          'id' => $user['id']
        ];
        $customers = $this->getAssocArr("SELECT * FROM customers WHERE cust_id_users=:id LIMIT 1", $customersParam);
        //debug($customers);
        //debug($customers['id']);

        $this->customers = $customers;
        $contractsAll[] = '';
        /* поиск договоров заказчика -  contracts*/
        if (!empty($customers)) {
          $contractsParam = [
            'id' => $customers['id']
          ];
          $contracts = $this->getAssoc("SELECT * FROM contracts WHERE contr_id_cust=:id AND contr_status='0' ", $contractsParam);
          if ($contracts) {
            $i = 1;
            $contractsAll = $contracts;
            foreach ($contracts as $contract) {
              [$devices, $cust, $period] = $this->getDevicesAll($contract['contr_nomer']);

              $devicesAll[] = $devices;
              $contracts[$i]['cust'] = $cust;
              $contracts[$i]['period'] = $period;
              $contract['cust'] = $cust;
              $contract['period'] = $period;

              $contractsAll[$i]['devices'] = $devices;
              // $contracts[$i]['devices'] = $devices;
              $this->contract = $contract;
              $this->contracts = $contracts;

              $i++;
            }
            debug($contractsAll);
            die;
            $this->devices = $devicesAll;

            //передаеm данные в сессию 
            foreach ($this->contracts as $key => $val) {
              //ключ - название полей таблицы              
              $_SESSION['contracts'][$key] = $val;
            }
            //unset($_SESSION['devices']);

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
                    $_SESSION['devices'][$j][$key] = $val;
                  }
                }
              }
            };

            //debug($_SESSION['devices']);
            //debug($_SESSION['contracts'], true);
            //echo '-contractsAll----';
            //debug($contracts);

            return  $contracts;
          }
          return false;
        }
      }
    }
  }

  /**
   * получение договора у клиента с конктретным номером
   */
  public function getContract($num)
  {
    if ($_SESSION['user']['users_login']) {
      // debug($this->contracts);

      $contractParam = [
        'num' => $num
      ];
      // debug($num);
      $contracts = $this->contracts;
      // // debug($contracts);
      foreach ($contracts as $arr) {
        if ($arr['contr_nomer'] == $num && $arr['contr_status'] == 0) {
          $contract = $arr;
        }
      }
      $this->contract = $contract;
      // $contract = $this->getAssocArr("SELECT * FROM contracts WHERE contr_nomer=:num AND contr_status='0' LIMIT 1", $contractParam);

      // debug($this->contract);
      if ($contract) {
        return  $contract;
      } else {
        return false;
      }
    }
  }

  /**
   * получение всех устройств по договору(данные берутся из массива)
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
   */
  public function getDevicesAll($num)
  {
    if ($_SESSION['user']['users_login']) {
      $devParam = [
        'id' => $num
      ];
      //debug($contr);
      $devices = $this->getAssoc("SELECT * FROM devices WHERE 	dev_id_contr=:id ", $devParam);
      $this->devices = $devices;

      if ($devices) {
        [$cust, $period] = $this->getContractCost($devices);
        return [$devices, $cust, $period];
      } else {
        return false;
      }
    }
  }
  /**
   * получение стоимости и периодда аренды по договору
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
}
