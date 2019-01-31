<?php

namespace app\admin\controller;

use think\Controller;

class Config extends Common
{
    public function index () {
        return view();
    }

    public function add () {
        $path = 'application/extra/web.php';
        $file = include $path;
        $config = [
            'WEB_TIT'   =>  input('WEB_TIT'),
            'WEB_COM'   =>  input('WEB_COM'),
            'WEB_AUT'   =>  input('WEB_AUT'),
            'WEB_QQ'    =>  input('WEB_QQ'),
            'WEB_ICP'   =>  input('WEB_ICP'),
            'WEB_REG'   =>  input('WEB_REG'),
            'WEB_KEY'   =>  input('WEB_KEY'),
            'WEB_DES'   =>  input('WEB_DES'),
            'WEB_TAG'   =>  input('WEB_TAG'),
            'WEB_TPT'   =>  input('WEB_TPT'),
            'WEB_URL'   =>  input('WEB_URL'),
            'WEB_OPE'   =>  input('WEB_OPE'),
            'WEB_MOB'   =>  input('WEB_MOB'),
            'WEB_ADD'   =>  input('WEB_ADD'),
            'WEB_CNT'   =>  input('WEB_CNT'),
            'WEB_LOG'   =>  input('WEB_LOG'),
        ];
        $res = array_merge($file, $config);
        $str = '<?php return [';
        foreach ($res as $key => $value) {
            $str .= '\'' . $key .'\'' . '=>' . '\'' . $value . '\'' . ',';
        }
        $str .= ']; ';
        if (file_put_contents($path, $str)) {
            return json(['code' => 200, 'msg' => '修改成功']);
        }
        return json(['code' => 0, 'msg' => '修改失败']);
    }
}
