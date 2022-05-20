<?php

namespace app\models;

use fw\core\base\Model;
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
        $contractsAll = [];
        $devicesAll = [];
        $related = [];
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

              if ($devices) {

                $devicesAll[] = $devices;

                $contracts[$i]['cust'] = $cust;
                $contracts[$i]['period'] = $period;

                $contract['cust'] = $cust;
                $contract['period'] = $period;

                $contractsAll[$i]['period'] = $period;
                $contractsAll[$i]['cust'] = $cust;
                $contractsAll[$i]['devices'] = $devices;
              }
              // связанные устройства с контрактами
              /* $related[] = $this->findBySql("SELECT * FROM devices JOIN contracts  ON contracts.id = devices.dev_id_contr WHERE devices.dev_id_contr = ?", [$contract['id']]);
*/
              $this->contract = $contract;
              $this->contracts = $contracts;
              $this->contractsAll = $contractsAll;
              $i++;
            }

            //  debug($related, true);
            //передаеm данные в сессию 
            $_SESSION['contracts'] = $contracts;
            $_SESSION['contractsAll'] = $contractsAll;

            //unset($_SESSION['devices']);
            //unset($_SESSION['contracts']);

            if ($devicesAll) {

              $this->devices = $devicesAll;
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
            }

            return  [$contracts, $contractsAll, $devices];
          }
          return false;
        }
      }
    }
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

    // $contractParam = [
    //   'num' => $num
    // ];
    // $contract = $this->getAssocArr("SELECT * FROM contracts WHERE contr_nomer=:num AND contr_status='0' LIMIT 1", $contractParam);

    // debug($this->contract);
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

  /**
   * получение договора у клиента по id
   * из БД
   */
  public function getContractSql($num)
  {
    $contractParam = [
      'num' => $num
    ];
    $contract = $this->getAssocArr("SELECT * FROM contracts WHERE id=:num AND contr_status='0' LIMIT 1", $contractParam);
    // debug($contract);
    //unset($_SESSION['contract']);

    if ($contract) {
      if (isset($_SESSION['contract'])) {
        unset($_SESSION['contract']);
      }
      $_SESSION['contract'] = $contract;
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
    $devices = $this->getAssoc("SELECT * FROM devices WHERE dev_id_contr=:id ", $devParam);


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
