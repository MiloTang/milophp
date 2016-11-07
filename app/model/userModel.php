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
    public $table='user';
    
    public function lists()
    {
        $rst=$this->select($this->table);
        return $rst;
    }
    public function check()
    {
        var_dump($this->fieldsCheck($this->table,'Host'));
    }
}