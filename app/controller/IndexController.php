<?php
/**
 * Created by PhpStorm.
 * User: francis and winnie
 * Date: 2016/10/31
 * Time: 22:01
 */
namespace app\controller;
use app\model\UserModel;
use core\common\PrintFormat;
use core\lib\BaseController;
use core\lib\Conf;
use core\lib\Log;
use core\lib\Model;
use core\lib\ValidateCode;


class IndexController extends BaseController
{
    public function index()
    {
        
        Log::log('have some issue');

        //$data='view';
       // $model = new UserModel();
        //$rst=$model->lists();
       // $model->check();
       // PrintFormat::dump($rst);
        //$this->assign('rst',$rst);
       // new BaseController();
       // $this->assign('view','试图势力');
       // $this->display('index.html');
        $arr=array('a'=>'aaa','b'=>'aaaa','c'=>'aaaaa','d'=>'aaaaaa','e'=>'aaaaaaa');
        extract($arr);
        foreach ($arr as $key=>$value)
        {
            echo $key.' => '.$value.'<br>';
        }

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
