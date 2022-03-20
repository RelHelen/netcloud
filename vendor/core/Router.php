<?php
/**
 * Router
 */
/**Зададим пространство имен
 * это путь к классу начиная от корня нашего приложения
 * 
 */
namespace vendor\core;
class Router {    
    /**
    * массив:  таблица маршрутов    
    *  @var array
    */
    protected static $routes=[];

    /**массив: текущий маршрут
    * один текущий маршрут по текущему url адресуic 
    *  @var array
    */
    protected static $route=[];

    /** метод:добавляем маршруты в таблицу маршрутов
     * в маршруте указывается контроллер и метод     
     * @param string $regex - регулярное выражение маршрута, строка url
     * @param array $route - маршрут :[controller] => Posts, [action] => index
     */        
    public static function add($regexp,$route = []){
        self::$routes[$regexp]=$route;
    }

   /**метод:возвращаем маршруты которые есть
    * @return array
    */
    public static function getRoutes(){
        return self::$routes;
    }

    /**метод: возвращает текущий маршрут
     * @return array
     * */
    public static function getRoute(){
        return self::$route;
    }

    /**метод: поиск пути
     * поиск url на совпадение из массива маршрутов
     * @param string $url - входящий url
     * @return boolean
     * */
    public static function matchRoute($url){
        foreach(self::$routes as $pattern => $route){
            if (preg_match("#$pattern#i",$url,$matches)){            
                debug($matches);
                foreach($matches as $key=>$val){
                    if(is_string($key)){
                        $route[$key]=$val;
                    }
                }
                if(!isset($route['action'])){$route['action']='index';};
                self::$route=$route; //текущий маршрут буде равен $route [controller] => Posts [action] => add )
                debug($route);
                return true;//адрес  найден 
            }          
        }
        return false;  //адрес не найден     
    }

    /**метод: перенаправляет url по корректному маршруту $controller   
     * @param string $url - входящий url
     * return  void - ничего не возвращате
     * */
    public static function dispatch($url){
        if(self::matchRoute($url)){
            //в  $controller помещаем реззульат контроллера
            //$controller=self::$route['controller'];
            $controller=self::upperCamelCase(self::$route['controller']);          
            if(class_exists($controller)){                
                $contrObj=new $controller;                
                $action = self::lowerCamelCase(self::$route['action']).'Action';
                //debug($contrObj);
                //если метод  $action сущекствует у объекта $contrObj, то запустим его
                if (method_exists($contrObj, $action)) {
                    $contrObj->$action();                    
                } else{
                    echo "<p>метод $controller::$action не найден</p>";
                }        
                //echo 'ok';
            }else{
                echo "<p>контроллер $controller не найден</p>";
            }
           
        }else{
            http_response_code(404);//адрес не найден 
            include '404.php';
        }
    }


     /**метод: преобразовывает имя контролеера в заглавные символы
      *  текст вида page-new в  PageNew
     * @param string $name - входящий url
     * @return  void - ничего не возвращате
     * */
    protected static function upperCamelCase($name){
        $name = str_replace('-',' ',$name);
        $name = ucwords($name);
        $name = str_replace(' ','',$name);
        //debug($name);
        return $name;
    }

    /**метод: преобразовывает имя метода 2 слово в заглавные символы
      *  текст вида page-test в  pageTest
     * @param string $name - входящий url
     * @return  void - ничего не возвращате
     * */
    protected static function lowerCamelCase($name){
        return lcfirst(self::upperCamelCase($name));    
        
    }

}