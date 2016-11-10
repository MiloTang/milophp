<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 10/28/2016
 * Time: 10:18 AM
 */
namespace core\lib;
defined('CORE_PATH') or exit();
class Route
{
    private $control ='index';
    private $action ='index';
    private $params  = array();
    private static $_instance;
    public static  function getInstance()
    {
        if (!(self::$_instance instanceof self)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    private function __clone()
    {

    }
    private function __construct()
    {
        if(isset($_SERVER['REQUEST_URI'])&&$_SERVER['REQUEST_URI'] != '/')
        {
            $uri=$_SERVER['REQUEST_URI'];
            $uriArr=explode('/',trim($uri,'/'));
            if(isset($uriArr[0])&&$uriArr[0]!='')
            {
                $this->control = $uriArr[0];
            }
            else
            {
                $this->control = 'index';
            }
            if(isset($uriArr[1]))
            {
                $this->action = $uriArr[1];
            }
            else
            {
                $this->action = 'index';
            }
            if (isset($uriArr[2]))
            {
                $count=count($uriArr);
                for ($i=2;$i<$count;$i++)
                {
                    if(isset($uriArr[$i+1]))
                    {
                        $this->params[$uriArr[$i]]=$uriArr[$i+1];
                    }
                    $i++;
                }
            }
            else
            {
                $this->params = array();
            }
        }

    }
    public function getControl()
    {
        return $this->control;
    }
    public function getAction()
    {
        return $this->action;
    }
    public function getParams()
    {
        return $this->params;
    }
   
}