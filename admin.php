<?php
//define url
if (!defined('WEB_URL')) {
    $trim = rtrim(dirname(rtrim($_SERVER['SCRIPT_NAME'], '/')), '/');
    define('WEB_URL', (('/' == $url || '\\' == $url) ? '' : $url));
}
//define application directory
define('APP_PATH','./application/');
defind('BIND_MODULE', '/admin');
//load framework leading file
require './thinkphp/start.php';