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
            $this->_dsn = $this->_dsn.$this->_port;
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
        $sql = 'SET NAMES '.$this->_charset;
        $this->_pdo->query($sql);
    }
    private function _selectDB()
    {
        $sql = 'USE '.$this->_dbName;
        $this->_pdo->query($sql);
    }

    /**
     * @param $table 表名
     * @param null $column 需要查询的列组成一个一维数组
     * @param null $where  查询条件，此为一个二维数组，型如$where[1]=[logic,列和要比较的数据,operator]
     * 如果$where['limit']那么其值为['limit',$n,$m]
     * @param bool $debug
     * @return mixed
     */
    public function select($table,$column=null,$where=null,$debug=false)
    {

        $col=null;
        $condition=null;
        $exec=array();
        $limit=null;
        if ($column==null&&$where==null)
        {
            try
            {
                $sql='select * from '.$table;
                $rst=$this->cacheRead($sql);
                if($rst==null)
                {
                    $rst = $this->_pdo->query($sql)->fetchAll();
                }
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
                if (isset($where['limit']))
                {
                    $limitArr=$where['limit'];
                    unset($where['limit']);
                    foreach ($limitArr as $key=>$value)
                    {
                        if ($key==1)
                        {
                            $limit.=' '.$value.',';
                        }
                        else
                        {
                            $limit.=' '.$value;
                        }

                    }
                }
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
                        die('where此参数需要二维数组1');
                    }

                }
            }
            else
            {
                die('where此参数需要二维数组2');
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
        if ($col==null)
        {
            $col='*';
        }
        if ($condition!=null)
        {
            $sql = 'select '.$col.' from '. $table. ' where '. $condition.' '.$limit;
            if($debug)
            {
                $this->debug($sql);
            }
            try
            {
                $rst=$this->cacheRead($sql);
                if($rst==null)
                {
                    $stmt = $this->_pdo->prepare($sql);
                    $stmt->execute($exec);
                    $rst=$stmt->fetchAll();
                    $this->cache($sql,$rst);
                }
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
        else
        {
            $sql = 'select '. $col.' from '. $table.' '.$limit;
            $rst=$this->cacheRead($sql);
            if($rst==null)
            {
                $rst = $this->_pdo->query($sql)->fetchAll();
                $this->cache($sql,$rst);
            }
            return $rst;
        }


    }

    /**
     * @param $sql
     * @param $bindParams
     * @param bool $debug
     * @return mixed
     */
    public function doAny($sql,$bindParams,$debug=false)
    {
        if($debug)
        {
            $this->debug($sql);
        }
        try
        {
            $stmt = $this->_pdo->prepare($sql);
            $stmt->execute($bindParams);
            if(substr(trim($sql),0,6)=='select')
            {
                $rst=$stmt->fetchAll();
            }
            else
            {
                $rst= $stmt->execute($bindParams);
            }

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

    /**
     * @param $table
     * @param $values
     * @param $where
     * @param bool $debug
     * @return mixed
     */
    public function update($table,$values,$where,$debug=false)
    {
        $sql=null;
        $exec=array();
        $condition=null;
        if (is_array($values))
        {
            foreach ($values as $key=>$value)
            {
                $exec[":$key"]=$value;
                if ($sql==null)
                {
                    $sql='update '.$table.' set '. $key. ' = :'.$key;
                }
                else
                {
                    $sql.=','."$key = :$key";
                }
            }
            if ($where!=null)
            {
                if (is_array($where))
                {
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
                            die('where此参数需要二维数组1');
                        }

                    }
                }
                else
                {
                    die('where此参数需要二维数组2');
                }
            }
            if ($condition!=null)
            {
                $sql=$sql.' where '.$condition;
            }
            if($debug)
            {
                $this->debug($sql);
            }
            try
            {
                $stmt = $this->_pdo->prepare($sql);
                $rst= $stmt->execute($exec);
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
        else
        {
            exit('value需要时一个数组');
        }
    }

    /**
     * @param $table
     * @param $where
     * @param bool $debug
     * @return mixed
     */
    public function delete($table,$where,$debug=false)
    {
        $sql=null;
        $exec=array();
        $condition=null;
        if ($where!=null)
        {
            if (is_array($where))
            {
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
                        die('where此参数需要二维数组1');
                    }

                }
            }
            else
            {
                die('where此参数需要二维数组2');
            }
        }
        $sql='delete from '.$table;
        if ($condition!=null)
        {
            $sql=$sql.' where '.$condition;
        }
        if($debug)
        {
            $this->debug($sql);
        }
        try
        {
            $stmt = $this->_pdo->prepare($sql);
            $rst= $stmt->execute($exec);
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

    /**
     * @param $table
     * @param $values
     * @param $debug
     * @return mixed
     */
    public function insert($table,$values,$debug=false)
    {
        $sql=null;
        $exec=array();
        if (is_array($values))
        {
            foreach ($values as $key=>$value)
            {
                $exec[":$key"]=$value;
                if ($sql==null)
                {
                    $sql="insert into $table values(:$key";
                }
                else
                {
                    $sql.=','.":$key";
                }
            }
            $sql=$sql.')';
            if($debug)
            {
                $this->debug($sql);
            }
            try
            {
                $stmt = $this->_pdo->prepare($sql);
                $rst= $stmt->execute($exec);
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
        else
        {
            exit('value需要时一个数组');
        }
    }

    /**
     * @param $table
     * @return bool
     */
    public function tableCheck($table)
    {
        $rst = $this->query('show tables')->fetchAll();
        foreach ($rst as $keys => $values)
        {
             if ($table==$values["Tables_in_.$this->_dbName"])
             {
                 return true;
             }
        }
        return false;
    }

    /**
     * @param $table
     * @param $field
     * @return bool
     */
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

    /**
     * @param $table
     * @param bool $debug
     * @return mixed
     */
    public function counts($table,$debug=false)
    {
        $sql='select count(*) from '.$table;
        if($debug)
        {
            $this->debug($sql);
        }
        $rowCount=$this->_pdo->query($sql)->fetchColumn();
        return $rowCount;
    }
    public function startTrans()
    {
        $this->_pdo->beginTransaction();
    }
    public function commitTrans()
    {
        $this->_pdo->commit();
    }

    /**
     * @param $sql
     * @param $bindParams
     * @param bool $debug
     */
    public function inTrans($sql,$bindParams,$debug=false)
    {

        if ($this->_pdo->inTransaction())
        {
            $this->doAny($sql,$bindParams,$debug=false);
        }
        else
        {
            exit('没有开启事务');
        }
    }
    public function rollBackTrans()
    {
        $this->_pdo->rollBack();
    }

    /**
     * @param $sql
     */
    private function debug($sql)
    {
        die($sql);
    }
    public function close()
    {
        $this->_pdo = null;
    }
    private function cache($sql,$data)
    {
        $path='./app/views/cache/';
        $name='sqlCache.php';
        $cache[$sql]=$data;
        if (!isset($_SESSION['cacheTime']))
        {
            $_SESSION['cacheTime']=time();
        }
        $Time=time()-$_SESSION['cacheTime'];
        if ($Time>100)
        {
            $_SESSION['cacheTime']=time();
            unlink($path.$name);
        }
        if (!file_exists($path.$name))
        {
            $_SESSION['cacheTime']=time();
            file_put_contents($path.$name,'<?php '.PHP_EOL.'return '.PHP_EOL);
            file_put_contents($path.$name,var_export($cache,true).';'.PHP_EOL,FILE_APPEND);
        }
        else
        {
            $data=include_once $path.$name;
            foreach ($data as $key => $value)
            {
                if ($key!=$sql)
                {
                    $cache=array_merge($data, $cache);
                    file_put_contents($path.$name,'<?php '.PHP_EOL.'return '.PHP_EOL);
                    file_put_contents($path.$name,var_export($cache,true).';'.PHP_EOL,FILE_APPEND);
                }
            }
           // $data=file_get_contents($path.$name);
        }
    }
    private function cacheRead($sql)
    {
        $Time=time()-$_SESSION['cacheTime'];
        if ($Time>100)
        {
            return null;
        }
        $path='./app/views/cache/';
        $name='sqlCache.php';
        if (file_exists($path.$name))
        {
            $data=include_once $path.$name;
            foreach ((array)$data as $key => $value)
            {
                if ($key!=$sql)
                {
                    continue;
                }
                else
                {
                    return $data[$sql];
                }
            }
        }
        else
        {
            return null;
        }
    }
}