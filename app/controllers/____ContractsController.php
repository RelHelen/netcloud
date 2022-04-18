<?php
/**   
 */
namespace app\controllers;
use app\models\Contracts;
use app\models\Contract;
use R;

class ContractsController extends AppController{
    
    public function indexAction(){ 
      \R::fancyDebug(true);

      $this->setTitle('Договора');//установка заголовка
      $model=new Contracts;//модель Контрактов
     
      $val='user1'; 
      //поиск user
      $sql = "SELECT * FROM users WHERE users_login = ? LIMIT 1";   
      $users=$model->findBySql($sql,[$val]);  
      $users_id=$users[0]['users_id'];
      //debug($data);

       //поиск customers
      $sql2 = "SELECT * FROM customers WHERE cust_id_users = ?  LIMIT 1";   
      $customers=$model->findBySql($sql2,[$users_id]);
      debug($customers);
      $customer=$customers[0]['cust_id']; 
      $balanse=$customers[0]['cust_balanse'];
      
    //   [cust_id] => 1
    //   [cust_balanse] => 100000
    //   [cust_name_org] => OOO roga and kopiata
    //   [cust_name] => Беляков Сергей Юрьевич
        
    //поиск договора 
        $sql3 = "SELECT * FROM {$model->table} WHERE {$model->pk} = ?  ";   
        $contracts=$model->findBySql($sql3,[$customer]);
        debug($contracts);       
      $this->setParams(compact('customers','balanse','contracts'));
             
    }
}
