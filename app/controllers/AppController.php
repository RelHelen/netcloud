<?php

/**наследуемся от базового контроллера 
 */

namespace app\controllers;

use fw\core\base\Controller;
use fw\core\base\Model;
use fw\core\App;
use fw\core\Cache;
use fw\core\Db;
use app\models\AppModel;
use app\models\User;
use app\models\Params;

class AppController extends Controller
{
  public $menu;
  public $meta = []; //массив метаданных
  public $model;
  public $user;
  public function __construct($route)
  {
    parent::__construct($route); //сначало выполняем родительский конструктор
    //debug($route);
    //определели параметры сайта
    App::$app->setProperty('params', self::setParamsFS());

    //взяли параметры из кеша
    $cache = Cache::instance();
    $site_params = $cache->get('params');
    //получ свойство из парметров кнфигурации
    //$params = App::$app->getProperty('params');
    //установка метаданных

    if ($site_params) {
      $this->setMeta(
        $site_params['site_title'],
        $site_params['site_desc'],
        $site_params['site_name']
      );
    } else {
      $this->setMeta(
        "Система оплаты ренты"
      );
    };
    $this->setTitle('Ваши данные');

    //подключение к бд и таблице menu
    $model = new AppModel;

    //debug($this->route);
    //debug($this->controller);
    //debug($this->model);

    //выполняем что нибудь только для конкретного конторллера и страницы
    // if($this->route['controller']=='Main' && $this->route['action']=='test'){
    //   echo "<h3>тест в майне</h3>";
    // };

    //положим кеш категорий меню в контейнер и устанавливаем  свойства из категорий
    App::$app->setProperty('cats', self::cacheCategory());
    //получим и распечатем
    //debug(App::$app->getProperties());
    //debug($route, true);
    //проверка переменной из сессии при авторизации админа
    //если не user, то выход на главную страницу
    $this->user = new User;
  }
  /**
   * в кеш положим массив категрий  
   */
  public static  function cacheCategory()
  {
    $model = new AppModel;
    $cache = Cache::instance();
    $cats = $cache->get('cats'); //ключ cats хранит массив категорий
    if (!$cats) {
      ////$cats = self::getCat();
      $cats = $model->findFromModel();
      $cache->set('cats', $cats);
    }
    return $cats;
  }
  public static function getCat()
  {
    $model = new AppModel;
    $res =  $model->findFromModel();
    // debug($res);

    $cat = array();
    foreach ($res as $value) {
      $cat[$value['id']] = $value;
    }

    return  $cat;
  }

  /**
   * в параметры  положим в массив параметров и в кеш из table: params 
   * которые можно добавлять autoload=1
   */
  protected function setParamsFS()
  {
    $modelParams = new AppModel;

    $cache = Cache::instance();
    $params = $cache->get('params');
    //положили в кеш
    if (!$params) {
      $param = $modelParams->getAssoc("SELECT * FROM params WHERE autoload=1");
      if (!empty($param)) {
        foreach ($param as $keys => $vals) {
          foreach ($vals as $k => $v) {
            $params[$vals['params_name']] = $vals['params_value'];
          }
        }
      }
      $cache->set('params', $params);
      // $cacheParams = $params;
    }
    return $params;
  }

  /**
   * проверка, что пользовтаель авторизован и имеет доступ к странице
   */
  public  function isUserLog($action, $controller)
  {
    if ($this->user::isUser() && $this->route['action'] == $action && $this->route['controller'] == $controller) {
      return true;
    }
  }
  /**
   * удаление сессий
   */
  public  function destSession()
  {
    session_destroy();
  }

  /**
   * 
   * вернет login user из сессии
   */
  public static function logUser()
  {
    return $logUser = isset($_SESSION['user']['users']) ? hsc($_SESSION['user']['users']) : null;
  }
  /**
   * 
   * вернет id клиента из сессии
   */
  public static function idCustomer()
  {
    return $idCustomer = isset($_SESSION['customer']['id']) ? hsc($_SESSION['customer']['id']) : null;
  }
}
