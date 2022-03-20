<?php
/**Зададим пространство имен namespace
 * это путь к классу начиная от корня нашего приложения
 * 
 */
namespace app\controllers;
class Main extends App{
    //public $layout='main';//задаем конкретный шаблон для всего класса
    public function indexAction(){
        echo 'Main::index';
        //$this->layout=false;//не подключать шаблон , например для ajax запросах
        //$this->layout='main';//задаем конкретный шаблон для данного action
               //layout='main' - описан в layouts/main
       // $this->view='test';//задаем конкретный вид
                //view='test' - описан в views/Main/test

        //пережача переменных в view
        $name="Helen";
       //$this->setParams(['name'=> $name,'hi'=>'hello']);
       $hi="hello";
       $mas=[
          'user'=>'Vasya',
          'age'=>25,
       ];
       $this->setParams(compact('name','hi','mas'));//
    }
}
