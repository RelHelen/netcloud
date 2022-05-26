<?php

namespace app\models\ncadmin;

use fw\core\base\Model;
use fw\core\Db;


class Contracts extends Model
{
    public $table = 'contracts';

    public function getContracts($perpage)
    {
        $contacts = $this->dbQuery(
            "SELECT contracts.id, contracts.contr_id_cust, contracts.contr_nomer,contracts.contr_date_st, contracts.contr_date_exp,contracts.contr_status,contracts.contr_adres_set, customers.cust_name,SUM(devices.dev_cost) AS sum FROM contracts 
		JOIN customers ON contracts.contr_id_cust=customers.id	
        LEFT OUTER JOIN devices ON contracts.id=devices.dev_id_contr 	
		GROUP BY contracts.id ORDER BY contracts.contr_status,contracts.id LIMIT {$perpage}"
        );

        foreach ($contacts  as $kay => $value) {
            $contactsAll[$kay] = $value;
        }
        return  $contactsAll;
    }
}
