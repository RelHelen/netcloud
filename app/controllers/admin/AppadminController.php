<?php

/**
 * базовый контроллер 
 */

namespace app\controllers\admin;

use \app\models\User;
use \app\models\Main;
use \fw\core\base\Controller;
use \R;

class AppadminController extends Controller
{
  public $layout = 'admin';

  public function __construct($route)
  {
    parent::__construct($route); //сначало выполняем родительский конструктор

    //debug($route);

    //проверка переменной из сессии про авторизации админа
    //$is_admin=1;

    //если не админ, то выход на главную страницу
    //if (!isset($is_admin) || $is_admin !== 1){            
    //header('Location: http://localhost/freimwork/');
    //сделать редирект на конторллер регистрации
    //header('Location: http://localhost/freimwork/login.php');

    // debug($route,true);
    if (!User::isAdmin() && $route['action'] != 'login' && $route['controller'] != 'User') {
      redirect(ADMIN . '/user/login');
    }
    //подключение к бд и таблице menu
    new Main;
  }
}
