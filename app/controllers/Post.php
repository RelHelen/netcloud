<?php
/**Зададим пространство имен namespace
 * это путь к классу начиная от корня нашего приложения
 * 
 */
namespace app\controllers;
class Post extends \vendor\core\base\Controller{
   

    public function indexAction(){
        debug($this->route);
        echo '<p>Post::index</p>';
    }

    public function testAction(){
        debug($this->route);
        echo "<p>Post::test</p>";
    }
}