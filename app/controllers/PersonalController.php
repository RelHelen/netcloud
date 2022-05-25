<?php

namespace app\controllers;

use fw\core\Db;
use app\models\User;
use app\models\Customers;
use fw\core\base\View;
use app\models\Operation;

class PersonalController extends AppController
{
    public $user;
    public $model;

    public function __construct($route)
    {
        parent::__construct($route); //сначало выполняем        

        //проверка переменной из сессии при авторизации    
        if (!$this->isUserLog($this->route['action'], $this->route['controller'])) {
            redirect(PATH . '/user/login');
        } else {

            //поолучили log user и Customer из сессии
            $logUser = $this->logUser();
            $idCustomer = $this->idCustomer();

            $this->model = new Customers;
            $this->modelOperation = new Operation;
        }
    }
    /**
     * главный экран страницы Договора
     * вывод всех договоров
     */
    public function indexAction()
    {
        $this->setTitle('Личный кабинет'); //установка заголовка
        $customer = $this->model->getCustomerRow($this->idCustomer());

        if ($customer) {
            $this->setData(compact('customer'));
        }
    }
}
