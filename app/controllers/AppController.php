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

class AppController extends Controller
{
  public $menu;
  public $meta = []; //массив метаданных
  public $model;
  public $user;
  public function __construct($route)
  {
    parent::__construct($route); //сначало выполняем родительский конструктор
    $site_name = App::$app->getProperty('site_name'); //получ свойство из парметров кнфигурации
    $this->setMeta(
      // $site_name,
      'Система оплаты ренты Сloud Rental',
      'Система оплаты',
      'Система оплаты'
    );
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

    //find всех записей из таблицы users
    //$sql = "SELECT * FROM menu";
    // $this->menu = $model->findBySql($sql);

    //статичное меню на главной странице в секции main
    $menu = $this->menu;
    //echo '<h5>table = menu</h5>';
    //foreach ($menu as $val) {
    //echo $val['id'] . ':';
    // echo $val['title'] . '<br>';
    // };

    // debug($this->menu);

    //положим кеш категорий меню в контейнер и берем категории из свойств
    App::$app->setProperty('cats', self::cacheCategory());
    //получим и распечатем
    //debug(App::$app->getProperties());
    //debug($route, true);



    //проверка переменной из сессии при авторизации админа
    //если не user, то выход на главную страницу
    $this->user = new User;
    if (!$this->isUserLog($this->route['action'], $this->route['controller'])) {
      //debug($_SESSION['user']);

      //redirect(PATH . '/user/login');
    }
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
      $cats = $model->getAssoc("SELECT * FROM menu");
      //debug($cats);
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
  //проверка, что пользовтаель авторизован и имеет доступ к странице
  public  function isUserLog($action, $controller)
  {
    if ($this->user::isUser() && $this->route['action'] == $action && $this->route['controller'] == $controller) {
      return true;
    }
  }
}
