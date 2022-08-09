<?php

namespace fw\core;

/**
 * 
 * $objects - контейнер для хранения объектов (new $components), 
 * $objects[$name]-имя объекта 
 */
class Registry
{

    public static $objects = [];
    protected static $properties = [];

    use TSingletone;

    protected function  __construct()
    {

        require_once CONF . '/config.php';
        foreach ($config['components'] as $name => $component) {

            self::$objects[$name] = new $component;
        }
    }



    //магический метод
    //вызываются атоматически , если происходит 
    //обращение к неизвестному свойству
    // например, App->test; - неизвестное свойство
    //возвращает объект
    public function __get($name)
    {
        //что будет делать класс, при обращении к несуществующему свойству-вернуть сам объект
        //если это объект - вернет этот объект
        if (is_object(self::$objects[$name])) {
            return self::$objects[$name];
        }
    }
    //позволяет помещать объекты в контейнер $objects
    //позволяет записать при обращение к неопределенному свойству объекта
    //возвращает новый объект 
    public function __set($name, $object)
    {
        //если объекта нет в контейнере
        if (!isset(self::$objects[$name])) {
            self::$objects[$name] = new $object;
        }
    }


    //выводит все объекты
    public function getList()
    {
        echo "<pre>";
        var_dump(self::$objects);
        echo "</pre>";
    }

    //для параметров params
    public function setProperty($name, $value)
    {
        self::$properties[$name] = $value;
    }
    //получаем свойство по имени
    public function getProperty($name)
    {
        if (isset(self::$properties[$name])) {
            return self::$properties[$name];
        }
        return null;
    }
    //получаем свойства  
    public function getProperties()
    {
        return self::$properties;
    }
}
