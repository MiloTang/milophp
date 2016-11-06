<?php
/**
 * Created by PhpStorm.
 * User: francis and winnie
 * Date: 2016/10/31
 * Time: 22:01
 */
namespace app\controller;
use core\common\PrintFormat;
use core\lib\BaseController;
use core\lib\Conf;
use core\lib\Model;
use core\lib\ValidateCode;
class IndexController extends BaseController
{
    public function index()
    {
        $conf=Conf::getInstance();
        $model1=Model::getInstance($conf->all('DBConf'));
        PrintFormat::dump( $model1->select('user'));
        $this->assign('name','wwwww');
        $this->display('index.tpl');

    }
    public function not()
    {
        $this->assign('title','404');
        $this->display('not.html');
    }
    public function code()
    {
        $code = $code=ValidateCode::getInstance();
        $code->doImg(5);
    }
}
