<?php
/**
 * Created by PhpStorm.
 * User: francis and winnie
 * Date: 2016/10/31
 * Time: 22:01
 */
namespace app\control;
class indexControl extends \core\milo
{
    public function index()
    {
        $data='view';
        $this->assign('data',$data);
        $this->assign('view','试图势力');
        $this->display('index.html');
    }
}
