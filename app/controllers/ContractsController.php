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

  public function __construct($route)
  {
    parent::__construct($route); //сначало выполняем

    //проверка переменной из сессии при авторизации    
    if (!$this->isUserLog($this->route['action'], $this->route['controller'])) {
      //debug($_SESSION['user']);

      redirect(PATH . '/user/login');
    }
    // debug($_SESSION['user']);
  }



  public function indexAction()
  {

    $this->setTitle('Договора'); //установка заголовка
    $model = new Contracts; //модель Контрактов
    $model->getContractsAll(); //получили договора
    //debug($_SESSION['user']['users_login']);
  }
}
