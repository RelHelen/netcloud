<?php
/**   
 */
namespace app\controllers;
use app\models\Contracts;
use app\models\Contract;
use R;

class ContractsController extends AppController{
    
    public function indexAction(){ 
    //  \R::fancyDebug(true);

      $this->setTitle('Договора');//установка заголовка
      $model=new Contracts;//модель Контрактов
     
      $val='user1'; 
      //поиск user
      $sql = "SELECT * FROM users WHERE users_login = ? LIMIT 1";   
      $user=$model->findBySql($sql,[$val]); 
      //$user = R::findOne('users', 'users_login = ?', [$val]);
      $user_id=$user[0]['id'];
      //debug($user_id);

       //поиск customers
      // $customers= R::findOne('customers', 'cust_id_users = ?', [$user_id]);
      $sql2 = "SELECT * FROM customers WHERE cust_id_users = ?  LIMIT 1";   
      $customers=$model->findBySql($sql2,[$user_id]);
      //debug($customers);
      $customer=$customers[0]['id']; 
      $balanse=$customers[0]['cust_balanse'];
       
      
    //   [id] => 1
    //   [cust_balanse] => 100000
    //   [cust_name_org] => OOO roga and kopiata
    //   [cust_name] => Беляков Сергей Юрьевич
        
       //поиск договора 
       
       //$contracts = R::findAll('contracts', 'contr_id_cust = ?', [$customer]);
       //debug($contracts_customer);
        $sql3 = "SELECT * FROM {$model->table} WHERE {$model->pk} = ?  ";   
        $contracts=$model->findBySql($sql3,[$customer]);
        // debug($contracts);       
      $this->setParams(compact('customers','balanse','contracts'));
             
    }
}
