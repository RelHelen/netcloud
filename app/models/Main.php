<?php

namespace app\models;

use app\vendor\core\base\Model;
use application\lib\Db;

class Main extends Model
{
  public $table = 'menu';
  public $pk = 'id';

  public function getUsers()
  {
    //echo 'подключена модель Main';

    //Contracts.phpecho "<p> Пользователь:</p>";


    $params = [
      'id' => 4,
      'login2' => 'user',
    ];
    $data = $this->pdo->row('SELECT * from users  WHERE id=:id AND users_login=:login2', $params);

    //$form_id = 1;
    // $data = $db->column('SELECT users_login from users WHERE id=' . $form_id);
    //debug($data);
  }
}
