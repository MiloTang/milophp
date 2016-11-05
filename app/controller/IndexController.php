<?php
/**
 * Created by PhpStorm.
 * User: francis and winnie
 * Date: 2016/10/31
 * Time: 22:01
 */
namespace app\controller;
use core\lib\BaseController;
use core\lib\ValidateCode;


class IndexController extends BaseController
{
    public function index()
    {
        $this->assign('name','data');
        $this->display('index.tpl');
    }
    public function not()
    {
        $this->assign('title','404');
        $this->display('not.html');
    }
    public function code()
    {
        $code = new ValidateCode();
        $code->doImg(5);
    }
}
