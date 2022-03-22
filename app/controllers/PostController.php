<?php
/**Зададим пространство имен namespace
 * это путь к классу начиная от корня нашего приложения
 * 
 */
namespace app\controllers;
class PostController extends AppController{   

    public function indexAction(){
        debug($this->route);
        echo '<p>Post::index</p>';
    }

    public function testAction(){
        debug($this->route);
        echo "<p>Post::test</p>";
    }
}