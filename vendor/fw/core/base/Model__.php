<?php

/** базовый класс подключения модели    
 */

namespace fw\core\base;

use PDO;
use fw\core\Db;
//use fw\vlucas\valitron\src\Valitron;

//app\vendor\vlucas\valitron\src\Valitron\Validator.php
abstract class Model
{
    protected $pdo; //подключение
    protected $table; //имя подключаемой таблицы
    protected $pk = 'id'; // поле первичного ключа, по умолчанию id

    public $attributes = []; //из массива пользователя при регистрации
    public $errors = []; //ошибки валидации регистрации
    public $rules = []; //правила валидации


    public function __construct()
    {
        //echo 'подключена Model ';

        $this->pdo = Db::instance(); //вернем объект pdo подключения к бд

    }
    //метод загрузки данных в attributes 
    public function load($data)
    {
        foreach ($this->attributes as $name => $value) {
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }
    //метод сохранения данных
    public function save($table)
    {
        $tbl = \R::dispense($table); //создание объекта таблицы
        foreach ($this->attributes as $name => $value) {
            $tbl->$name = $value;
        }
        return \R::store($tbl); //сохраням объект
    }
    //валидация даннных формы регистрации
    public function validate($data)
    {
        // Valitron\Validator::lang('ru');
        $v = new Valitron\Validator($data);
        $v->rules($this->rules);
        if ($v->validate()) {
            return true;
        } else {
            $this->errors = $v->errors();
            return false;
        }
    }
    //вывод ошибок при валидации
    public function getErrors()
    {
        $errors = '<ul>';
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li>$item</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['error'] = $errors;
    }
    /**
     * выполняет sql запрос
     * например-поменять данные в таблице
     * возвращает true/false, не сами данные
     */

    public function query($sql, $params = [])
    {

        return $this->pdo->execute($sql);
    }

    /**
     * выборка всех данных в таблице $table  модели
     *  возвращает  данные запроса
     * */
    public function findAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        return $this->pdo->db_query($sql); //вызвали метод query из класа DB  
    }

    /**
     * выборка одной записи в таблице $table  модели
     * $id - значение для поиска ('admin')
     * $fild - по какому полю будем выбирать данные (login)
     * login='admin'
     *  возвращает  данные запроса
     * */
    public function findOne($id, $fild = '')
    {
        $fild = $fild ?: $this->pk; //если поле выборки задано, то ищем по нему, если нет, то ищем по ключю $pk=id

        //$this->sql="SELECT * FROM {$this->table} WHERE $fild = $id LIMIT 1" ;
        /* нельзя напрямую передавать внешний параметр $id ($fild = $id),который может прийти из строки браузера, он может быть зловредным скриптом, поэтому заменяем на спец. конструкцию $fild = ?
        неименованные (?) псевдопеременные
        */
        $sql = "SELECT * FROM {$this->table} WHERE $fild = ? LIMIT 1";
        return $this->pdo->db_query($sql, [$id]); //вызвали метод query из класа DB  
    }

    /**
     * произвольный запрос
     * $sql - строка запроса
     * $params- - параметр запроса , что ищем
     *  
     *  возвращает  данные запроса
     * */
    public function findBySql($sql, $params = [])
    {
        return $this->pdo->db_query($sql, $params); //вызвали метод query из класа DB  
    }

    /**
     * произвольный запрос
     *  $params - параметр запроса , что ищем  
     *  $field -  поле
     * $table - таблица
     *  возвращает  данные запроса
     * */
    public function findLike($params, $field, $table = '')
    {
        $table =  $table ?: $this->table;
        $sql = "SELECT * FROM $table WHERE $field LIKE ?";
        return $this->pdo->db_query($sql, ['%' . $params . '%']); //вызвали метод query из класа DB  
    }
}
