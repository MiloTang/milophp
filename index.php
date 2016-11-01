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
DEBUG?ini_set('display_errors','On'):ini_set('display_errors','Off');
include  CORE.'/milo.php';
spl_autoload_register('\core\milo::load');
\core\milo::run();

