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
    private $smarty;
    public function __construct()
    {
        $this->smarty = new \Smarty();
        $this->smarty->setTemplateDir(APP.'/views/templates/');
        $this->smarty->setCacheDir(APP.'/views/cache/');
        $this->smarty->setCompileDir( APP.'/views/templates_c/');
        $this->smarty->setConfigDir(APP.'/views/configs/');
        $this->smarty->cache_lifetime=120;
        $this->smarty->caching = false;
    }
    public function assign($name,$data)
    {
        $this->smarty->assign($name,$data);
    }
    public function display($view)
    {
        $file=APP.'/views/templates/'.$view;
        if(is_file($file))
        {
            $this->smarty->display($view);
        }
        else
        {
            PrintFormat::echoStr("$view 模板不存在");
        }

    }
}