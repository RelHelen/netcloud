<?php
namespace vendor\core;
/**
 * 
 * $objects - контейнер для хранения объектов (new $components), 
 * $objects[$name]-имя объекта 
 */
class Registry{

 public static $objects=[];
 protected static $instance;
 
 protected function  __construct(){
      //require_once ROOT.'/config/config.php';
      require ROOT.'/config/config.php';
    //var_dump($config);
 	 
 	foreach($config['components'] as $name=>$component){
 		self::$objects[$name] = new $component;
 	}
 }

 /**
     *создаем подключение , если его нет, иначе соединение не создается
     *возвращает подключение к бд
     */
    public static function instance(){
        //если значение отсутсвует то создаем объект данного класса
        if(self::$instance===NULL){
            self::$instance=new self;
        }
        return self::$instance;
    }
//магический метод
    //вызываются атоматически , если происходит 
    //обращение к неизвестному свойству
    // например, App->test; - неизвестное свойство
    //возвращает объект
    public function __get($name){
    	//что будет делать класс, при обращении к несуществующему свойству-вернуть сам объект
		//если это объект - вернет этот объект
		if(is_object(self::$objects[$name])){
			return self::$objects[$name];
		}
    }
    //позволяет помещать объекты в контейнер $objects
    //позволяет записать при обращение к неопределенному свойству объекта
    //возвращает новый объект 
     public function __set($name,$object){
     	//если объекта нет в контейнере
     	if(!isset(self::$objects[$name])){
     		self::$objects[$name]=new $object;
     	}
    }


    //выводит все объекты
    public function getList(){
    	echo "<pre>";
    	var_dump(self::$objects);
    	echo "</pre>";
    }
}
