<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 11/1/2016
 * Time: 6:33 PM
 */
namespace core\lib\drive\log;
class File
{
    public $path;
    public function __construct()
    {
        $this->path=MILO.'/log/';
    }

    public function log($message,$name)
    {
       if(!is_dir($this->path))
       {
           mkdir($this->path,'0777',true);
       }
        date_default_timezone_set('Asia/Chongqing');
       return file_put_contents($this->path.date('Ymd').$name,date('Y-m-d H:i:s') .' '.json_encode($message).PHP_EOL,FILE_APPEND);

    }
}