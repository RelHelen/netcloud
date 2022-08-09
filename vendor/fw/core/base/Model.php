<?php

/** базовый класс подключения модели  
 * необходим для обработки данных  
 */

namespace fw\core\base;

use PDO;
use fw\core\Db;

abstract class Model
{
    protected $pdo; //подключение
    protected $table; //имя подключаемой таблицы
    protected $pk = 'id'; // поле первичного ключа, по умолчанию id

    public $attributes = []; //идентичен полям форм базы данных
    public $errors = []; //ошибки валидации регистрации
    public $rules = []; //правила валидации


    public function __construct()
    {

        //вернем объект pdo подключения к бд
        $this->pdo = Db::instance();
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

    //метод загрузки данных в attributes с использованием имени таблицы 
    public function loadAtr($data, $table)
    { //запускаем цикл по атрибутам модели
        // debug($data);
        //debug($this->attributes);

        foreach ($this->attributes as $name => $value) {
            $nameData = str_replace($table . '_', '', $name);
            // echo $name . '   ' . $nameData . '<br>';
            if (isset($data[$nameData])) {
                //echo $name . "=" . $data[$name] . '<br>';
                $this->attributes[$name] = $data[$nameData];
                //debug($this->attributes);
            }
        }
    }

    //https://packagist.org/packages/vlucas/valitron
    //валидация даннных формы регистрации
    public function validate($data)
    {
        debug($data);
        \Valitron\Validator::lang('ru');
        $v = new \Valitron\Validator($data);
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
        //debug($this->errors);
        //die;
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
     * Запускает подготовленный запрос на выполнение
     * например-поменять данные в таблице
     * Традиционные SQL-позиционные заполнители, представленные как ?
     * возвращает true/false, не сами данные
     */

    public function queryExe($sql, $params = [])
    {
        return $this->pdo->execute($sql, $params);
    }

    /**
     *для  в sql запросов
     
     */

    public function query($sql)
    {
        return $this->query($sql);
    }

    /**выборка всех  записей из таблицы модели
     * без параметра
     *  возвращает список данные запроса
     * */

    public function findFromModel()
    {
        $sql = "SELECT * FROM {$this->table}";
        $result = $this->pdo->st_query($sql); //вызвали метод query из класа DB  
        return  $result->fetchAll(PDO::FETCH_ASSOC); //список
    }

    /**выборка всех  записей из таблицы модели или любой таблицы
     * без параметра
     *  возвращает список данные запроса
     * find()
     * find('', 'LIMIT 1')
     * find('users', 'LIMIT 1')
     * */
    public function find($table = '', $sql = '')
    {
        $table = $table ?: $this->table;

        $params = [];
        $result = $this->pdo->st_query("SELECT * FROM `$table` " . $sql);
        return  $result->fetchAll(PDO::FETCH_ASSOC); //список
    }

    /**
     * выборка одной записи в таблице $table  модели
     * с параметром безпозиционным ?
     * $val - значение для поиска ('admin')
     * $fild - по какому полю будем выбирать данные (login)
     * login='admin'
     *  возвращает  данные запроса
     * */
    public function findOne($fild = '', $val)
    {
        $fild = $fild ?: $this->pk; //если поле выборки задано, то ищем по нему, если нет, то ищем по ключю $pk=id 

        //WHERE $fild = $val 
        // $user =  $this->findOne('login', $login); 

        $sql = "SELECT * FROM {$this->table} WHERE $fild = ? LIMIT 1";
        return $this->pdo->st_query($sql, [$val]); //вызвали метод query из класа DB  
    }


    /**выборка всех записей в произвольной таблице $table  
     * запрос с именованными параметрами :     
     *  возвращает список данные запроса
     * findAll('users','WHERE users_login =:login OR users_mail = :mail', $params);
     * findAll('contracts');
     * */
    public function findAll($table = '', $sql = '', $params = [])
    {

        $table =  $table ?: $this->table;
        $result = $this->pdo->db_query("SELECT * FROM `$table` " . $sql, $params);
        // debug($result);

        return  $result->fetchAll(PDO::FETCH_ASSOC); //список
    }

    /**
     * выборка  записей  
     * с параметром безпозиционным ?      
     *  возвращает  данные запроса
     * */

    public function findSql($sql, $val = [])
    {
        return $this->pdo->st_query($sql, $val); //вызвали метод query из класа DB  
    }
    //произвольный запрос c позиционным ? параметром
    // public  function dbQuery($sql, $params = [])
    // {
    //     // $query = $this->pdo->query($sql);
    //     $query =  $this->pdo->st_query($sql, $params);

    //     return  $query;
    // }
    /**
     * произвольный запрос 
     * c именованными парамтерами :
     * $sql - строка запроса
     * $params- - параметр запроса , что ищем
     *  
     *  Возвращает массив, содержащий все строки результирующего набора
     * findBySql('SELECT * FROM users WHERE users_login =:login OR users_mail = :mail LIMIT 1', $params);
     * */
    public function findBySql($sql, $params = [])
    {

        $result = $this->pdo->db_query($sql, $params);
        return  $result->fetchAll(PDO::FETCH_ASSOC); //список
    }

    /**
     * произвольный запрос
     *  $params - параметр запроса , что ищем  
     *  $field -  поле
     *  $table - таблица
     *  возвращает  данные запроса
     * */
    public function findLike($params, $field, $table = '')
    {
        $table =  $table ?: $this->table;
        $sql = "SELECT * FROM `$table` WHERE $field LIKE ?";
        return $this->pdo->st_query($sql, ['%' . $params . '%']); //вызвали метод query из класа DB  
    }

    //возвращает ассотиативный массив массивов
    // getAssoc("SELECT * FROM {$this->table}");
    // getAssoc("SELECT * FROM menu");
    public  function getAssoc($sql, $params = [])
    {
        $result = $this->pdo->db_query($sql, $params);
        $res = $result->fetchAll(PDO::FETCH_ASSOC); //список

        $cat = array();
        foreach ($res  as $value) {
            $cat[$value['id']] = $value;
        }

        return $cat;
    }
    /**
     * возвращает массив
     */
    public  function getAssocArr($sql, $params = [])
    {
        $result = $this->pdo->db_query($sql, $params);
        $res = $result->fetchAll(PDO::FETCH_ASSOC); //список

        $cat = array();
        foreach ($res  as $value) {
            $cat = $value;
        }
        return $cat;
    }


    public  function insertRow($table)
    {
        $sql = "INSERT into `$table` set ";
        foreach (array_keys($this->attributes) as $name) {
            $columns[] = "`$name`=?";
        }
        //implode — Объединяет элементы массива в строку
        $st = $this->pdo->prepare($sql . implode(",", $columns));
        $st->execute(array_values($this->attributes));
    }

    //подсчет количества
    public  function count($table, $sql = '')
    {

        // $query =  $this->query("SELECT id FROM `$table` " . $sql);
        $query =  $this->pdo->db_query("SELECT id FROM `$table` " . $sql);
        $members = $query->rowCount();
        return  $members;
    }

    /**
     * query() — возвращает mysqli resource. Может использоваться традиционно, с fetch() и т.д.
     *getOne() — возвращает скаляр, первый элемент первой строки результата
     *getRow() — одномерный массив, первую строку результата
     *getCol() — одномерный массив скаляров — колонку таблицы
     *getAll() — двумерный массив, индексированный числами по порядку
     *getInd() — двумерный массив, индексированный значениями поля, указанного первым параметром
     *getIndCol() — массив скаляров, индексированный полем из первого параметра. Незаменимо для составления словарей вида key => value

     */
}
