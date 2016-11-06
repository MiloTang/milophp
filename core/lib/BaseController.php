<?php
/**
 * Created by PhpStorm.
 * User: francis and winnie
 * Date: 2016/11/3
 * Time: 22:45
 */
namespace core\lib;
use core\common\PrintFormat;

require_once './core/smarty/libs/Smarty.class.php';
class BaseController
{
    public static $smarty;
    public function __construct()
    {
        self::$smarty = new \Smarty();
        self::$smarty->template_dir = APP.'/views/templates/';
        self::$smarty->compile_dir = APP.'/views/templates_c/';
        self::$smarty->config_dir = APP.'/views/configs/';
        self::$smarty->cache_dir = APP.'/views/cache/';
        self::$smarty->cache_lifetime=120;
        self::$smarty->caching = false;
    }
    public function assign($name,$data)
    {
        self::$smarty->assign($name,$data);
    }
    public function display($view)
    {
        $file=APP.'/views/templates/'.$view;
        if(is_file($file))
        {
            self::$smarty->display($view);
        }
        else
        {
            PrintFormat::echoStr("$view 模板不存在");
        }

    }
   
    public function assignCP($name,$value)
    {
        $this->assign[$name] = $value;
    }

    public  function displayCP($view)
    {

        $file=APP.'/views/templates/'.$view;
        if(is_file($file))
        {
            extract($this->assign);
            include_once $file;
        }
        else
        {
            echo $view.' 模板不存在';
        }
    }

}