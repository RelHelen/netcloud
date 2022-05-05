<?php

/**
 * базовый контроллер 
 */

namespace app\controllers\ncadmin;

use fw\core\Db;
use app\models\User;

use fw\core\base\Controller;


class AppadminController extends Controller
{
  public $layout = 'admin';

  public function __construct($route)
  {
    parent::__construct($route);
    $user = new User;
    $this->setMeta(
      'Система оплаты ренты Сloud Rental',
      'Система оплаты',
      'Система оплаты'
    );
    $this->setTitle('Панель администратора');
    //debug($this->route);


    //проверка переменной из сессии при авторизации админа
    //если не админ, то выход на главную страницу

    // debug($route,true);
    if (!User::isAdmin() && $route['action'] != 'login' && $route['controller'] != 'User') {

      redirect(ADMIN . '/user/login');
    }
    // //подключение к бд и таблице menu
    //new Main;
  }
}
