<?php

namespace app\models;

use fw\core\base\Model;
use fw\core\Db;

class Operation extends Model
{
    public $table = 'operation';

    /**
     * получение id операции по id клиента
     */
    public  function getIdOperation($id)
    {
        $param = [
            'id' => $id
        ];
        $operation = $this->getAssocArr("SELECT * FROM $this->table WHERE oper_id_cust=:id LIMIT 1", $param);
        if ($operation) {
            return  $operation['id'];
        }
        return false;
    }
    /**
     * получение баланса операции по id клиента
     */
    public  function getBalanse($id)
    {
        $param = [
            'id' => $id
        ];
        $operation = $this->getAssocArr("SELECT * FROM $this->table WHERE oper_id_cust=:id LIMIT 1", $param);
        if ($operation) {
            return  $operation['oper_balanse'];
        }
        return false;
    }
}
