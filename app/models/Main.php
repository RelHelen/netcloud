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
    //echo '<h5>table = menu</h5>';
    // Получаем и выводим данные их меню
    //echo "<pre>";
    $param = [
      'page' => 'main'
    ];
    $data = $this->findAll('menu', 'WHERE page=:page', $param);
    return $data;
    //echo "</pre>";
  }

  public function getU()
  {
    //echo '<h5>table = users</h5>';
    $params2 = [
      'login' => 'user',
    ];
    //$data2 = $this->findAll('users', 'WHERE users_login =:login', $params2);
    //$data2 = $this->find('', 'LIMIT 1');
    //debug($data2);
    //die;


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
