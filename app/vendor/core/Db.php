<?php
//подключение к бд
namespace app\vendor\core;

use PDO;

/**
 * позволяет создает один защищенный  объект
 */
class Db
{
    protected $pdo; //объект подключение
    protected static $instance;
    public static $countSql = 0; //количество запросов
    public static $queries = []; //сохраняем ВСЕ наши запросы

    protected function __construct()
    {
        $db = require APP . '/config/config_bd.php'; //получит массив из файла настроек
        //debug($db);
        /*
        [
            [dsn] => mysql:host=localhost;dbname=cloud_db;charset=utf8
            [user] => root
            [pass] => 
        ]

        */
        /*
        $options = [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC, // в каком формате будем получать данные - ассоциативный массив
            // PDO::ERRMODE_EXCEPTION- ошибки будут вызывать исключения и остановку скрипта
        ];
        */

        //$this->pdo = new \PDO($db['dsn'], $db['user'], $db['pass'], $options); //указатель на открытое подключение

        try {
            // подключаемся к серверу
            $this->pdo = new PDO($db['dsn'], $db['user'], $db['pass'], $db['options']);

            //echo "Database connection established";
        } catch (PDOException $e) {

            // echo "Connection failed: " . $e->getMessage();

        }
    }

    /**
     *создаем подключение , если его нет, иначе соединение не создается
     *возвращает подключение к бд
     */
    public static function instance()
    {
        //если значение отсутсвует то создаем объект данного класса
        if (self::$instance === NULL) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     *для проверки выполнения sql запросов
     * например для создания/изменения таблиц
     * @var $sql string
     * return true/false 
     */
    public function execute($sql, $params = [])
    {
        self::$countSql++; //подсчет запросов
        self::$queries[] = $sql; //сохраняем запросы
        $stmt = $this->pdo->prepare($sql);
        /*
      prepare -Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект. Если СУБД успешно подготовила запрос, PDO::prepare() возвращает объект PDOStatement. Если подготовить запрос не удалось, PDO::prepare() возвращает false или выбрасывает исключение
```*/
        return $stmt->execute($params);
        /*      execute - запускает подготовленный запрос на выполнение (Возвращает true в случае успешного выполнения или false в случае возникновения ошибки)
    */
    }

    /**
     *для  выполнения sql запросов
     * @var $sql string
     * return array выборка из базы
     */
    public function db_query($sql, $params = [])
    {
        self::$countSql++; //подсчет запросов
        self::$queries[] = $sql; //сохраняем запросы

        //от sql-инъекций
        $stmt = $this->pdo->prepare($sql); //Подготавливает запрос к выполнению и возвращает связанный с этим запросом объект

        // error_log("[" . date('Y-m-d H:i:s') . "] Запросы : {$sql}   } \n ====****=====================\n", 3, APP . '/tmp/errorbd.log');
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                //echo '<p>' . $key . ' : ' . $val . '</p>';
                $stmt->bindValue(':' . $key, $val);
            }
        }
        //debug($stmt);
        $res = $stmt->execute();

        //$res = $stmt->execute($params); //запускает подготовленный запрос на выполнение 


        //     //если данные есть, возвращаем их
        if ($res !== false) {
            return $stmt;
            //return $stmt->fetchAll();
        }
        return [];
    }

    public function row($sql, $params = [])
    {
        $result = $this->db_query($sql, $params);

        return  $result->fetchAll(PDO::FETCH_ASSOC); //список

    }


    public function column($sql, $params = [])
    {
        $result = $this->db_query($sql, $params);
        return  $result->fetchColumn(); //столбец
    }
}
