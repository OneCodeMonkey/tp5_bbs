<?php

return   [
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
];