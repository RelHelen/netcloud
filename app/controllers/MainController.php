<?php

/** Главная страница 
 */

namespace app\controllers;

use app\models\Main;
//use R;
use fw\core\base\View;
use fw\core\Cache;
use fw\core\Db;

class MainController extends AppController
{

  //public $layout='main';//задаем конкретный шаблон для всего класса  
  public function indexAction()
  {
    //public $layout='main';//задаем конкретный шаблон для всего класса     
    $this->setTitle('Главная страница'); //установка заголовка
    /**
     * подключаемся к бд и таблице Menu  
     */
    $model = new Main; //создаем объект модели соединения с БД
    //$menu = $this->menu; //строим меню
    //debug($menu);

    //$user2 = $model->getU();
    //кешируем данные меню
    //1-создали объект кеша
    $cache = Cache::instance();
    //2-можно получить данные из кеша
    $menu = $cache->get('menu');
    if (!$menu) {
      //берем меню из БД
      $menu = $model->getMenuAll();
      //3-положили в кеш по ключу menu данные $menu
      $cache->set('menu', $menu, 120);
    }
    //debug($menu);
    //$model->getUcolumn();

    //кешируем данные контрактов
    //1-создали объект кеша
    $cache = Cache::instance();
    //2-можно получить данные из кеша
    $menu = $cache->get('menu');
    if (!$menu) {
      //берем меню из БД
      $menu = $model->getMenuAll();
      //3-положили в кеш по ключу menu данные $menu
      $cache->set('menu', $menu, 120);
    }


    $this->setData(compact('menu'));
  }


  //ajax запрос
  //https://www.youtube.com/watch?v=In3qfMY1G8E&list=PLD-piGJ3Dtl1gX1wh22vBeeg6gMP1VlnW&index=13

  public function testAction()
  {
    $this->setTitle('TestMain::index'); //установка заголовка

    //если данные поступили из ajax ,то
    if ($this->isAjax()) {
      //получаем данные из Ajax
      //сначала из модели
      $model = new Main;
      //debug($model);
      $list = \R::findOne('contracts', "id={$_POST['id']}");

      //debug($list);

      //передаем данные в вид testic для формирования отображения
      $this->loadView('testic', compact('list'));
      //$data=['answer'=>'Ответ с сервера','kod'=>'200'];
      //echo json_encode($data);
      //$this->layout=false;

    } else {
      //иначе, если просто была открыта страница

      $this->layout = 'main'; //задаем конкретный шаблон для данного action

    }
  }

  public function testicAction()
  {
    //$this->setTitle('Test2Main::index');//установка заголовка
    //$this->layout='main';//задаем конкретный шаблон для данного action
    echo '222';
    $this->layout = false;
  }
}
