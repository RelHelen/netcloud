<?php
//настройки соединения с бд
return [
    'dsn' => 'mysql:host=localhost;dbname=cloud_db;charset=utf8',
    'user' => 'root',
    'pass' => '',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // PDO::ATTR_EMULATE_PREPARES => false
    ],
];
//ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION: этот атрибут предписывает PDO выдать исключение при обнаружении ошибки. Такие ошибки можно регистрировать в журнале для целей отладки.
//ATTR_EMULATE_PREPARES, false: данная опция отключает эмуляцию подготовленных выражений и позволяет MySQL самостоятельно готовить выражения.
