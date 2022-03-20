<?php
/**
 *  определяет, какой вид будет для метода конторллера
 *  $contrObj=new $controller(self::$route); 
 */
namespace vendor\core\base;

abstract class Controller{
 public $route=[];//маршрут
 public $view;
 public function __construct($route){
   $this->route=$route; 
   //$this->view=$route['action'];
   //include APP."/views/{$route['controller']}/{$route['action']}.php"; 
 }
}