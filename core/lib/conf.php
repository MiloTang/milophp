<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 11/1/2016
 * Time: 5:27 PM
 */
namespace core\lib;
use core\MiloPHP;

class Conf
{
    static public $conf;
    static public function all($file)
    {
        if(isset(self::$conf[$file]))
        {
            return self::$conf[$file];
        }
        else
        {
            $path = MILO.'/core/config/'.$file.'.php';
            if (is_file($path))
            {
                $conf = include_once $path;
                self::$conf[$file] = $conf;
                return $conf;
            }
            else
            {
                echo '配置文件不存在'.$file;
            }
        }
    }
}