<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 11/1/2016
 * Time: 3:06 PM
 */
namespace core\lib;
class Model
{
    private $_host;
    private $_port;
    private $_user;
    private $_password;
    private $_charset;
    private $_dbname;
    private $_link;
    private static $_instance;
    private $_pdo = null;

    private function __clone()
    {

    }
    private function __construct($dbConf) {
        try {
            $this->_pdo = new \PDO($dbConf['DSN'], $dbConf['USERNAME'], $dbConf['PASSWD']);
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
    static public function getInstance($dbConf) {
        if (!(static::$_instance instanceof static)) {
            static::$_instance = new static($dbConf);
        }
        return static::$_instance;
    }
    private function _setCharset()
    {
        $sql = "SET NAMES $this->_charset";
        static::$_instance->query($sql);
    }
    private function _selectDB()
    {
        $sql = "USE `$this->_dbname`";
        $this->query($sql);
    }
    public function select($table,array $data=null,array $option=null)
    {

            $rst = $this->_pdo->query("select * from $table")->fetchAll();
            return $rst;


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