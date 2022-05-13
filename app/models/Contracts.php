<?php

namespace app\models;

use fw\core\base\Model;
use fw\core\Db;

class Contracts extends Model
{
  public $table = 'contracts';
  // public $pk = 'contr_id_cust';
  public $pk = 'id';
  public $user;
  public $customers;
  public $contracts;
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
      //debug($users['id']);
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
        /* поиск договоров заказчика -  contracts*/
        if ($customers['id']) {
          $contractsParam = [
            'id' => $customers['id']
          ];
          $contracts = $this->getAssoc("SELECT * FROM contracts WHERE contr_id_cust=:id", $contractsParam);
          //debug($contracts);
          $this->contracts = $contracts;
          return  $contracts;
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
      $contract = $this->getAssocArr("SELECT * FROM contracts WHERE contr_nomer=:num LIMIT 1", $contractParam);
      return  $contract;
    }
  }
  /**
   * получение всех устройств по договору
   */
  public function getDevicesAll($contr)
  {
    if ($_SESSION['user']['users_login']) {
      $devParam = [
        'id' => $contr
      ];
      //debug($contr);
      $devices = $this->getAssoc("SELECT * FROM devices WHERE 	dev_id_contr=:id ", $devParam);
      $this->devices = $devices;
      // debug($devices);
      return $devices;
    }
  }
}
