<?php

namespace app\models\ncadmin;

use fw\core\base\Model;
use fw\core\Db;


class Contracts extends Model
{
    public $table = 'contracts';
    //вернет массив контрактов
    public function getContracts($start, $perpage)
    {
        $contacts = $this->findSql(
            "SELECT contracts.id, contracts.contr_id_cust, contracts.contr_nomer,contracts.contr_date_st, contracts.contr_date_exp,contracts.contr_status,contracts.contr_adres_set, customers.cust_name,SUM(devices.dev_cost) AS sum FROM contracts 
		JOIN customers ON contracts.contr_id_cust=customers.id	
        LEFT OUTER JOIN devices ON contracts.id=devices.dev_id_contr 	
		GROUP BY contracts.id ORDER BY contracts.contr_status,contracts.id LIMIT {$start} ,{$perpage}"
        );

        foreach ($contacts  as $kay => $value) {
            $contactsAll[$kay] = $value;
        }
        return  $contactsAll;
    }

    //вернет строку контракта
    public function getRowContracts($contract_id)
    {

        $contract = $this->getAssocArr(
            "SELECT contracts.*, customers.cust_name,SUM(devices.dev_cost) AS sum FROM contracts 
		JOIN customers ON contracts.contr_id_cust=customers.id	
        LEFT OUTER JOIN devices ON contracts.id=devices.dev_id_contr WHERE	contracts.id=:contract_id
		GROUP BY contracts.id ORDER BY contracts.contr_status,contracts.id LIMIT 1",
            [':contract_id' => $contract_id]
        );

        return  $contract;
    }

    //вернет массив устройств
    public function getDevices($id)
    {

        $devices = $this->getAssoc(
            "SELECT *FROM devices  WHERE dev_id_contr=:id",
            [':id' => $id]
        );
        return  $devices;
    }
}
