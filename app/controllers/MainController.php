<?php
/**Зададим пространство имен namespace
 * это путь к классу начиная от корня нашего приложения
 * 
 */
namespace app\controllers;
use app\models\Main;

class MainController extends AppController{
    //public $layout='main';//задаем конкретный шаблон для всего класса
    public function indexAction(){
        echo 'Main::index';
        //$this->layout=false;//не подключать шаблон , например для ajax запросах
        //$this->layout='main';//задаем конкретный шаблон для данного action
               //layout='main' - описан в layouts/main
       // $this->view='test';//задаем конкретный вид
                //view='test' - описан в views/Main/test

        //пережача переменных в view
        //$name="Helen";
       //$this->setParams(['name'=> $name,'hi'=>'hello']);
       //$hi="hello";
    //    $mas=[
    //       'user'=>'Vasya',
    //       'age'=>25,
    //    ];
       $title="Page title-";
      // $this->setParams(compact('name','hi','mas','title'));//
      

      /**
       * подключаемся к бд и таблице
       * создаем объект класса Model (vendor\core\base\model.php)
       */
      $model=new Main;

      //сформировали зоапрос     
      //$res=$model->query("SELECT * FROM menu");
      $res=$model->findAll();

      //выбрать только одну запись contracts
        //$list=$model->findOne('contracts','name');
        //$list=$model->findOne('contracts');//передали поле поска в файле модели $pk='name';
        $list=$model->findOne('1','id_menu');
        //echo '<br>LIST=';
        //debug($list);

        //ПРОИЗВОЛНЫЙ ЗАПРОС
        $sgl="SELECT * FROM menu ORDER BY name LIMIT 2";
        $data=$model->findBySql($sgl);
        //debug($data);

        $sgl2="SELECT * FROM {$model->table} WHERE page='main'  ORDER BY NAME";
        $data2=$model->findBySql($sgl2);
        //debug($data2);

        $sgl3="SELECT * FROM customers WHERE cust_name_org LIKE ?";
        $data3=$model->findBySql($sgl3,['%OOO%']);
        //debug($data3);

        //$sgl3="SELECT * FROM customers WHERE cust_name_org LIKE ?";
        $data4=$model->findLike('OOO','cust_name_org','customers');
        debug($data4);

      //передаем резуkьтат запороса в вид 
      $this->setParams(compact('title','res','list'));
     
    }
}
