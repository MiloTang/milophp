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
include  CORE.'/MiloCore.php';
\core\MiloCore::run();

