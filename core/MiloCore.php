<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 10/27/2016
 * Time: 3:52 PM
 */
namespace core;
defined('CORE_PATH') or exit();
use core\lib\Route;
class  MiloCore
{
    public static $classMap= array();
    public static function run()
    {
        session_start();
        DEBUG?ini_set('display_errors','On'):ini_set('display_errors','Off');
        DEBUG?ini_set("error_reporting", E_ALL):ini_set(error_reporting(0));
        spl_autoload_register('\core\MiloCore::load');
        include_once CORE_PATH.'/common/Function.php';
        $route = Route::getInstance();
        $control=$route->getControl();
        $action=$route->getAction();
        $CtrlFile=APP.'/controller/'.$control.'Controller'.'.class.php';
        $CtrlClass='app\controller\\'.$control.'Controller';
        if (is_file($CtrlFile))
        {
           require_once $CtrlFile;
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
    public static function load(string $class) : bool
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
                $file=CORE_PATH.'/smarty/libs/sysplugins/'.$class.'.php';
            }
            else
            {
                $file=ROOT.'/'.$class.'.class.php';
            }
            if(is_file($file))
            {
                require_once $file;
                self::$classMap[$class]=$class;
                return true;
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
