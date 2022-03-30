<?php
/** Главная страница 
 */
namespace app\controllers;
use app\models\Main;
use R;
use \vendor\core\base\View;

class MainController extends AppController{
  //public $layout='main';//задаем конкретный шаблон для всего класса  
    public function indexAction(){ 
      //public $layout='main';//задаем конкретный шаблон для всего класса

       $page='main';        
       $this->setTitle('Ваши данные');//установка заголовка
      //$title=$this->setTitle('Ваши данные');
      //debug($this->route['controller']);
      View::setMeta('Система оплаты ренты Сloud Rental','Система оплаты','Система оплаты');
      /**
       * подключаемся к бд и таблице
       * создаем объект класса Model (vendor\core\base\model.php)
       */    
      $model=new Main;//создаем объект модели соединения с БД

      //$this->setParams(compact(''));     
    }


    //ajax запрос
    //https://www.youtube.com/watch?v=In3qfMY1G8E&list=PLD-piGJ3Dtl1gX1wh22vBeeg6gMP1VlnW&index=13

    public function testAction(){
      $this->setTitle('TestMain::index');//установка заголовка
      
      //если данные поступили из ajax ,то
      if ($this->isAjax()){
           //получаем данные из Ajax
          //сначала из модели
           $model= new Main;
           //debug($model);
   $list=\R::findOne('contracts',"id={$_POST['id']}");
           //debug($list);
   
   //передаем данные в вид testic для формирования отображения
   $this->loadView('testic',compact('list'));



  //$data=['answer'=>'Ответ с сервера','kod'=>'200'];
  //echo json_encode($data);
          //$this->layout=false;
           die;
       }else{
          //иначе, если просто была открыта страница
          
           $this->layout='main';//задаем конкретный шаблон для данного action
          
       }
      
  }

  public function testicAction(){
       //$this->setTitle('Test2Main::index');//установка заголовка
       //$this->layout='main';//задаем конкретный шаблон для данного action
        echo '222';
       $this->layout=false;
  }
}
