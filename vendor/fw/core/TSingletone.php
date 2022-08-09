<?php

namespace fw\core;

trait TSingletone
{

    private static $instance;
    /**
     *создаем подключение , если его нет, иначе соединение не создается
     *возвращает подключение к бд
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }
}
