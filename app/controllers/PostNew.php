<?php
//пользователь сможет вызавать методы и видеть их встроке, если есть дописка Action
class PostNew{
    public function indexAction(){
        echo 'PostNew::index';
    }
    public function testAction(){
        echo 'PostNew::test';
    }
    public function testPageAction(){
        echo 'PostNew::testPage';
    }
    //пользователь напрямую не сможет обратиться
    public function before(){
        echo 'PostNew::before';
    }
}