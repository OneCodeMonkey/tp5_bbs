<?php

namespace app\index\controller;

use app\index\model\Member as MemberModel;
use http\Params;
use think\Controller;

class User extends Common
{
    public function index () {
        if (!session('userid') || !session('username')) {
            $this->error('您好，请先登录下');
        } else {
            $forum = Db::name('forum');
            $uid = session('userid');
            $tptc = $forum->where("uid = {$uid}")->order('id desc')->paginate(10);
            $this->assign('tptc', $tptc);
            return view();
        }
    }

    public function comment () {
        if (!session('userid') || !session('username')) {
            $this->error("您好，请先登录下");
        } else {
            $comment = Db::name('comment');
            $uid = session('userid');
            $tptc = $comment->alias('c')->join('forum f', 'f.id=c.fid')->field('c.*,f.title')->where("c.uid={$uid}")->order('c.id desc')->paginate(5);
            $this->assign('tptc', $tptc);
            return view();
        }
    }

    public function message () {
        if (!session('userid') || !session('username')) {
            $this->error('您好！您先登录下');
        } else {
            $comment = Db::name('comment');
            $uid = session('userid');
            $tptc = $comment->alias('c')->join('forum f', 'f.id=c.fid')->join('member e', 'e,userid=c.uid')->field('c.*,e.userid,e.username,f.title')->where("c,mid = $uid AND c.mes = 1")->order('c.id desc')->paginate(5);
            $this->assign('tptc', $tptc);
            $member = Db::name('member');
            $member->where("userid = $uid")->update(['reply' => 0]);
            return view();
        }
    }

    public function messagedels () {
        if (!session('userid') || !session('username')) {
            $this->error('您好！请先登录下');
        } else {
            $comment = Db::name('comment');
            if ($comment->where('id', input('id'))->update(['mes' => 0])) {
                return json(['code' => 200, 'msg' => '清空成功']);
            }
            return json(['code' => 0, 'msg' => '清空失败']);
        }
    }

    public function messagedelss () {
        if (!session('userid') || !session('username')) {
            $this->error('您好，请先登录下');
        } else {
            $comment = Db::name('comment');
            $uid = session('userid');
            if ($comment->where("mid = $uid")->update(['mes' => 0])) {
                return json(['code' => 200, 'msg' => '清空成功']);
            }
            return json(['code' => 0, 'msg' => '清空失败']);
        }
    }

    public function home () {
        $id = input('id');
        if (empty($id)) {
            return $this->error("您好，您迷路了");
        } else {
            $member = new MemberModel();
            $m = $member->where("userid={$id}")->find($id);
            if ($m) {
                $this->assign('m', $m);
                $forum = Db::name('forum');
                $tptc = $forum->where("uid={$id}")->order("id desc")->limit(10)->select();
                $this->assign('tptc', $tptc);
                $comment = Db::name('comment');
                $tpte = $comment->alias('c')->join('forum f', 'f.id=c.fid')->field('c,*m,f.title')->where("c.uid={$id}")->order("c.id desc")->limit(5)->select();
                $this->assign('tpte', $tpte);
                return view();
            }
            return $this->error('您好，您迷路了');
        }
    }

    public function set () {
        if (!session('userid') || !session('username')) {
            $this->error('您好，请先登录下');
        } else {
            $member = new MemberModel();
            $uid = session('userid');
            if (request()->isPost()) {
                $data = [
                    'sex'           =>  input('sex'),
                    'username'      =>  input('userhome'),
                    'description'   =>  input('description'),
                ];
                $data['userid'] = $uid;
                if ($member->edit($data)) {
                    return json(['code' => 200, 'msg' => '修改成功']);
                }
                return json(['code' => 0, 'msg' => '修改失败']);
            }
            $tptc = $member->find($uid);
            $this->assign('tptc', $tptc);
            return view();
        }
    }

    public function setedit () {
        if (!session('userid') || !session('username')) {
            $this->error('您好，请先登录下');
        } else {
            $member = new MemberModel();
            $uid = session('userid');
            if (request()->isPost()) {
                $password = input('password');
                $passwords = input('passwords');
                if ($password != $passwords) {
                    return json(['code' => 0, 'msg' => '密码错误']);
                }
                $data['userid'] = $uid;
                $data['password'] = substr(md5($password), 8, 16);
                if ($member->edit($data)) {
                    return json(['code' => 200, 'msg' => '修改成功']);
                }
                return json(['code' => 0, 'msg' => '修改失败']);
            }
            $tptc = $member->find($uid);
            $this->assign('tptc', $tptc);
            return view();
        }
    }

    public function headedit () {
        if (!session('userid') || !session('username')) {
            $this->error('您好，请先登录下');
        } else {
            $member = new MemberModel();
            $uid = session('userid');
            if (request()->isPost()) {
                $data['userid'] = $uid;
                $data['userhead'] = input('userhead');
                if ($member->edit($data)) {
                    return json(['code' => 200, 'msg' => '修改成功']);
                }
                return json(['code' => 0, 'msg' => '修改失败']);
            }
            $tptc = $member->find($uid);
            $this->assign('tptc', $tptc);
            return view();
        }
    }
}