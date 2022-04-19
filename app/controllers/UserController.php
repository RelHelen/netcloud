<?php

/**
 * Пользователи * 
 */

namespace app\controllers;

use app\models\User;
use fw\core\base\View;
use fw\core\Db;

class UserController extends AppController
{
    //регистрация
    public function singupAction()
    {
        View::setMeta('Регистрация');
        $this->setTitle('Форма регистрации');
        if (!empty($_POST)) {
            //создаем объект модели
            $user = new User();
            $data = $_POST;
            $user->load($data);

            //не валидны
            if (!$user->validate($data) || !$user->checkUnique()) {
                $user->getErrors();
                //запоминаем, что вводил пользователь
                $_SESSION['form_data'] = $data;
                redirect();
            }

            //если данные валидны кодируем пароль
            $user->attributes['pass'] = password_hash(
                $user->attributes['pass'],
                PASSWORD_DEFAULT
            );

            if ($user->save('users')) {
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
        View::setMeta('Авторизация');
        $this->setTitle('Форма авторизации');
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
        View::setMeta('Выход');
        if (isset(($_SESSION['user']))) {
            unset($_SESSION['user']);
        }
        redirect(PATH . 'user/login');
    }
}
