<?php

/**
 * контроллер админской части 
 */

namespace app\controllers\ncadmin;

class TestController extends AppadminController
{

	public function indexAction()
	{
		echo __METHOD__;
	}

	public function testAction()
	{
		echo __METHOD__;
	}
}
