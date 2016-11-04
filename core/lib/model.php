<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 11/1/2016
 * Time: 3:06 PM
 */
namespace core\lib;
use core\lib\Conf;
class Model extends \PDO
{
    public function __construct()
    {
        $database=Conf::all('database');
        try
        {
            parent::__construct($database['DSN'], $database['USERNAME'], $database['PASSWD']);
        }catch (\PDOException $e)
        {
            echo $e->getMessage();
        }


    }
    private function __clone()
    {

    }
    public function select($table,array $data=null,array $option=null)
    {
        if($this->tableCheck($table))
        {
            $rst = $this->query("select * from $table")->fetchAll();
            return $rst;
        }
        else
        {
            echo $table.'not exist';
            return null;
        }

    }
    public function update()
    {

    }
    public function delete()
    {

    }
    public function insert()
    {

    }
    public function sort()
    {

    }
    public function tableCheck($table)
    {
        $rst = $this->query('show tables')->fetchAll();
        foreach ($rst as $keys => $values)
        {
             if ($table==$values['Tables_in_mysql'])
             {
                 return true;
                 break;
             }
        }
        return false;
    }
    public function fieldsCheck($table,$field)
    {
        $rst = $this->query("desc $table")->fetchAll();
        foreach ($rst as $keys => $values)
        {
            if ($field==$values['Field'])
            {
                return true;
                break;
            }
            echo $values['Field'];
        }
        return false;
    }
    public function counts()
    {

    }
    public function startTrans()
    {

    }
    public function commitTrans()
    {

    }
    public function rollBackTrans()
    {

    }
    public function close()
    {

    }
}