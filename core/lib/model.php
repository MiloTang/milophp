<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 11/1/2016
 * Time: 3:06 PM
 */
namespace core\lib;
use core\lib\conf;
class model extends \PDO
{
    public function __construct()
    {
        $database=conf::all('database');
        try
        {
            parent::__construct($database['DSN'], $database['USERNAME'], $database['PASSWD']);
        }catch (\PDOException $e)
        {
            echo $e->getMessage();
        }


    }
}