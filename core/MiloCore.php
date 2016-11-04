<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 10/27/2016
 * Time: 3:52 PM
 */
namespace core;
use core\common\PrintFormat;
use core\lib\Route;

class  MiloCore
{
    public static $classMap= array();

    public static function run()
    {
        DEBUG?ini_set('display_errors','On'):ini_set('display_errors','Off');
        spl_autoload_register('\core\MiloCore::load');
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
              if (DEBUG)
              {

                  PrintFormat::echoStr("$action 方法不存在");

              }
              else
              {
                  header("Location:http://localhost/index/not");
                  exit();
              }

           }
        }
        else
        {
            if(DEBUG)
            {
                PrintFormat::echoStr("$control 控制器不存在");
            }
            else
            {
                header("Location:http://localhost/index/not");
                exit();
            }
           
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
            if (strstr($class,'Smarty'))
            {
                $file='./core/smarty/libs/sysplugins/'.$class.'.php';
            }
            else
            {
                $file=MILO.'/'.$class.'.php';
            }
            
            if(is_file($file))
            {
                include_once $file;
                self::$classMap[$class]=$class;
            }
            else
            {
                if (DEBUG)
                {
                    PrintFormat::echoStr('文件不存在 '.$file);
                }
                return false;
            }
        }

    }
    
}
