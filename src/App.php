<?php
/**
 * Created by PhpStorm.
 * User: HZM
 */

namespace App;


use Core\Config;
use Core\Database\MysqlDatabase;

/*
 * Class App : implement singleton design pattern
 */
class App
{
    private static $_instance;
    private $db_instance;

    public static function getInstance(){
        if(is_null(self::$_instance)){
            self::$_instance = new App();
        }
        return self::$_instance;
    }

    public static function load()
    {
        if(!isset($_SESSION)) {
            session_start();

        }
        // loding autoloaders
        require APPPATH .'/Autoloader.php';
        Autoloader::register();
        require ROOT . '/Core/Autoloader.php';
        \Core\Autoloader::register();
    }

    public function getDb()
    {
        // get connection parameters
        $config = Config::getInstance(ROOT . '/config/config.php');

        // BDD instance
        if(is_null($this->db_instance)) {
            $this->db_instance = new MysqlDatabase($config->get('db_name'), $config->get('db_user'), $config->get('db_pass'), $config->get('db_host'));
        }
        return $this->db_instance;
    }
}

