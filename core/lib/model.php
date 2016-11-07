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
    private $_dsn;
    private $_port;
    private $_username;
    private $_password;
    private $_charset;
    private $_dbName;
    private static $_instance;
    private $_pdo = null;

    private function __clone()
    {

    }
    private function __construct($dbConf) {
        $this->_initDBCConf($dbConf);
        $this->_linkMysql();
        $this->_setCharset();
        $this->_selectDB();
    }
    private function _initDBCConf($dbConf)
    {
        if (DEBUG)
        {
            $this->_dsn = isset($dbConf['dsn'])?$dbConf['dsn']:die('请配置dsn');
            $this->_dbName = isset($dbConf['dbName'])?$dbConf['dbName']:die('请配置数据库');
            $this->_username = isset($dbConf['username'])?$dbConf['username']:die('请配置用户名');
            $this->_password = isset($dbConf['password'])?$dbConf['password']:die('请配置用户密码');
            $this->_charset = isset($dbConf['charset'])?$dbConf['charset']:'utf8';
            $this->_port = isset($dbConf['port'])?$dbConf['port']:'3306';
        }
        else
        {
            $this->_dsn = isset($dbConf['dsn'])?$dbConf['dsn']:die();
            $this->_dbName = isset($dbConf['dbName'])?$dbConf['dbName']:die();
            $this->_username = isset($dbConf['username'])?$dbConf['username']:die();
            $this->_password = isset($dbConf['password'])?$dbConf['password']:die();
            $this->_charset = isset($dbConf['charset'])?$dbConf['charset']:'utf8';
            $this->_port = isset($dbConf['port'])?$dbConf['port']:'3306';
        }
    }
    private function _linkMysql()
    {
        try
        {
            $this->_dsn = $this->_dsn."$this->_port;";
            $this->_pdo = new \PDO($this->_dsn,$this->_username, $this->_password);
            $this->_pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->_pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
            $this->_pdo->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,true);
            //$this->_pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        } catch (\PDOException $e) {
            if (DEBUG)
            {
                exit($e->getMessage());
            }
            else
            {
                exit();
            }
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
        $this->_pdo->query($sql);
    }
    private function _selectDB()
    {
        $sql = "USE `$this->_dbName`";
        $this->_pdo->query($sql);
    }
    public function select($table,$column=null,$where=null,$debug=false)
    {

        $col=null;
        $condition=null;
        if ($column==null&&$where==null)
        {
            try
            {
                $rst = $this->_pdo->query("select * from $table")->fetchAll();
                return $rst;
            }
            catch (\PDOException $e)
            {
                if (DEBUG)
                {
                    exit($e->getMessage());
                }
                else
                {
                    exit();
                }
            }
        }
        if ($where!=null)
        {
            if (is_array($where))
            {

                $exec=array();
                foreach ($where as $keys => $values)
                {
                    if (is_array($values))
                    {
                        if (isset($values['logic'])&&isset($values['operator']))
                        {
                            foreach ($values as $key => $value)
                            {
                                if ($key!='logic'&&$key!='operator')
                                {
                                    $condition.=$values['logic'].' '.$key.$values['operator'].' '.":$value".' ';
                                    $exec[":$value"] = $value;
                                }
                            }
                        }
                        else
                        {
                            die('where 数组参数不对');
                        }
                    }
                    else
                    {
                        die('where此参数需要二维数组');
                    }

                }
            }
            else
            {
                die('where此参数需要二维数组');
            }
        }
        if($column!=null)
        {
            foreach ($column as $key => $value)
            {
                if ($col!=null)
                {
                    $col.=','.$value;
                }
                else
                {
                    $col=$value;
                }
            }
        }
        if ($col!=null)
        {
            $sql = "select $col from $table where $condition";
        }
        else
        {
            $sql = "select * from $table where $condition";
        }

        if($debug)
        {
            $this->debug($sql);
        }
        try
        {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute($exec);
            $rst=$stmt->fetchAll();
            return $rst;
        }
        catch (\PDOException $e)
        {
            if (DEBUG)
            {
                exit($e->getMessage());
            }
            else
            {
                exit();
            }
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
             if ($table==$values["Tables_in_.$this->_dbName"])
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
    private function debug($sql)
    {

        die($sql);
    }
    public function close()
    {
        $this->_pdo = null;
    }
}