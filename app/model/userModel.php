<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 11/3/2016
 * Time: 3:42 PM
 */
namespace app\model;
use core\lib\model;

class userModel extends model
{
    public $table='user';
    public function lists()
    {
        $rst=$this->select($this->table);
        return $rst;
    }
    public function Check()
    {
        var_dump($this->fieldsCheck($this->table,'Host'));
    }
}