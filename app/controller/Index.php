<?php
/**
 * Created by PhpStorm.
 * User: francis and winnie
 * Date: 2016/10/31
 * Time: 22:01
 */
namespace app\controller;
use core\lib\conf;
use core\lib\log;
use core\lib\model;
use core\milo;

class Index extends milo
{
    public function index()
    {
        log::init();
        log::log('wodiu');
        $data='view';
        $model = new model();
        $rst=$model->query('select * from user')->fetchAll();
        $this->assign('data',$rst);
        $this->assign('view','试图势力');
        $this->display('index.html');
    }
}
