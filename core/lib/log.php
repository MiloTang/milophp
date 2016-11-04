<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 11/1/2016
 * Time: 6:21 PM
 */
namespace core\lib;
use core\lib\drive\log\File;

class Log
{
    static $class;
    static public function log($message,$name='log')
    {
        self::$class=new File();
        self::$class->log($message,$name);
    }
}