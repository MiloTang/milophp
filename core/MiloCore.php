<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 10/27/2016
 * Time: 3:52 PM
 */
namespace core;
use core\lib\Route;

class  MiloCore
{
    public static $classMap= array();

    public static function run()
    {
        DEBUG?ini_set('display_errors','On'):ini_set('display_errors','Off');
        spl_autoload_register('\core\MiloCore::load');
        include_once CORE.'/common/Function.php';
        $route = Route::getInstance();
        $control=$route->getControl();
        $action=$route->getAction();
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
                  PrintFm($action.' 方法不存在');
              }
              else
              {
                  $url='http://localhost/index/not';
                  JumpUrl($url);
              }

           }
        }
        else
        {
            if(DEBUG)
            {
                PrintFm($control.' 控制器不存在');
            }
            else
            {
                $url='http://localhost/index/not';
                JumpUrl($url);
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
                    PrintFm('文件不存在 '.$file);
                }
                return false;
            }
        }
    }
}
