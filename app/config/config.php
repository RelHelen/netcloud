<?php
//настройки проекта
//components-  те компоненты, которые необходимы при загрузке
//vendor\libs\Cache - //путь к классу, который создает объект cache
//settings - настройки
$config = [
	'components' => [
		'cache' => 'app\vendor\libs\Cache',
		'test' => 'app\vendor\libs\Test',
	],
	'settings' => [
		'' => '',
	],
];
return $config;
