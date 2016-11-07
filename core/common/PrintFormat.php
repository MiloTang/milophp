<?php
/**
 * Created by PhpStorm.
 * User: francis and winnie
 * Date: 2016/11/3
 * Time: 23:05
 */
namespace  core\common;
class PrintFormat
{
    static public function dump($array)
    {

        echo '<div style="background-color: #4bb1b1;margin: 0 auto;width: 80%;height: auto;border: 0.5rem solid #000">Array ('.'<br>';
        foreach ($array as $keys=>$values)
        {

            if(is_array($values))
            {
                foreach ($values as $key=>$value)
                {
                    echo "<h2 style='color: red'>[<b>$key</b>]".'  <b>=></b>  '.$value.'<br>';
                }
            }
            else
            {
                echo "<h2 style='color: red'>[<b>$keys</b>]".'  <b>=></b>  '.$values.'<br>';
            }

        }
        echo ')';
    }
    static public function  echoStr($var)
    {
        echo '<div style="background-color: #4bb1b1;margin: 0 auto;width: 80%;height: auto;border: 0.5rem solid #000"><span>'.$var.'<span></div>'.'<br>';
    }
}