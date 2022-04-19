<?php

namespace app\models;

use fw\core\base\Model;
use fw\core\Db;

class User extends Model
{
    public $table = 'users';
    public $pk = 'id';
    //для регистрации
    //поля формы
    public $attributes = [
        'login' => '',
        'pass' => '',
        'mail' => '',

    ];

    public $rules = [
        'required' => [
            ['login'],
            ['pass'],
            ['mail'],

        ],
        'email' => [
            ['mail'],
        ],
        'lengthMin' => [
            ['pass', 6],
        ],
    ];

    //проверка уникальности логина/почты
    public  function checkUnique()
    {
        $user = $this->findOne('users', 'login = ? OR mail = ? LIMIT 1', [
            $this->attributes['login'],
            $this->attributes['mail']
        ]);
        if ($user) {
            if ($user->login == $this->attributes['login']) {
                $this->errors['unique'][] = 'Этот логин уже занят';
            }
            if ($user->mail == $this->attributes['mail']) {
                $this->errors['unique'][] = 'Эта почта уже используется';
            }
            return false;
        }
        return true;
    }


    /**
     * логин
     * @param bool $isAdmin
     */
    //проверка  логина с бд при авторизации
    public  function isLogin($isAdmin = false)
    {
        $login = !empty(trim($_POST['login']))
            ? filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING)
            : null;
        $pass = !empty(trim($_POST['pass']))
            ? filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING)
            : null;

        if ($login && $pass) {

            $params = [
                'login' => $login,
                'pass' => $pass,
            ];

            if ($isAdmin) {
                //авторизация админа для админки
                $user = $this->row('SELECT * FROM users WHERE login=:login AND users_id_rol=:2 LIMIT 1', $params);

                //findOne('users', "login = ? AND users_id_rol = '2' LIMIT 1", [$login]);
            } else {
                //авторизация обычного пользователя
                //из таблицы users получаем запись по  логину 
                $user =  $this->row('SELECT * FROM users WHERE login=:login  LIMIT 1', $params);
                //debug($user);



                //R::findOne('users', 'login = ? LIMIT 1', [$login]);
            }

            if ($user) {
                debug($user);
                //сравниваем пароль с hash паролем из бд таблицы users
                if (password_verify($pass, $user->pass)) {

                    //передае данные в сессию без пароля
                    foreach ($user as $key => $val) {
                        //ключ - название полей таблицы
                        //$_SESSION['user'][id],$_SESSION['user'][login], $_SESSION['user'][mail],  
                        if ($key != 'pass') {
                            $_SESSION['user'][$key] = $val;
                        }
                    }
                    return true;
                }
            }
        }
        return false;
    }


    //проверка что пользователь авторизован как admin
    public static function isAdmin()
    {
        //если существует в сессии пользователь
        //и он является  администратором
        return (isset($_SESSION['user']) && $_SESSION['user']['users_id_rol'] == '2');
    }
}
