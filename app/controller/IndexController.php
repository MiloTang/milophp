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


class IndexController extends BaseController
{
    public function index()
    {
        
        Log::log('have some issue');

        $data='view';
        $model = new UserModel();
        $rst=$model->lists();
        $model->check();
       // PrintFormat::dump($rst);
       // $this->assign('data',$rst);
       // $this->assign('view','试图势力');
       // $this->display('index.tpl');
        $this->assign('name','Ned');
        $this->display('index.tpl');
    }
    public function not()
    {
        $this->assign('view','试图势力');
        $this->display('not.html');
    }
}
