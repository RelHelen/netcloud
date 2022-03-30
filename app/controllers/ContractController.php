<?php
/**   
 */
namespace app\controllers;
use app\models\Contract;
use vendor\core\Router;
class ContractController extends ContractsController{
    
    public function indexAction(){ 
      $this->setTitle('Договор');//установка заголовка
      $model=new Contract;
     
      $val='user1'; 
      //поиск user
      $sql = "SELECT * FROM users WHERE users_login = ? LIMIT 1";   
      $users=$model->findBySql($sql,[$val]);  
      $users_id=$users[0]['users_id'];
       debug($users);
      //  [users_id] => 3
      //  [users_login] => user1

       //поиск customers
      $sql2 = "SELECT * FROM customers WHERE cust_id_users = ?  LIMIT 1";   
      $customers=$model->findBySql($sql2,[$users_id]);
      debug($customers);
       $customer=$customers[0]['cust_id']; 
      // $balanse=$customers[0]['cust_balanse'];
      
    //   [cust_id] => 1
    //   [cust_balanse] => 100000
    //   [cust_name_org] => OOO roga and kopiata
    //   [cust_name] => Беляков Сергей Юрьевич
        
    //поиск договора 
       $sql3 = "SELECT * FROM {$model->table} WHERE {$model->pk} = ?  ";   
       $contracts=$model->findBySql($sql3,[$customer]);
       debug($contracts);

      //  [contr_id] => 1
      //  [contr_id_cust] => 1
      //  [contr_nomer] => 00001
      //  [contr_date_st] => 2001-01-00 00:00:00
      //  [contr_date_exp] => 2001-01-02 00:00:00
      //  [contr_adres_set] => Пржевальского 33а       
      $this->setParams(compact('contracts'));       
    }
}
