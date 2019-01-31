<?php

namespace app\index\controller;

use http\Params;
use think\Controller;
use think\Db;
use app\index\model\Forum as ForumModel;

class Forum extends Common
{
    public function add () {
        if (!session('userid') || !session('username')) {
            $this->error('您好，请先登录下');
        }
        $forum = new ForumModel();
        if (request()->isPost()) {
            $webadd = 1;
            if ($webadd != config('web.WEB_ADD')) {
                return json(['code' => 0, 'msg' => '已关闭发表帖子']);
            }
            $member = Db::name('member');
            $t = $member->where('userid', session('userid'))->find();
            $this->assign('t', $t);
            if ($webadd != $t['status']) {
                return json(['code' => 0, 'msg' => '发表帖子异常']);
            }
            $data = input('post.');
            $data['time'] = time();
            $data['open'] = config('web.WEB_OPE');
            $data['view'] = 1;
            $data['uid'] = session('userid');
            $data['description'] = substr_zh(remove_xss(input('content')));
            $data['content'] = remove_xss(input('content'));
            $member->where('userid', session('userid'))->setInc('point', config('point.ADD_POINT'));
            if ($forum->add($data)) {
                return json(['code' => 200, 'msg' => '添加成功']);
            }
            return json(['code' => 0, 'msg' => '添加失败']);
        }
        $category = Db::name('category');
        $tptc = $category->select();
        $this->assign('tptc', $tptc);
        $tags = config('web.WEB_TAG');
        $tagss = explode(',', $tags);
        $this->assign('tagss', $tagss);
        return view();
    }

    public function edit () {
        if (!session('userid') || !session('username')) {
            $this->error('您好，请先登录下');
        }
        $id = input('id');
        $uid = session('userid');
        $forum = new ForumModel();
        $a = $forum->find($id);
        if (empty($id) || $a == null || $a['uid'] != $uid) {
            $this->error('您好！您迷路了');
        }
        if (request()->isPost()) {
            $webadd = 1;
            if ($webadd != config('web.WEB_ADD')) {
                return json(['code' => 0, 'msg' => '已关闭修改帖子']);
            }
            $member = Db::name('member');
            $t = $member->where('userid', $uid)->find();
            $this->assign('t', $t);
            if ($webadd != $t['status']) {
                return json(['code' => 0, 'msg' => '修改帖子异常']);
            }
            $data = [
                'title'     =>  input('title'),
                'tid'       =>  input('tid'),
                'keywords'  =>  input('keywords'),
            ];
            $data['id'] = $id;
            $data['description'] = substr_zh(remove_xss(input('content')));
            $data['content'] = remove_xss(input('content'));
            if ($forum->edit($data)) {
                return json(['code' => 200, 'msg' => '修改成功']);
            }
            return json(['code' => 0, 'msg' => '修改失败']);
        }
        $category = Db::name('category');
        $tptc = $forum->find($id);
        $tptcs = $category->select();
        $this->assign(['tptcs' => $tptcs, 'tptc' => $tptc]);
        $tags = config('web.WEB_TAG');
        $tagss = explode(',', $tags);
        $this->assign('tagss', $tagss);
        return view();
    }
}