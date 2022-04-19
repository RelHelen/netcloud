<?php

/**   
 */

namespace app\controllers;

use app\models\Contracts;
use app\models\Contract;
use R;

class ContractsController extends AppController
{

  public function indexAction()
  {
    //  \R::fancyDebug(true);

    $this->setTitle('Договора'); //установка заголовка
    $model = new Contracts; //модель Контрактов



  }
}
