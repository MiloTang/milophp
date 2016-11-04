<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 10/27/2016
 * Time: 3:44 PM
 */
define('MILO',realpath('./'));
define('CORE',MILO.'/core');
define('APP',MILO.'/app');
define('MODULE','app');

define('DEBUG',true);
if (DEBUG)
{
    
}
DEBUG?ini_set('display_errors','On'):ini_set('display_errors','Off');
include  CORE.'/MiloPHP.php';
spl_autoload_register('\core\MiloPHP::load');
\core\MiloPHP::run();

