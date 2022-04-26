<?php
//настройки проекта
//components-  те компоненты, которые необходимы при загрузке
//vendor\libs\Cache - //путь к классу, который создает объект cache
//settings - настройки
$config = [
	'components' => [
		'cache' => 'fw\libs\Cache',
		'test' => 'fw\libs\Test',
	],
	'settings' => [
		'' => '',
	],
];
return $config;
