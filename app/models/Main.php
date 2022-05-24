<?php

namespace app\models;

use fw\core\base\Model;
use fw\core\Db;

class Main extends Model
{
  public $table = 'menu';
  public $pk = 'id';

  //меню для главной странице
  public function getMenuAll()
  {
    $param = [
      'page' => 'main'
    ];
    $data = $this->findAll('menu', 'WHERE page=:page', $param);
    return $data;
  }

  public function getU()
  {

    $params2 = [
      'login' => 'user',
    ];

    $params = [
      'id' => 2,
    ];
    $sql = "SELECT * FROM users WHERE id=:id";
    return $data = $this->findBySql($sql, $params);


    //echo "getU::data: ";
    //debug($data);
    // foreach ($data as $val) {
    //   echo "val id:" . $val['id'] . '<br>';
    // };
  }
  public function getUcolumn()
  {
    echo '<h5>table = users</h5>';
    $params = [
      'id' => 2
    ];
    $sql = "SELECT id,users_login,users_id_rol FROM users WHERE id=:id";
    $data1 = $this->pdo->db_query($sql, $params);
    $data2 = $this->pdo->getColumn($sql, $params);
    echo "<br>getUcolumn::data-> " . $data2; //выведет user



  }
}
