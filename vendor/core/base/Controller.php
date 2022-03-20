<?php
/**базовый класс контроллера
 *  определяет, какой вид будет для метода конторллера
 *  передается из $contrObj=new $controller(self::$route); 
 */
namespace vendor\core\base;

abstract class Controller{
    /** 
     *  текущий маршрут и парметры (controller,action,params)
     *  @var array
    */
    public $route=[];
 
    /** 
     *  текущий вид  
     *  @var string
    */
    public $view;
  
    /** 
     *  текущий  шаблон
     *  @var string
    */
    public $layout;
      
    /** Пользовательские данные
     *  обмен переменными
     *   @var array   
    */
    public  $vars=[];

 public function __construct($route){
   $this->route=$route; 
   $this->view=$route['action'];
   
   //include APP."/views/{$route['controller']}/{$route['action']}.php"; 
 }
 public function getView(){
    //объект вида
    $vObj=new View($this->route, $this->layout, $this->view);    
    $vObj->render($this->vars);
    
 }

 /**
  * метод передачи переменных из контроллеров в виды
  */
  public function setParams($vars){
   $this->vars=$vars;
  }
}