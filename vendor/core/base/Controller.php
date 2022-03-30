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
    public $title='Просмотр данных';

 public function __construct($route){
   $this->route=$route; 
   $this->view=$route['action'];   
   
   //include APP."/views/{$route['controller']}/{$route['action']}.php"; 
 }
 public function getView(){
    //объект вида
    $vObj=new View($this->route, $this->layout, $this->view);    
    $vObj->render($this->title,$this->vars);       
 }

 /**
  * метод передачи переменных из контроллеров в виды
  */
  public function setParams($vars){
   $this->vars=$vars;
  }

  /**
  * метод установки Заголоквка на странице
  */
  public function setTitle($title){
         return $this->title=$title;

       }

    /**
  * метод чтения Заголокка на странице
  */
  public function getTitle(){

    return $this->title;
    }

    /**
     * проверка что пришел ajax запрос
     */
    public function isAjax(){
    return isset($_SERVER['HTTP_X_REQUESTED_WITH'])&&$_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

/**Подключаем вид при Ajax запросе
 * принимает вид $view, который должны подключить (Main/test)
 * $vars - параметры подключения
 * 
 */
     public function loadView($view, $vars=[]){
      //извлекаем из массива переменные
      extract($vars);
      // $view=test
      require APP."/views/{$this->route['controller']}/{$view}.php";

     }

}