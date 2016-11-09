<?php
/**
 * Created by PhpStorm.
 * User: francis and winnie
 * Date: 2016/10/31
 * Time: 22:01
 */
namespace app\controller;
use app\model\UserModel;
use core\lib\BaseController;
use core\lib\Conf;
use core\lib\Model;
use core\lib\ValidateCode;
class HomeController extends BaseController
{
    public function index()
    {
        
        $model=new UserModel();
        $data=$model->lists();
        PrintFm($data);
        $this->assign('name',$data);
        $this->display('index.html');
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
