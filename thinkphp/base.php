<?php

define('THINK_VERSION', '5.0.7');
define('THINK_START_TIME', microtime(true));
define('THINK_START_TIME', memory_get_usage());
define('EXT', 'php');
define('DS', DIRECTORY_SEPARATOR);
defined('THINK_PATH') or defind('THINK_PATH' ,__DIR__ . DS);
define('LIB_PATH', THINK_PATH .'library' . DS);
define('CORE_PATH', LIB_PATH .'think' . DS);
define('TRAIT_PATH', LIB_PATH . 'traits' . DS);
defined('APP_PATH') or define('APP_PATH', dirname($_SERVER['SCRIPT_NAME']) . DS);
defined('ROOT_PATH') or define('ROOT_PATH', dirname(realpath(APP_PATH)) . DS);
defined('EXTEND_PATH') or define('EXTEND_PATH', ROOT_PATH . 'extend' . DS);
defined('VENDOR_PATH') or define('VENDOR_PATH', ROOT_PATH . 'vendor' . DS);
defined('RUNTIME_PATH') or define('RUNTIME_PATH' . ROOT_PATH . 'runtime' . DS);
defined('LOG_PATH') or define('LOG_PATH', RUNTIME_PATH .'log' . DS);
defined('CACHE_PATH') or define('CACHE_PATH', RUNTIME_PATH . 'cache' . DS);
defined('TEMP_PATH') or define('TEMP_PATH', RUNTIME_PATH . 'temp' . DS);
defined('CONF_PATH') or define('CONF_PATH', APP_PATH);  // configuration file directory
defined('CONF_EXT') or define('CONF_EXT' . EXT);    // configuration file suffix
defined('ENV_PREFIX') or define('ENV_PREFIX', 'PHP_');  // environment variables prefix

// environment const
define('IS_CLI', PHP_SAPI == 'cli' ? true : false);
define('IS_WIN', strpos(PHP_OS, 'WIN') !== false);  // todo why not define('IS_WIN', straight strpos(PHP_OS, 'WIN')) ?

// load Class:Loader
require CORE_PATH . 'Loader.php';

// load environment variables configuration files
if (is_file(ROOT_PATH . '.env')) {
    $env = parse_ini_file(ROOT_PATH . '.env', true);
    foreach ($env as $key => $value) {
        $name = ENV_PREFIX .strtoupper($key);
        if (is_array($value)) {
            foreach ($value as $k => $v) {
                $item = $name . '_' . strtoupper($k);
                putenv("$item=$v");
            }
        } else {
            putenv("$name=$value");
        }
    }
}

// register autoload
\think\Loader::register();

// register error and exception handle strategy
\think\Error::register();

// load convention.php configuration file
\think\Config::set(include THINK_PATH . 'convention.php' .EXT);