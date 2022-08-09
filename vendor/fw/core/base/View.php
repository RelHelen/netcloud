<?php

/**базовый класс вида 
 *  
 *  
 */

namespace fw\core\base;

class View
{

    /** 
     *  текущий маршрут и парметры (controller,action,params)
     *  @var array
     */
    public $route = [];

    /** 
     *  текущий вид  
     *  @var string
     */
    public $view;
    /** 
     *  текущий контроллер  
     *  @var string
     */
    public $controller;
    /** 
     *  текущий  шаблон
     *  @var string
     */
    public $layout;

    /** 
     *  мета данные
     *  @var array
     */
    public   $meta = [
        'title' => '',
        'desc' => '',
        'keywords' => ''
    ];
    public  $vars = [];
    public  $title = '';
    public $prefix;

    /** 
     *  для хранения регуляроного выражения
     * скриптов
     *  @var array
     */
    public $scripts = [];

    public function __construct($route, $layout = '', $view = '', $meta, $title)
    {

        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $view;
        $this->prefix = $route['prefix'];
        $this->meta = $meta;
        $this->title = $title;

        if ($layout === false) {
            $this->layout = false; //если явно не надо подключать шаблоны
        } else {
            $this->layout = $layout ?: LAYOUT; //если был передан шаблон , то использеум его , если нет , то испольлзуем LAYOUT(default)
        }
    }

    /**
     * подключаем файл вида
     * $file_view - путь к текущему виду
     */
    public function render($vars)
    {
        //меняем префикс на прямой для корректной работы в линукс  
        $this->route['prefix'] = str_replace('\\', '/', $this->route['prefix']);
        if (is_array($vars)) {
            extract($vars); //извлекаем массив и создаем оlноименные переменные поимени ключей 
        }

        //echo    $this->title;    
        $file_view = APP . "/views/{$this->route['prefix']}{$this->route['controller']}/{$this->view}.php";

        //echo "<p>файл вида : </p>";
        //debug($file_view);
        if (is_file($file_view)) {
            //буфиризация, все что ниже будет помещено в буфер обмена
            ob_start();
            require_once $file_view;
            //очищает буфер обмена и складывает в $content
            $content = ob_get_clean();
        } else {
            throw new \Exception(" Вид <b>$file_view<b> не найден  ", 404);
        }



        //подключаем шаблон 
        if (false !== $this->layout) {
            $file_layout = APP . "/views/layouts/{$this->layout}.php";
            //echo "<p>файл шаблона : </p>";
            //debug($file_layout);
            if (is_file($file_layout)) {
                // для удаления скриптов и перемещения их в подвал $this->scripts[0]
                $content = $this->getScripts($content); //почистит от всех скипты в контенте, еслии были          
                $scripts = [];
                if (!empty($this->scripts[0])) {
                    $scripts = $this->scripts[0];
                }; //далее выводим их в default
                require $file_layout; //подключение шаблона
            } else {

                throw new \Exception(" Шаблон <b>$file_layout<b> не найден  ", 404);
            }
        }
    }


    //для вырезнаия скриптов на странице и добавлнеия их в подвале
    protected function getScripts($content)
    {
        $pattern = "#<script.*?>.*?</script>#si";
        preg_match_all($pattern, $content, $this->scripts);
        if (!empty($this->scripts)) {
            $content = preg_replace($pattern, '', $content);
        }
        return $content;
    }

    public function getMeta()
    {
        $output = '<title>' . $this->meta['title'] . '</title>' . PHP_EOL;
        $output .= '<meta name="description" content="' . $this->meta['desc'] . '">' . PHP_EOL;
        $output .= '<meta name="keywords" content="' . $this->meta['keywords'] . '">' . PHP_EOL;
        return $output;
    }



    //подключение отдельных частей страницы
    public  function getPart($file)
    {
        $file = APP . "/views/inc/{$file}.php";
        // echo "<p>вставляемый файл : </p>";
        // debug($file);
        if (is_file($file)) {

            require_once $file; //подключение 
        } else {
            // echo "<p>Файл <b>{$file}<b> не найден </p>";
            throw new \Exception(" Файл <b>$file<b> не найден  ", 404);
        }
    }
}
