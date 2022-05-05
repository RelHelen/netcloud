<?php

namespace app\models;

use fw\core\base\Model;
use fw\core\Db;

class Contracts extends Model
{
  public $table = 'contracts';
  // public $pk = 'contr_id_cust';
  public $pk = 'id';

  public function getContractsAll()
  {
    /*поиск id пользователя users*/
    $usersParam = [
      'login' => $_SESSION['user']['users_login']
    ];
    $users  = $this->getAssocArr("SELECT id FROM users WHERE users_login=:login LIMIT 1", $usersParam);
    //debug($users['id']);

    /*поиск заказчика - customers*/
    /*один пользователь==одному заказчику*/
    $customersParam = [
      'id' => $users['id']
    ];
    $customers = $this->getAssocArr("SELECT * FROM customers WHERE cust_id_users=:id", $customersParam);
    //debug($customers);
    //debug($customers['id']);

    /* поиск договоров заказчика -  contracts*/
    $contractsParam = [
      'id' => $customers['id']
    ];
    $contracts = $this->getAssoc("SELECT * FROM contracts WHERE contr_id_cust=:id", $contractsParam);
    //debug($contracts);

    return  $contracts;
  }
}
