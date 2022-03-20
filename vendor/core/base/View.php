<?php
/**базовый класс вида 
 *  
 *  
 */
namespace vendor\core\base;
class View {
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

    public function __construct($route,$layout='',$view=''){
    
        $this->route=$route; 
        if ($layout===false){
            $this->layout=false;//если не надо подключать шаблоны
        }else{
            $this->layout=$layout ?: LAYOUT; //если был передан шаблон , то использеум его , если нет , то испольлзуем LAYOUT(default)
        }
        
        $this->view=$view;      
      }
      
      /**
       * подключаем файл вида
       * $file_view - путь к текущему виду
       */
      public function render($vars) {  
          if(is_array($vars)){ 
              extract($vars);//извлекаем массив и создаем обноименные переменные поимени ключей 
          }       
          $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";
          ob_start();//буфиризация, все что ниже будет помещено в буфер обмена
                echo "<p>файл вида : </p>";
                debug($file_view);
                if(is_file($file_view)){              
                    require $file_view;
                }else{
                    echo "<p>Вид <b>$file_view<b> не найден </p>";
                }
         $content=ob_get_clean(); //очищает буфер обмена и складывает в $content
         //echo  $content;

         //подключаем шаблон 
         if(false !==$this->layout){
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            echo "<p>файл шаблона : </p>";
            debug($file_layout);
            if(is_file($file_layout)){              
               require $file_layout;
               }else{
                   echo "<p>Шаблон <b>$file_layout<b> не найден </p>";
               }  
         }
           

      }

}