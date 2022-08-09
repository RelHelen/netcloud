<?php
//вывод чего либо
function debug($arr, $die = false)
{
    echo '<pre>' . print_r($arr, true) . '</pre>';
    if ($die) {
        die;
    }
}

//реддирек
function redirect($http = false)
{
    if ($http) {
        $redirect = $http;
    } else {
        $redirect = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : PATH;
    }
    header("Location: $redirect");
    exit;
}

//htmlspecialchars
//function hsc
function hsc($str)
{
    return htmlspecialchars($str, ENT_QUOTES);
}
