<?php
//подключение к бд
namespace vendor\core;
/**
 * позволяет создает один защищенный  объект
 */
class Db {
    protected $pdo;//объект подключение
    protected static $instance;
    public static $countSql=0;//количество запросов
    public static $queries=[];//сохраняем ВСЕ наши запросы

    protected function __construct(){
        $db=require ROOT.'/config/config_bd.php';//получит массив из файла настроек
        $options=[
            \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE=>\PDO::FETCH_ASSOC,// в каком формате будем получать данные - ассоциативный массив

        ];
        $this->pdo=new \PDO($db['dsn'],$db['user'],$db['pass'],$options);//указатель на открытое подключение
    }

    /**
     *создаем подключение , если его нет, иначе соединение не создается
     *возвращает подключение к бд
     */
    public static function instance(){
        //если значение отсутсвует то создаем объект данного класса
        if(self::$instance===NULL){
            self::$instance=new self;
        }
        return self::$instance;
    }

    /**
     *для проверки выполнения sql запросов
     * например для создания/изменения таблиц
     * @var $sql string
     * return true/false 
     */
    public function execute($sql,$params=[]){
        self::$countSql++;//подсчет запросов
        self::$queries[]=$sql;//сохраняем запросы
        $stmt=$this->pdo->prepare($sql);
        //prepare -Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект. Если СУБД успешно подготовила запрос, PDO::prepare() возвращает объект PDOStatement. Если подготовить запрос не удалось, PDO::prepare() возвращает false или выбрасывает исключение

        return $stmt->execute($params); 
        // execute - запускает подготовленный запрос на выполнение (Возвращает true в случае успешного выполнения или false в случае возникновения ошибки)
    }

    /**
     *для  выполнения sql запросов
     * @var $sql string
     * return array выборка из базы
     */
    public function query($sql,$params=[]){
        self::$countSql++;//подсчет запросов
        self::$queries[]=$sql;//сохраняем запросы
        $stmt=$this->pdo->prepare($sql);//Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект
        $res=$stmt->execute($params); //запускает подготовленный запрос на выполнение 

        //если данные есть, возвращаем их
        if($res !== false){
            return $stmt->fetchAll(); 
        }
        return [];
    }


 }