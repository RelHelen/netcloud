<?php

namespace app\widgets\menu;

use fw\core\App;
use fw\core\Cache;
use app\models\AppModel;
use PDO;

class Menu
{
    protected $model; //подключаемая модель  
    protected $data; //массив меню
    protected $tree; //постоение дерева меню
    protected $menuHtml; //вывод html меню
    protected $tpl; //путь к шаблону для постоения кода меню
    protected $container = 'ul'; //в какой тег оборачиваем меню
    protected $class = 'menu'; //класс для $container
    protected $table = 'menu'; //подключаемая таблица меню
    protected $cacheTime = false; //время кеширования
    // protected $cacheTime = 3600;
    protected $cacheKey = 'asidemenu';
    protected $attrs = [];
    protected $prepend = '';

    public function __construct($options = [])
    {
        $this->model = new AppModel;
        $this->tpl = __DIR__ . '/menu_tpl/menu.php';
        $this->getOptions($options); //определим массив настроек, можно опрледелить пользователю
        $this->run();
    }
    /**
     * для возврата настроек меню
     */
    protected function getOptions($options)
    {
        foreach ($options as $key => $val) {
            //если свойство существует в нашем классе -this, то заполним его переданным значением -key
            if (property_exists($this, $key)) {
                $this->$key = $val;
            }
        }
        //debug($options);

    }

    //вызов
    protected function run()
    {
        //получаем массив данных из кеша
        $cache = Cache::instance();

        $this->menuHtml = $cache->get($this->cacheKey);
        //если нет в кеше
        if (!$this->menuHtml) {
            //то берем даные из контейнера параметров cats и записываем в кеш
            //контейнер сформировали в AppConroller
            $this->data = App::$app->getProperty('cats');
            //если нет данных
            if (!$this->data) {
                //// $this->data = $this->getCat();
                $this->data = $this->model->getAssoc("SELECT * FROM menu");
            }
            //debug($this->data);
            $this->tree = $this->getTree();
            //debug($this->tree);
            $this->menuHtml = $this->getMenuHtml($this->tree);
            //debug($this->menuHtml);
            //кешируем меню
            if ($this->cacheTime) {
                $cache->set($this->cacheKey, $this->menuHtml, $this->cacheTime);
            }
        }
        //выводим меню
        $this->outputMenu();
    }

    //обертка для вывода меню
    protected function outputMenu()
    {
        $attrs = '';

        if (!empty($this->attrs)) {
            //debug($this->attrs);
            foreach ($this->attrs as $k => $v) {
                $attrs .= " $k='$v' ";
            }
        };
        echo "<{$this->container} class='{$this->class}' $attrs>";
        echo $this->prepend; //дополнительно вставить опции в селекторе
        echo $this->menuHtml;
        echo "</{$this->container}>";
    }
    //формируем массив из меню
    public function getCat()
    {
        $res = $this->model->findFromModel();
        $cat = array();
        foreach ($res as $value) {
            $cat[$value['id']] = $value;
        }

        return $cat;
    }


    //формируем дерево из массива меню
    protected function getTree()
    {
        $tree = [];
        $dataset = $this->data;

        foreach ($dataset as $id => &$node) {
            //Если нет вложений
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
            } else {
                //Если есть потомки то перебераем массив
                $dataset[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }


    //построение html кода меню
    protected function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach ($tree as $id => $category) {
            //debug($category);

            $str .= $this->catToTemplate($category, $tab, $id);
        }
        return $str;
    }

    //отправка категории в шаблон
    protected function catToTemplate($category, $tab, $id)
    {
        ob_start();
        require $this->tpl; //подключаем шаблон
        return ob_get_clean();
    }
}
