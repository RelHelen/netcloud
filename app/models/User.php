<?php

namespace app\models;

use fw\core\base\Model;
use fw\core\Db;

class User extends Model
{
    public $table = 'users';
    public $pk = 'id';
    //поля ожидаем из формы для регистрации
    public $attributes = [
        'users_login' => '',
        'users_pass' => '',
        'users_mail' => '',
        'users_id_rol' => 3,
        'users_data_reg' => '',
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


    /**
     *получение id пользователя из users
     */
    public  function getIdUserByLogin($login)
    {
        $usersParam = [
            'login' => $login
        ];
        $user  = $this->getAssocArr("SELECT id FROM users WHERE users_login=:login LIMIT 1", $usersParam);
        return $user['id'];
    }
    /**
     * получение клиента по пользователю
     */
    public  function getIdCustomer($id)
    {
    }
    /**
     * проверка уникальности логина-почты
     */
    public  function checkUnique()
    {

        $params = [
            'login' => $this->attributes['users_login'],
            'mail' => $this->attributes['users_mail'],
        ];
        $user = $this->findBySql('SELECT * FROM users WHERE users_login =:login OR users_mail = :mail LIMIT 1', $params);
        // debug($user);
        // die;

        if ($user) {
            if ($user->login == $this->attributes['users_login']) {
                $this->errors['unique'][] = 'Этот логин уже занят';
            }
            if ($user->mail == $this->attributes['users_mail']) {
                $this->errors['unique'][] = 'Эта почта уже используется';
            }
            return false;
        }
        return true;
    }
    /**
     * Вставка строки в таблицу
     * @return
     */
    public function insertSingleRow($table)
    {
        $this->attributes['users_data_reg'] = date("Y-m-d H:i:s");
        $sql = "INSERT INTO $table ( 
                users_login,
                users_pass,
                users_mail,
                users_id_rol,
                users_data_reg                         
            )
            VALUES (
                :users_login,
                :users_pass,
                :users_mail,
                :users_id_rol,
                :users_data_reg               
            )";

        $params = [
            'users_login' => $this->attributes['users_login'],
            'users_pass' => $this->attributes['users_pass'],
            'users_mail' => $this->attributes['users_mail'],
            'users_id_rol' => $this->attributes['users_id_rol'],
            'users_data_reg' => $this->attributes['users_data_reg']
        ];

        // debug($this->attributes['users_data_reg']);
        // foreach ($params as $value) {
        //     echo gettype($value), "\n";
        // }
        // die;
        $res = $this->pdo->execute($sql, $params);
        $this->pdo->lastInsertId(); //номер последнего индекса
        return $res;
    }


    /**
     * логин
     * @param bool $isAdmin
     
     * проверка  логина с бд при авторизации
     */
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
                'login' => $login
            ];
            // debug($params);

            if ($isAdmin) {
                //авторизация админа для админки
                if (isset($_SESSION['user'])) {
                    // debug($_SESSION['user']);
                    unset($_SESSION['user']);
                };
                $params = [
                    'login' => $login,
                    'rol' => 2
                ];
                $user = $this->getAssocArr('SELECT * FROM users WHERE users_login=:login AND users_id_rol=:rol LIMIT 1', $params);
            } else {
                //авторизация обычного пользователя
                //из таблицы users получаем запись по  логину 
                $user =  $this->getAssocArr('SELECT * FROM users WHERE users_login=:login  LIMIT 1', $params);
            }
            if ($user) {
                //debug($user);
                //сравниваем пароль с hash паролем из бд таблицы users и создаем сессию
                if (password_verify($pass, $user['users_pass'])) {
                    foreach ($user as $key => $val) {
                        //ключ - название полей таблицы
                        if ($key == 'users_login' || $key == 'users_id_rol') {
                            $_SESSION['user'][$key] = $val;
                        }
                        if (!$isAdmin) {
                            //поиск клиента
                            $modelCustomers = new Customers;
                            $idCustomers = $modelCustomers->getIdCustomer($user['id']);
                            if ($idCustomers) {
                                $_SESSION['customer']['id'] = $idCustomers;
                            }
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

    //проверка что пользователь авторизован как user
    public static function isUser()
    {
        return (isset($_SESSION['user']) && $_SESSION['user']['users_id_rol'] == '3');
    }
}
