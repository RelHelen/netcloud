<?php

/**
 * контроллер админской части  
 */

namespace app\controllers\admin;

use \R;


class MainController extends AppadminController
{

	public function indexAction()
	{
		// echo __METHOD__;
		//debug($this->route);
		\fw\core\base\View::setMeta('Админка | Главная страница');

		//$test="тестовая переменная";
		//$data=['test',3];

		//1вариант - передача данных в вид, в виде будут доступны  'test' и 'data'
		/*
	 	 $this->setParams([
	 	 	'test'=>$test,
	 	 	'data'=>$data,
	 	 ]);
		  */

		//2вариант - передача данных в вид, в виде будут доступны  'test' и 'data'
		//$this->setParams(compact('test','data'));

		$contracts = R::findAll('contracts');

		$this->setParams(compact('contracts'));
	}
	public function testAction()
	{
		//смена шаблона
		$this->layout = 'default';
		//echo __METHOD__;
	}
}
