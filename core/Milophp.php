<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 10/27/2016
 * Time: 3:52 PM
 */
namespace core;
use core\lib\Route;

class  MiloPHP
{
    public static $classMap= array();

    public static function run()
    {
        $route = new Route();
        $control=$route->control;
        $action=$route->action;
        $CtrlFile=APP.'/controller/'.$control.'Controller'.'.php';
        $CtrlClass='\\'.MODULE.'\controller\\'.$control.'Controller';
        if (is_file($CtrlFile))
        {
           include_once $CtrlFile;
           $ctrl = new $CtrlClass();
           if (method_exists($ctrl,$action))
           {
               $ctrl->$action();
           }
           else
           {
              header("Location:http://localhost/index/not");
              exit();
           }
        }
        else
        {
            header("Location:http://localhost/index/not");
            exit();
        }
    }
    public static function load($class)
    {
        if(isset($classMap[$class]))
        {
            return true;
        }
        else
        {
            $class=str_replace('\\','/',$class);
            $file=MILO.'/'.$class.'.php';
            if(is_file($file))
            {
                include_once $file;
                self::$classMap[$class]=$class;
            }
            else
            {
                echo $file;
                return false;
            }
        }

    }
    
}
