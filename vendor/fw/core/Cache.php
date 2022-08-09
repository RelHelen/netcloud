<?php

namespace fw\core;

/**
 * кэширования данных
 * */
class Cache
{
    use TSingletone;
    public function __construct()
    {
    }

    /**добавляет в кэш данные
     *можно кешировать меню, посты, метаданые
     *$key - название данных которые кладем в меню
     *$data - сами данные
     *$seconds=3600 - время кеша = 1час
     */
    public function set($key, $data, $seconds = 3600)
    {
        if ($seconds) {
            $content['data'] = $data;
            //вычислим конечную дату для кешированных данных
            $content['end_time'] = time() + $seconds;

            //если данные записались в файл
            if (file_put_contents(CACHE . '/' . md5($key) . '.txt', serialize($content))) {
                return  true;
            }
        }
        return false;
    }

    /**берет данные из кеша по ключу key
     * */
    public function get($key)
    {
        //если файл существует то считай данные в $content
        $file = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if (time() <= $content['end_time']) {
                return $content['data'];
            }
            unlink($file); //если кеш просрочен то файл удаляем
        }
        return false;
    }


    /**удаляем файл из кеша по ключу key
     * */
    public function delete($key)
    {
        //если файл существует то удали файл
        $file = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($file)) {
            unlink($file); //если кеш просрочен то файл удаляем
        }
    }
}
