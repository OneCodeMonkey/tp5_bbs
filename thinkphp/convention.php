<?php

return [
    // application namespace
    'app_namespace'         =>  'app',
    // application debug mode
    'app_debug'             =>   true,
    // application trace
    'app_trace'             =>   false,
    // application status
    'app_status'            =>   '',
    // whether support multi-module
    'app_multi_module'      =>   true,
    // entrance auto bind module
    'auto_bind_module'      =>   false,
    // registered root namespace
    'root_namespace'        =>   [],
    // extend function file
    'extra_file_list'       =>   [THINK_PATH . 'helper' . EXT],
    // default output type
    'default_return_type'   =>   'html',
    // default return type of ajax, which can choose [json, xml]
    'default_ajax_return'   =>   'json',
    // default method of handling jsonp
    'default_jsonp_return'  =>   'jsonpReturn',
    // default method to handle jsonp
    'var_jsonp_handler'     =>   'callback',
    // default timezone
    'default_timezone'      =>   'PRC',
    // whether open multi-language
    'lang_switch_on'        =>   'false',
    // default global filter method, separated by comma
    'default_filter'        =>   '',
    // default language
    'default_lang'          =>   'zh-cn',
    // class suffix
    'class_suffix'          =>   false,
    // controller suffix
    'controller_suffix'     =>   false,

    // +----------------------------------------------------------------------
    // | module settings
    // +----------------------------------------------------------------------

    // default module name
    'default_module'        =>  'index',
    // deny visit module
    'deny_module_list'      =>  ['common'],
    // default controller
    'default_controller'    =>  'Index',
    // default action
    'default_action'        =>  'index',
    // default validator
    'default_validate'      =>  '',
    // default empty controller
    'empty_controller'      =>  'Error',
    // action prefix
    'use_action_prefix'     =>  false,
    // action_suffix
    'action_suffix'         =>  '',
    // auto search controller
    'controller_auto_search'=>  false,

    // +----------------------------------------------------------------------
    // | url settings
    // +----------------------------------------------------------------------

    // PATHINFO variable, for compatibility mode
    'var_pathinfo'          =>  's',
    // compatibility PATH_INFO obtaining
    'pathinfo_fetch'        =>  ['ORIG_PATH_INFO', 'REDIRECT_PATH_INFO', 'REDIRECT_URL'],
    // pathinfo separator
    'pathinfo_depr'         =>  '/',
    // url htaccess suffix
    'url_html_suffix'       =>  'html',
    // url general params, for auto-generating
    'url_common_param'      =>  false,
    // type of url param, 0 -- according to name in paris, 1 -- according to order
    'url_param_type'        =>  0,
    // whether open route
    'url_route_on'          =>  true,
    // route configuration file(support multi-configuration)
    'route_config_file'     =>  ['route'],
    // whether to use complete route
    'route_complete_match'  =>  false,
    // whether forcing to use route
    'url_route_must'        =>  false,
    // domain deployment
    'url_domain_deploy'     =>  false,
    // domain root, for example: thinkphp.cn
    'url_domain_root'       =>  '',
    //  whether auto convert name of controllers and actions
    'url_convert'           =>  false,
    // default controller layer
    'url_controller_layer'  =>  'controller',
    // form request type facade variable
    'var_method'            =>  '_method',
    // form ajax facade variable
    'var_ajax'              =>  '_ajax',
    // form pjax facade variable
    'var_pjax'              =>  'pjax',
    // whether open request cache, true means open. support setting rules of request cache
    'request_cache'         =>  false,
    // expiring time of request cache
    'request_cache'         =>  null,
    // global request cache exception rules
    'request_cache_except'  =>  [],

    // +----------------------------------------------------------------------
    // | template settings
    // +----------------------------------------------------------------------

    'template'              =>  [
        // template engine type, support php think extension
        'type'          =>  'Think',
        // view basic directory
        'view_base'     =>  '',
        // current view directory of templates, null means auto obtain
        'view_path'     =>  '',
        // template suffix
        'view_suffix'   =>  'html',
        // template file separator
        'view_depr'     =>  DS,
        // begin signal of general mark in template engine
        'tpl_begin'     =>  '{',
        // end signal of general mark in template engine
        'tpl_end'       =>  '}',
        // begin signal of mark library
        'taglib_begin'  =>  '{',
        // end signal of mark library
        'taglib_end'    =>  '}',
    ],

    // replacement of view outputing string
    'view_replace_str'      =>  [],
    // template file of default jumping page
    'dispatch_success_tmpl' =>  THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',
    'dispatch_error_tmpl'   =>  THINK_PATH . 'tpl' . DS . 'dispatch_jump.tpl',

    // +----------------------------------------------------------------------
    // | exception and error settings
    // +----------------------------------------------------------------------

    // template file of error page
    'exception_tmpl'        =>  THINK_PATH . 'tpl' . DS . 'think_exception.tpl',
    // error message, available in non-debug mode
    'error_message'         =>  '页面错误！请稍后再试~',
    // whether to show error message
    'show_error_msg'        =>  false,
    // exception handle class, null means using \think\exception\Handle
    'exception_handle'      =>  '',

    // +----------------------------------------------------------------------
    // | Log settings
    // +----------------------------------------------------------------------

    'log'                   =>  [
        // log saving type, internal file socket supports extension
        'type'          =>  'File',
        // log saving directory
        'path'          =>  LOG_PATH,
        // log level
        'level'         =>  [],
    ],

    // +----------------------------------------------------------------------
    // | Trace settings, available when opening app_trace
    // +----------------------------------------------------------------------

    'trace'                 =>  [
        // internal Html Console supports extension
        'type'          =>  'Html',
    ],

    // +----------------------------------------------------------------------
    // | Cache settings
    // +----------------------------------------------------------------------

    'cache'                 =>  [
        // driver type
        'type'          =>  'File',
        // cache saving directory
        'path'          =>  CACHE_PATH,
        // cache prefix
        'prefix'        =>  '',
        // cache expiring time, 0 means forever stored
        'expire'        =>  0,
    ],

    // +----------------------------------------------------------------------
    // | Session settings
    // +----------------------------------------------------------------------

    'session'               =>  [
        'id'            =>  '',
        // SESSION_ID variable, to solve flash uploading cross-origin trouble
        'var_session_id'=>  '',
        // SESSION prefix
        'prefix'        =>  'think',
        // driver type, supports redis, memcache, memcached
        'type'          =>  '',
        // whether to open SESSION
        'auto_start'    =>  true,
        'httponly'      =>  true,
        'secure'        =>  false,
    ],

    // +----------------------------------------------------------------------
    // | Cookie setting
    // +----------------------------------------------------------------------

    'cookie'                =>  [
        // cookie prefix
        'prefix'        =>  '',
        // cookie saving time
        'expire'        =>  0,
        // cookie saving directory
        'path'          =>  '/',
        // cookie available domain
        'domain'        =>  '',
        // cookie to use safe transferring
        'secure'        =>  false,
        // http-only setting
        'httponly'      =>  '',
        // whether to use setcookie
        'setcookie'     =>  true,
    ],

    // +----------------------------------------------------------------------
    // | database settings
    // +----------------------------------------------------------------------

    'database'              =>  [
        // database type
        'type'          =>  'mysql',
        // database dsn configuration
        'dsn'           =>  '',
        // server ip
        'hostname'      =>  '127.0.0.1',
        // database name
        'database'      =>  '',
        // username
        'username'      =>  'root',
        // password
        'password'      =>  '',
        // port
        'hostport'      =>  '',
        // database connecting params
        'params'        =>  [],
        // database coding charset
        'charset'       =>  'utf8',
        // database table prefix
        'prefix'        =>  '',
        // database debug mode
        'debug'         =>  false,
        // database deployment type, 0 -- assembling(single server), 1 -- distributing(master-slave)
        'deploy'        =>  0,
        // database to separate reading and writing, available in distributing deployment
        'rw_separate'   =>  false,
        // master server number when reading and writing separated
        'master_num'    =>  1,
        // assign slave server id
        'slave_no'      =>  '',
        // whether to check fields strictly
        'fields_strict' =>  true,
        // returning type of dataset
        'resultset_type'=>  'array',
        // auto write timestamp
        'auto_timestamp'=>  false,
        // time format when getting time-related fields
        'datetime_format'   =>  'Y-m-d H:i:s',
        // whether needs to analysis performance of SQL
        'sql_explain'   =>  false,
    ],

    // page separating settings
    'paginate'              =>  [
        'type'          =>  'bootstrap',
        'var_page'      =>  'page',
        'list_rows'     =>  15,
    ],

];