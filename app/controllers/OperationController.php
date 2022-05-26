<?php

namespace app\controllers;

use fw\core\Db;
use fw\core\base\View;
use fw\core\Cache;

use app\models\Contracts;
use app\models\Main;
use app\models\Operation;
use app\models\Customers;

class OperationController extends AppController
{
    public $modelUser;
    public $modelContracts;
    public $modelOperation;
    public $balanse;
    public $contracts;
    public $contractsAll;
    public $contract;
    public $devices;
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
            $this->modelContracts = new Contracts;
            $this->modelOperation = new Operation;
            $this->modelCustomer = new Customers;
            $this->balanse  = isset($_SESSION['customer']['balanse']) ? hsc($_SESSION['customer']['balanse']) : null;
            if ($this->balanse) {
                $balanse = $this->modelOperation->getBalanse($this->idCustomer());
                $_SESSION['customer']['balanse'] = $balanse;
            };
            //получаем договора 

            [$contracts, $contractsAll, $devices] = $this->modelContracts->getContractsAll($idCustomer);;

            $this->modelContracts->contracts = $contractsAll;
            $this->contracts = $contractsAll;
            // debug($this->modelContracts);
        }
    }


    public function indexAction()
    {
        $this->setTitle('Операции'); //установка заголовка
    }
}
