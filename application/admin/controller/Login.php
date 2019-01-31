<?php

namespace app\admin\controller;

use http\Params;
use think\Controller;

class Login extends Controller
{
    public function index () {
        if (request()->isPost()) {
            $this->check(input('code'));
            $data = input('post.');
            $user = db('member')->where('grades = 1')->where('username', $data['username'])->find();
            if ($user) {
                if ($user['password'] == substr(md5($data['password']), 8, 16)) {
                    if ($user['kouling'] == $data['kouling']) {
                        session('usermail', $user['usermail']);
                        session('username', $user['username']);
                        session('userid', $user['userid']);
                        session('userhead', $user['userhead']);
                        session('kouling', $user['kouling']);
                        return json(['code' => 200, 'msg' => '登录成功']);
                    }
                    return json(['code' => 0, 'msg' => '口令错误']);
                }
                return json(['code' => 0, 'msg' => '密码错误']);
            }
            return json(['code' => 0, 'msg' => '账号错误']);
        }
        return $this->fetch();
    }

    public function check ($code = '') {
        if (!captcha_check($code)) {
            $this->error('验证码错误');
        }
        return true;
    }

    public function logout () {
        session('userid', NULL);
        session('username', NULL);
        session('usermail', NULL);
        session('kouling', NULL);
        return json(['code' => 200, 'msg' => '退出成功']);
    }
}