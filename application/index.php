<?php

return  [
    '__pattern__'   =>  [
        'name'  =>  '\w+',
    ],
    '[home]'        =>  [
        ':id'   =>  [
            'index/user/home',
            ['id' => '\d+'],
        ],
    ],
    '[thread]'      =>  [
        ':id'   =>  [
            'index/index/thread',
            ['id' => '\d+'],
        ],
    ],
    '[view]'        =>  [
        ':id'   =>  [
            'index/index/view',
            ['id' => '\d+'],
        ],
    ],
    '[edit]'        =>  [
        ':id'   =>  [
            'index/forum/edit',
            ['id' => '\d+'],
        ],
    ],
    '[edits]'       =>  [
        ':id'   =>  [
            'index/comment/edit',
            ['id' => '\d+'],
        ],
    ],
    'choice'        =>  ['index/index/choice', ['ext' => 'html']],
    'forum'         =>  ['index/index/forum', ['ext' => 'html']],
    'search'        =>  ['index/index/search', ['ext' => 'html']],
    'add'           =>  ['index/forum/add', ['ext' => 'html']],
    'user/set'      =>  ['index/user/set', ['ext' => 'html']],
    'user/comment'  =>  ['index/user/comment', ['ext' => 'html']],
    'user/index'    =>  ['index/user/index', ['ext' => 'html']],
    'login/reg'     =>  ['index/login/reg', ['ext' => 'html']],
    'login/index'   =>  ['index/login/index', ['ext' => 'html']],

];