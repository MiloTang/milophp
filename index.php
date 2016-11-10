<?php
/**
 * Created by PhpStorm.
 * User: milo
 * Date: 10/27/2016
 * Time: 3:44 PM
 */
define('ROOT',$_SERVER['DOCUMENT_ROOT']);
define('CORE_PATH',ROOT.'/core');
define('APP',ROOT.'/app');

define('DEBUG',true);

require_once CORE_PATH.'/MiloCore.php';
\core\MiloCore::run();

