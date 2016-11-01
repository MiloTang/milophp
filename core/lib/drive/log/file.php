<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 11/1/2016
 * Time: 6:33 PM
 */
namespace core\lib\drive\log;
class file
{
    public $path;
    public function __construct()
    {
        $this->path=MILO.'/log';
    }

    public function log($name)
    {
       if(is_dir($this->path))
       {
           mkdir($this->path,'0777',true);
       }
       $message = date('Y-m-d H:i:s');
       return file_put_contents($this->path.$name.'php',json_encode($message));

    }
}