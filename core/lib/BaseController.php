<?php
/**
 * Created by PhpStorm.
 * User: francis and winnie
 * Date: 2016/11/3
 * Time: 22:45
 */
namespace core\lib;
require 'E:\xampp\htdocs\core\lib\Smarty.class.php';

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
        self::$smarty->caching = true;
    }

    public function assign($name,$value)
    {
        self::$smarty->assign($name,$value);
    }

    public  function display($view)
    {
        static::$smarty->display($view);
    }
}