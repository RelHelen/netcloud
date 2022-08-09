<?php
//подключение к бд
namespace fw\core;

use PDO;

/**
 * позволяет создает один защищенный  объект
 */
class Db
{
    protected $pdo; //объект подключение
    private static $instance;
    public static $countSql = 0; //количество запросов
    public static $queries = []; //сохраняем ВСЕ наши запросы

    protected function __construct()
    {
        $db = require_once CONF . '/config_bd.php'; //получит 

        try {
            // подключаемся к серверу
            $this->pdo = new PDO($db['dsn'], $db['user'], $db['pass'], $db['options']);

            //echo "Database connection established";

        } catch (PDOException $e) {

            throw new \Exception("Нет соединения с БД", 500);
        }
    }

    /**
     *создаем подключение , если его нет, иначе соединение не создается
     *возвращает подключение к бд instance
     */
    use TSingletone;    //патерн

    public function query($stmt)
    {
        return $this->query($stmt);
    }
    /**
     * @param $stmt
     * @return PDOStatement
     */
    public function prepare($stmt)
    {
        return $this->prepare($stmt);
    }

    /**
     * @param $query
     * @return int
     */
    public function exec($query)
    {
        return $this->execute($query);
    }

    /**
     * @return string
     */
    public function lastInsertId()
    {
        return $this->pdo->lastInsertId();
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
     *подготовливает и выполняет запрос с позиционными параметрами ?
     * @var $sql string
     * return результат запроса
     */
    public function st_query($sql, $params = [])
    {

        $stmt = $this->pdo->prepare($sql);
        if ($params) {
            $res = $stmt->execute($params);
        } else {
            $res = $stmt->execute();
        }
        $res = $stmt->execute($params);
        if ($res !== false) {
            return $stmt;
        }
        return [];
    }

    /**
     *подготовливает и выполняет запрос с именованными параметрами
     * @var $sql string
     * return успешность запроса 
     */
    public function db_run($sql, $params = [])
    {
        try {
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
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
    /**
     *подготовливает и выполняет запрос с именованными параметрами
     * @var $sql string
     * return результат запроса
     */
    public function db_query($sql, $params = [])
    {

        self::$countSql++; //подсчет запросов
        self::$queries[] = $sql; //сохраняем запросы

        $stmt = $this->pdo->prepare($sql);
        if (!empty($params)) {
            foreach ($params as $key => $val) {
                //echo '<p>' . $key . ' : ' . $val . '</p>';
                $stmt->bindValue(':' . $key, $val);
            }
        }
        if ($params) {
            $res = $stmt->execute($params);
        } else {
            $res = $stmt->execute();
        }

        if ($res !== false) {
            return $stmt;
        }
        return [];
    }
    /**
     * Извлечение следующей строки из результирующего набора
     * @param $query
     * @param array $args
     * @return mixed
     */

    public function getRow($sql, $params = [], $type = PDO::FETCH_ASSOC)
    {
        $result = $this->db_query($sql, $params);
        // echo "findRow";
        // debug($result);
        return  $result->fetch($type); //список

    }
    /**
     * Возвращает массив, содержащий все строки результирующего набора
     * @param $query
     * @param array $args
     * @return array
     */

    public function getRows($sql, $params = [])
    {
        $result = $this->db_query($sql, $params);
        // echo "row:";
        // debug($result);
        return  $result->fetchAll(PDO::FETCH_ASSOC); //список

    }
    /**
     * Возвращает данные одного столбца следующей строки результирующего набора
     * @param $query
     * @param array $args
     * @return array
     */
    public function getColumn($sql, $params = [])
    {
        $this->db_query($sql, $params);
        // return  $result->fetchColumn(); //столбец       
        return $this->db_query($sql, $params)->fetchAll(PDO::FETCH_COLUMN);
    }

    public function getColumnN($col, $sql, $params = [])
    {
        $result = $this->db_query($sql, $params);
        return  $result->fetchColumn($col); //столбец       

    }
    /**
     * произвольный запрос
     */
    public function sql($sql, $args = [])
    {
        $this->db_query($sql, $args);
    }
}
