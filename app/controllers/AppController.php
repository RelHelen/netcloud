<?php

/**наследуемся от базового контроллера \vendor\core\base\Controller
 * Зададим пространство имен namespace
 * это путь к классу начиная от корня нашего приложения
 * 
 * если надо внести изменения в core, то можно менять не ядро, а сам App.php
 */

namespace app\controllers;

use app\vendor\core\base\Controller;
use app\models\Main;
use R;

class AppController extends Controller
{
  public $menu;
  public $meta = []; //массив метаданных

  //1вариант- Когда нужно автоматическое решение
  public function __construct($route)
  {
    parent::__construct($route); //сначало выполняем родительский конструктор
    //подключение к бд и таблице menu
    $model = new Main;

    //debug($this->route);
    //выполняем что нибудь только для конкретного конторллера и страницы
    // if($this->route['controller']=='Main' && $this->route['action']=='test'){
    //   echo "<h3>тест в майне</h3>";
    // };

    //find всех записей из таблицы menu
    $sql = "SELECT * FROM menu";
    $this->menu = $model->findBySql($sql);

    //debug($menu);
    //$this->menu=R::findAll('menu');
    //$this->menu=R::findAll($model->table);


  }
}
