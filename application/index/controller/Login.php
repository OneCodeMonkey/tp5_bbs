<?php

namespace app\index\controller;

use http\Params;
use think\Controller;
use app\index\model\Member as MemberModel;

class Login extends Common
{
    public function index () {
        $member = new MemberModel();
        if (request()->isPost()) {
            $this->check(input('code'));
            $data = input('post.');
            $status['status'] = 1;
            $weblog = 1;
            if ($weblog != config('web.WEB_LOG')) {
                return json(['code' => 0, 'msg' => '已关闭会员登录']);
            }
            $user = $member->where($status)->where('usermail', $data['usermail'])->find();
            if ($user) {
                if ($user['password'] == substr(md5($data['password']), 8, 16)) {
                    session('username', $user['username']);
                    session('userid', $user['userid']);
                    $member->where('userid', session('userid'))->setInc('point', config('point.LOGIN_POINT'));
                    return json(['code' => 200, 'msg' => '登录成功']);
                }
                return json(['code' => 0, 'msg' => '登录失败']);
            }
            return json(['code' => 0, 'msg' => '账号错误']);
        }
        return view();
    }

    public function reg () {
        $member = new MemberModel();
        if (request()->isPost()) {
            $this->check(input('code'));
            $data = input('post.');
            $password = input('password');
            $passwords = input('passwords');
            $webreg = 1;
            if ($webreg != config('web.WEB_REG')) {
                return json(['code' => 0, 'msg' => '已关闭会员注册']);
            }
            if ($password != $passwords) {
                return json(['code' => 0, 'msg' => '密码错误']);
            }
            $mail = $member->where('usermail', $data['usermail'])->find();
            if (!$mail) {
                $user = $member->where('username', $data['username'])->find();
                if ($user) {
                    $data['regtime'] = time();
                    $data['grades'] = 0;
                    $data['status'] = config('web.WEB_REG');
                    $data['point'] = config('point.REG_POINT');
                    $data['userhead'] = '/uploads/20170401/default.png';
                    $data['userip'] = $_SERVER['REMOVE_ADDR'];
                    $data['password'] = substr(md5($password), 8, 16);
                    if ($member->add($data)) {
                        return json(['code' => 200, 'msg' => '注册成功']);
                    }
                    return json(['code' => 0, 'msg' => '注册失败']);
                }
                return json(['code' => 0, 'msg' => '该昵称已存在']);
            }
            return json(['code' => 0, 'msg' => '该邮箱已存在']);
        }
        return view();
    }

    public function check ($code = '') {
        if (!captcha_check($code)) {
            $this->error('验证码错误');
        }
        return true;
    }

    public function logout () {
        session('userid', null);
        session('username', null);
        session('usermail', null);
        session('kouling', null);
        return json(['code' => 200, 'msg' => '退出成功']);
    }
}