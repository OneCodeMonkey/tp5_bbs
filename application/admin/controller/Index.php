<?php

namespace app\admin\controller;

use think\Controller;

class Index extends Common
{
    public function index () {
        return view();
    }

    public function home () {
        return view();
    }

    function update () {
        // todo what is the attribute in a default function? public ,private or protected ?
        array_map('unlink', glob(TEMP_PATH . '/*.php'));
        rmdir(TEMP_PATH);
        return json(['code' => 200, 'msg' => '更新缓存成功']);
    }
}