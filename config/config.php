<?php
//настройки проекта
//components-  те компоненты, которые необходимы при загрузке
//vendor\libs\Cache - //путь к классу, который создает объект cache
//settings - настройки
$config=[
	'components'=>[
		'cache'=>'vendor\libs\Cache',
		'test'=>'vendor\libs\Test',
	],
	'settings'=>[
		''=>'',
	],
];
return $config;