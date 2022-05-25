<?php

/** Главная страница 
 */

namespace app\controllers;

use fw\core\Db;
use fw\core\base\View;
use fw\core\Cache;

use app\models\Contracts;
use app\models\Main;
use app\models\Operation;
use app\models\Customers;

class MainController extends AppController
{
  public $modelUser;
  public $modelContracts;
  public $modelOperation;
  public $balanse;
  public $contracts;
  public $contractsAll;
  public $contract;
  public $devices;
  public function __construct($route)
  {
    parent::__construct($route); //сначало выполняем   

    //проверка переменной из сессии при авторизации    
    if (!$this->isUserLog($this->route['action'], $this->route['controller'])) {
      redirect(PATH . '/user/login');
    } else {

      //поолучили log user и Customer из сессии
      $logUser = $this->logUser();
      $idCustomer = $this->idCustomer();
      $this->modelContracts = new Contracts;
      $this->modelOperation = new Operation;
      $this->modelCustomer = new Customers;
      $this->balanse  = isset($_SESSION['customer']['balanse']) ? hsc($_SESSION['customer']['balanse']) : null;
      if ($this->balanse) {
        $balanse = $this->modelOperation->getBalanse($this->idCustomer());
        $_SESSION['customer']['balanse'] = $balanse;
      };
      //получаем договора 

      [$contracts, $contractsAll, $devices] = $this->modelContracts->getContractsAll($idCustomer);;

      $this->modelContracts->contracts = $contractsAll;
      $this->contracts = $contractsAll;
      // debug($this->modelContracts);
    }
  }

  public function indexAction()
  {
    $this->setTitle('Главная страница'); //установка заголовка
    $balanse = $this->balanse;

    if ($this->contracts) {
      $contracts = $this->contracts;
    }
    $this->setData(compact('contracts', 'balanse'));
  }

  public function indexMenuAction()
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
    $this->setData(compact('menu'));
  }


  //ajax запрос
  //https://www.youtube.com/watch?v=In3qfMY1G8E&list=PLD-piGJ3Dtl1gX1wh22vBeeg6gMP1VlnW&index=13

  public function testAction()
  {
    $this->setTitle('TestMain::index'); //установка заголовка
    //
    /*
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
  //
  */
  }

  public function testicAction()
  {
    //$this->setTitle('Test2Main::index');//установка заголовка
    //$this->layout='main';//задаем конкретный шаблон для данного action
    echo '222';
    $this->layout = false;
  }
}
