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
<<<<<<< HEAD
        
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
=======
        $conf=Conf::getInstance();
        $model1=Model::getInstance($conf->all('DBConf'));
        PrintFormat::dump( $model1->select('user'));
        $this->assign('name','wwwww');
>>>>>>> c286b0dd151badb39e6a82181208796642838851
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
