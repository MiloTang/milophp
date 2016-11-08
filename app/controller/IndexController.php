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
        $where[1]=['logic'=> '','id'=>'40970','operator'=>'='];
        $where[2]=['logic'=> 'or','id'=>'43279','operator'=>'='];
      //  $where['limit']=['limit','0','1'];
      //  PrintFormat::dump($model->select('user',$column,$where));
        $user=['id'=>111111,'name'=>'diu diu ni','age'=>121];
        echo $model->insert('user',$user);
        $model->close();
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
