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
        $Conf=Conf::getInstance();
        $DBConf=$Conf->all('DBConf');
        $model=Model::getInstance($DBConf);
        $column=array('Host','User');
        $where[1]=['logic'=> '','User'=>'pma','operator'=>'='];
        $where[2]=['logic'=> 'and','Host'=>'localhost','operator'=>'='];
        PrintFormat::dump($model->select('user',$column,$where));
        $this->assign('name','www');
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
