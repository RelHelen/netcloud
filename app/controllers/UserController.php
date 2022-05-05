<?php

/**
 * Пользователи * 
 * https://yandex.ru/video/preview/?filmId=3362678052779958829&from=tabbar&parent-reqid=1647610302540339-9713605756647213479-sas2-0989-48a-sas-l7-balancer-8080-BAL-7054&text=Урок%2018.%20%20Создание%20собственного%20фреймворка.%20%20Админка.%20%20Часть%201&url=http%3A%2F%2Ffrontend.vh.yandex.ru%2Fplayer%2FvtRhy6beELgY
 */

namespace app\controllers;

use fw\core\Db;
use app\models\User;
use fw\core\base\View;


class UserController extends AppController
{
    //регистрация
    public function singupAction()
    {
        // $this->setMeta('Регистрация');
        $this->setTitle('');
        if (!empty($_POST)) {
            //  debug($_POST);
            //  die;

            //создаем объект модели
            $user = new User();
            $data = $_POST;
            $table = $user->table; //'users'
            // die;
            $user->loadAtr($data, $table); //для формирования [] атрибуттов из полей формы


            //не валидны
            if (!$user->validate($data) || !$user->checkUnique()) {
                //получили ошибки
                $user->getErrors();
                //запоминаем, что вводил пользователь
                $_SESSION['form_data'] = $data;
                redirect();
            }

            //если данные валидны кодируем пароль
            $user->attributes['users_pass'] = password_hash(
                $user->attributes['users_pass'],
                PASSWORD_DEFAULT
            );

            if ($user->insertSingleRow('users') > 0) {
                $_SESSION['success'] = "Вы успешно зарегестрировались";
            } else {
                $_SESSION['error'] = "Ошибка! Попробуйте позже";
                // unset($_SESSION['error']);
            }
            redirect();
            //debug($user);
            //debug($_POST); 
            //die; 
        }
    }
    //авторизация
    public function loginAction()
    {
        // $this->setMeta('Авторизация');
        $this->setTitle('');
        //если данные пришли POST то проверяем их
        if (!empty($_POST)) {
            //создаем объект модели
            $user = new User();
            if ($user->isLogin()) {
                $_SESSION['success'] = "Вы успешно авторизованы";
                redirect(PATH);
                //сделать переход на страницу                 
            } else {
                $_SESSION['error'] = "Логин/пароль введены неверено";
                // unset($_SESSION['error']);
                redirect();
            }
        }
    }
    //выход
    public function logoutAction()
    {
        $this->setMeta('Выход');
        if (isset(($_SESSION['user']))) {
            unset($_SESSION['user']);
        }
        redirect(PATH . 'user/login');
    }
}
