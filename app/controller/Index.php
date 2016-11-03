<?php
/**
 * Created by PhpStorm.
 * User: francis and winnie
 * Date: 2016/10/31
 * Time: 22:01
 */
namespace app\controller;
use app\model\userModel;
use core\lib\conf;
use core\lib\log;
use core\lib\model;
use core\milo;

class Index extends milo
{
    public function index()
    {
        log::init();
        log::log('have some issue');
        $data='view';
        $model = new userModel();
     //   $rst=$model->lists();
        $model->check();
      //  $this->assign('data',$rst);
        $this->assign('view','试图势力');
        $this->display('index.html');
    }
    public function not()
    {
        $this->assign('view','试图势力');
        $this->display('not.html');
    }
}
