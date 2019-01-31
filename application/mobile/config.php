<?php

return [
    'template'  =>  [
        'view_path'     =>  './template/' . config('web.WEB_MOB') . '/',
        'view_depr'     =>  '_',
    ],
    'view_replace_str'  =>  [
        '__UPLO__'  =>  WEB_URL,
        '__ROOT__'  =>  WEB_URL . '/mobile',
        '__INDEX__' =>  WEB_URL . '/index.php/mobile',
        '__ADMIN__' =>  WEB_URL . '/public',
        '__HOME__'  =>  WEB_URL . '/template/mobile/public',
    ],
];