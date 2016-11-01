<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 10/27/2016
 * Time: 3:52 PM
 */
namespace core;
use core\lib\route;

class  milo{
    public static $classMap= array();
    public $assign;

    public static function run()
    {
        $route = new route();
        $control=$route->control;
        $action=$route->action;
        $CtrlFile=APP.'/controller/'.$control.'.php';
        $CtrlClass='\\'.MODULE.'\controller\\'.$control;
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
              echo '找不到方法'.$action;
           }
        }
        else
        {
            echo '找不到控制器'.$CtrlClass;
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

    public function assign($name,$value)
    {
        $this->assign[$name] = $value;
    }

    public  function display($view)
    {
        $file=APP.'/views/'.$view;
        if(is_file($file))
        {
            extract($this->assign);
            include_once $file;
        }
        else
        {
            echo '对应的view不存在'.$view;
        }
    }
    
}
