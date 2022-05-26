<?php

/**
 * базовый контроллер 
 */

namespace app\controllers\ncadmin;

use fw\core\Db;
use app\models\AppModel;
use app\models\User;
use fw\core\base\Controller;

class AppadminController extends Controller
{
  public $layout = 'admin'; //переопределили шаблон
  public $user;
  public $model;
  public function __construct($route)
  {
    parent::__construct($route);
    $user = new User;
    $model = new AppModel;
    $this->user = $user;
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
    //debug($_SESSION);
    if (!User::isAdmin() && $route['action'] != 'login' && $route['controller'] != 'User') {

      // $this->destSession();
      redirect(ADMIN . '/user/login');
    }
    // //подключение к бд и таблице menu
    //new Main;
  }

  /**
   * удаление сессий
   */
  public  function destSession()
  {
    session_destroy();
  }
}
