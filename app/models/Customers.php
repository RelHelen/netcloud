<?php

namespace app\models;

use fw\core\base\Model;
use fw\core\Db;

class Customers extends Model
{
    public $table = 'customers';
    /**
     * получение id клиента по id пользователю
     */
    public  function getIdCustomer($id)
    {
        $customersParam = [
            'id' => $id
        ];
        $customers = $this->getAssocArr("SELECT * FROM customers WHERE cust_id_users=:id LIMIT 1", $customersParam);
        if ($customers) {
            return $customers['id'];
        }
        return false;
    }

    /**
     * получение   клиента по id пользователю
     */
    public  function getCustomer($id)
    {
        $customersParam = [
            'id' => $id
        ];
        $customers = $this->getAssocArr("SELECT * FROM customers WHERE cust_id_users=:id LIMIT 1", $customersParam);
        if ($customers) {
            return $customers;
        }
        return false;
    }
}
