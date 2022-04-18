<?php
//настройки соединения с бд
return [
    'dsn' => 'mysql:host=localhost;dbname=cloud_db;charset=utf8',
    'user' => 'root',
    'pass' => '',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ],
];
