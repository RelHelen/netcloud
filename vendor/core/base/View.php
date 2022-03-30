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

    /** 
     *  мета данные
     *  @var array
    */
    public static  $meta=['title'=>'','desc'=>'','keywords'=>''];
    public  $title;

    /** 
     *  для хранения регуляроного выражения
     * скриптов
     *  @var array
    */
    public $scripts=[];




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
      public function render($title,$vars) {  
          if(is_array($vars)){ 
              extract($vars);//извлекаем массив и создаем обноименные переменные поимени ключей 
          } 
            $this->title=$title;
          //echo    $this->title;    
          $file_view = APP . "/views/{$this->route['controller']}/{$this->view}.php";
          ob_start();//буфиризация, все что ниже будет помещено в буфер обмена
                //echo "<p>файл вида : </p>";
                //debug($file_view);
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
            //echo "<p>файл шаблона : </p>";
            //debug($file_layout);
            if(is_file($file_layout)){  
                     // для удаления скриптов и перемещения их в подвал $this->scripts[0]
                    $content=$this->getScripts($content);//почистит от всех скипты в контенте, еслии были          
                    $scripts=[];
                    if(!empty($this->scripts[0])){
                        $scripts=$this->scripts[0];
                        }; //далее выводим их в default
               require $file_layout;//подключение шаблона
               }else{
                   echo "<p>Шаблон <b>$file_layout<b> не найден </p>";
               }  
         }
      }

      //для вырезнаия скриптов на странице и добавлнеия их в подвале
  protected function getScripts($content){
    $pattern="#<script.*?>.*?</script>#si";
    preg_match_all($pattern,$content,$this->scripts);
    if(!empty($this->scripts)){
        $content=preg_replace($pattern,'',$content);
    }
    return $content;
  }

  //Возвращает метаданные
  public static function getMeta(){
    echo
    '<title>'.self::$meta['title'].'</title> 
<meta name="description" content="'.self::$meta['desc'].'">
<meta name="keywords" content="'.self::$meta['keywords'].'">';
  }

  //Устанавливает метаданные
  public static function setMeta($title='',$desc='',$keywords=''){
   self::$meta['title']=$title;
   self::$meta['desc']=$desc;
   self::$meta['keywords']=$keywords;
  }



    

}