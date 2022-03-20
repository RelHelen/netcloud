<?php
/**Зададим пространство имен namespace
 * это путь к классу начиная от корня нашего приложения
 * 
 */
namespace app\controllers;
class Main{
    public function indexAction(){
        echo 'Main::index';
    }
}
