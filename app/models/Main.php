<?php

namespace app\models;

use fw\core\base\Model;
use fw\core\Db;

class Main extends Model
{
  public $table = 'menu';
  public $pk = 'id';

  public function getMenuAll()
  {
    echo '<h5>table = menu</h5>';
    // Получаем и выводим данные их меню
    echo "<pre>";
    print_r($this->getAll('menu'));
  }

  public function getU()
  {
    echo '<h5>table = users</h5>';
    $params = [
      'id' => 4,
    ];
    $sql = "SELECT * FROM users WHERE id=:id";
    $data = $this->findBySql("SELECT * FROM users WHERE id=:id", $params);
    echo "getU::data: ";
    debug($data);
    foreach ($data as $val) {
      echo "val id:" . $val['id'] . '<br>';
    };
  }
  public function getUcolumn()
  {
    echo '<h5>table = users</h5>';
    $params = [
      'id' => 4
    ];
    $sql = "SELECT id,users_login,users_id_rol FROM users WHERE id=:id";
    $data1 = $this->pdo->db_query($sql, $params);
    $data2 = $this->pdo->getColumn($sql, $params);
    echo "<br>getUcolumn::data-> " . $data2; //выведет user

    $params3 = [
      'id' => 4,
      'login' => 'user',
    ];
    $sql3 = "SELECT * FROM users WHERE id=:id AND users_login=:login LIMIT 1";
    $data3 = $this->queryExe($sql3, $params3); //выполнили запрос
    $result3 = $data3->fetchAll(); //получили выборку
    echo "<br>getUcolumn::data3-> ";
    debug($result3);
  }
}
