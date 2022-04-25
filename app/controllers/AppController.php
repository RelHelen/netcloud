<?php

/**наследуемся от базового контроллера 
 */

namespace app\controllers;

use fw\core\base\Controller;
use app\models\App;
use fw\core\Db;

class AppController extends Controller
{
  public $menu;
  public $meta = []; //массив метаданных

  public function __construct($route)
  {
    parent::__construct($route); //сначало выполняем родительский конструктор
    //подключение к бд и таблице menu
    $model = new App;
    //debug($this->route);
    //выполняем что нибудь только для конкретного конторллера и страницы
    // if($this->route['controller']=='Main' && $this->route['action']=='test'){
    //   echo "<h3>тест в майне</h3>";
    // };

    //find всех записей из таблицы users
    //$sql = "SELECT * FROM menu";
    // $this->menu = $model->findBySql($sql);
    $menu = $this->menu;
    //echo '<h5>table = menu</h5>';
    //foreach ($menu as $val) {
    //echo $val['id'] . ':';
    // echo $val['title'] . '<br>';
    // };


    // debug($this->menu);
  }
}
