<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 11/8/2016
 * Time: 4:15 PM
 */
/**
 * @param $var
 */
defined('CORE_PATH') or exit();
function PrintFm($var=null)
{
    if(!is_null($var))
    {
        echo '<pre style="background-color: #bbbbbb;color:brown;font-size: x-large"><b>'.print_r($var,true).'</b></pre>';
    }
}
function JumpUrl($url)
{
    header('Location:'.$url);
    exit();
}
function Post()
{

}
function Get()
{

}