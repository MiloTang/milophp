<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 11/1/2016
 * Time: 6:21 PM
 */
namespace core\lib;
defined('CORE_PATH') or exit();
use core\lib\drive\log\File;

class Log
{
    private static $class;
    private static $_instance;
    private function __construct()
    {

    }
    public static  function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    private function __clone()
    {

    }
    static public function log($message,$name='log')
    {
        self::$class=new File();
        self::$class->log($message,$name);
    }
}