<?php
/**
 * Created by PhpStorm.
 * User: HZM
 * Date: 14/09/2019
 * Time: 15:49
 */

namespace Core;

class AutoLoader
{
    static function register()
    {
        spl_autoload_register(array(__CLASS__,'autoLoad'));
    }

    static function autoLoad($class)
    {
        if (strpos($class,__NAMESPACE__ . '\\') === 0){ // namespace manager
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            require __DIR__ . '/' . $class . '.php';
        }
    }
}

