<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 11/1/2016
 * Time: 6:21 PM
 */
namespace core\lib;
class log
{
    static $class;
    static public function init()
    {
        $drive='file';
        $class='\core\lib\drive\log\\'.$drive;
        self::$class=new $class;
    }

    static public function log($message,$name='log')
    {
        self::$class->log($message,$name);
    }
}