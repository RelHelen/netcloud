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
    if (!User::isAdmin() && $route['action'] != 'login' && $route['controller'] != 'User') {
      redirect(ADMIN . '/user/login');
    }
    //debug($_SESSION);
    $user = new User;
    $model = new AppModel;
    $this->user = $user;
    $this->setMeta(
      'Система оплаты ренты Сloud Rental',
      'Система оплаты',
      'Система оплаты'
    );
    $this->setTitle('Панель администратора');


    // //подключение к бд и таблице menu
    //new Main;
  }

  //получение числа из метода Get по полю id или по другому полю
  public function getRequestID($get = true, $id = 'id')
  {
    if ($get) {
      $data = $_GET;
    } else {
      $data = $_POST;
    }
    $id = !empty($data[$id]) ? (int)$data[$id] : null;
    if (!$id) {
      throw new \Exception('Страница не найдена', 404);
    }
    return $id;
  }
  /**
   * удаление сессий
   */
  public  function destSession()
  {
    session_destroy();
  }
}
