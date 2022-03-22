<?php
/** базовый класс подключения модели    
*/
namespace vendor\core\base;
use vendor\core\Db;

abstract class Model {
    protected $pdo;//подключение
    protected $table;//имя подключаемой таблицы
    protected $pk='id';// поле первичного ключа, по умолчанию id

    public function __construct()
    {
        $this->pdo=Db::instance();//вернем объект pdo подключения к бд
    }

    /**
     * выполняет sql запрос
     * например-поменять данные в таблице
     * возвращает true/false, не сами данные
     */
    
    public function query($sql){
        return $this->pdo->execute($sql);
    }

    /**
     * выборка всех данных в таблице $table  модели
     *  возвращает  данные запроса
     * */
    public function findAll(){
        $sql="SELECT * FROM {$this->table}" ; 
        return $this->pdo->query($sql); //вызвали метод query из класа DB  
    }

     /**
     * выборка одной записи в таблице $table  модели
     * $id - значение для поиска ('admin')
     * $fild - по какому полю будем выбирать данные (login)
     * login='admin'
     *  возвращает  данные запроса
     * */
    public function findOne($id,$fild=''){
        $fild=$fild ?: $this->pk;//если поле выборки задано, то ищем по нему, если нет, то ищем по ключю $pk=id

        //$this->sql="SELECT * FROM {$this->table} WHERE $fild = $id LIMIT 1" ;
        /* нельзя напрямую передавать внешний параметр $id ($fild = $id),который может прийти из строки браузера, он может быть зловредным скриптом, поэтому заменяем на спец. конструкцию $fild = ?
        неименованные (?) псевдопеременные
        */
        $sql="SELECT * FROM {$this->table} WHERE $fild = ? LIMIT 1" ;
        return $this->pdo->query($sql,[$id]); //вызвали метод query из класа DB  
    }

    /**
     * произвольный запрос
     * $sql - строка запроса
     * $params- - параметр запроса , что ищем
     *  
     *  возвращает  данные запроса
     * */
    public function findBySql($sql,$params=[]){        
        return $this->pdo->query($sql,$params); //вызвали метод query из класа DB  
    }

    /**
     * произвольный запрос
     *  $params - параметр запроса , что ищем  
     *  $field -  поле
     * $table - таблица
     *  возвращает  данные запроса
     * */
    public function findLike($params,$field, $table=''){   
        $table=  $table ?: $this->table;   
        $sql="SELECT * FROM $table WHERE $field LIKE ?" ;
        return $this->pdo->query($sql,['%'.$params.'%']); //вызвали метод query из класа DB  
    }

 }