<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 11/1/2016
 * Time: 3:06 PM
 */
namespace core\lib;

class model extends \PDO
{
    public function __construct()
    {
        $dsn = 'mysql:host=localhost;dbname=test';
        $username='root';
        $passwd='';
        try
        {
            parent::__construct($dsn, $username, $passwd);
        }catch (\PDOException $e)
        {
            echo $e->getMessage();
        }


    }
}