<?php
/**Зададим пространство имен namespace
 * это путь к классу начиная от корня нашего приложения
 * 
 */
namespace app\controllers;
class Post{
    public function indexAction(){
        echo 'Post::index';
    }
    public function testAction(){
        echo 'Post::test';
    }
}