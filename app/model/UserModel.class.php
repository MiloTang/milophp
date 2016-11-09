<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 11/3/2016
 * Time: 3:42 PM
 */
namespace app\model;
use core\lib\Conf;
use core\lib\Model;

class UserModel extends Model
{
    private $table='user';
    private $model;
    public function __construct()
    {
        $Conf=Conf::getInstance();
        $DBConf=$Conf->all('DBConf');
        $this->model=Model::getInstance($DBConf);
    }
    public function lists()
    {
        $column=array('id','name');
     //   $where[1]=['logic'=> '','id'=>'27189','operator'=>'='];
     //   $where[2]=['logic'=> 'or','id'=>'135','operator'=>'='];
        $rst=$this->model->select($this->table,$column,null,false);
        return $rst;
    }
    public function check()
    {
        var_dump($this->fieldsCheck($this->table,'Host'));
    }
    public function close()
    {
        parent::close();
    }
}