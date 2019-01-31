<?php
//define url
if (!defined('WEB_URL')) {
    $url = rtrim(dirname(rtrime($_SERVER['SCRIPT_NAME'], '/')), '/');
    define('WEB_URL', (('/' == $url || '\\' == $url) ? '' : $url));
}
//define application directory
define('APP_PATH', './application/');
//load framework leading fine
require './thinkphp/start.php';