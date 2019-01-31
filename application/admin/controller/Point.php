<?php

namespace app\admin\controller;

use think\Controller;

class Point extends Common
{
    public function index () {
        return view();
    }

    public function add () {
        $path = 'application/extra/point.php';
        $file = include $path;
        $config = [
            'LOGIN_POINT'   =>  input('LOGIN_POINT'),
            'REG_POINT'     =>  input('REG_POINT'),
            'ADD_POINT'     =>  input('ADD_POINT'),
            'EDIT_POINT'    =>  input('EDIT_POINT'),
            'GRADE_AVIP'    =>  input('GRADE_AVIP'),
            'GRADE_BVIP'    =>  input('GRADE_BVIP'),
            'GRADE_CVIP'    =>  input('GRADE_CVIP'),
            'GRADE_DVIP'    =>  input('GRADE_DVIP'),
            'GRADE_EVIP'    =>  input('GRADE_EVIP'),
            'GRADE_FVIP'    =>  input('GRADE_FVIP'),
            'GRADE_GVIP'    =>  input('GRADE_GVIP'),
            'GRADE_HVIP'    =>  input('GRADE_HVIP'),
            'GRADE_IVIP'    =>  input('GRADE_IVIP'),
            'GRADE_JVIP'    =>  input('GRADE_JVIP'),
            'GRADE_KVIP'    =>  input('GRADE_KVIP'),

        ];
        $res = array_merge($file, $config);
        $str = '<?php return [';
        foreach ($res as $k => $v) {
            $str .= '\'' . $k . '\'' . '=>' . '\'' . $v . '\'' . ',';
        };
        $str .= ']; ';
        if (file_put_contents($path, $str)) {
            return json(['code' => 200, 'msg' => '修改成功']);
        }
        return json(['code' => 0, 'msg' => '修改失败']);
    }
}
