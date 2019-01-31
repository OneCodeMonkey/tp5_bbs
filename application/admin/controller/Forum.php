<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Forum as ForumModel;

class Forum extends Common
{
    public function index() {
        $forum = new ForumModel();
        $ks = input('ks');
        $tptc = $forum->alias('f')->join('category c', 'c.id=f.tid')->field('f.*,c.id as cid,c.name')->order('f.id desc')->where('title', 'like', '%' . $ks . '%')->paginate(15, false, $config = [
            'query' =>  [
                'ks' => $ks,
            ],
        ]);
        $this->assign('tptc', $tptc);
        return view();
    }

    public function edit () {
        $forum = new ForumModel();
        if (request()->isPost()) {
            $data = input('post.');
            $data['description'] = substr_zh(remove_xss(input('content')));
            $data['content'] = remove_xss(input('content'));
            if ($forum->edit($data)) {
                return json(['code' => 200, 'msg' => '修改成功']);
            }
            return json(['code' => 0, 'msg' => '修改失败']);
        }
        $category = db('category');
        $tptc = $forum->find(input('id'));
        $tptcs = $category->select();
        $this->assign(['tptcs' => $tptcs, 'tptc' => $tptc]);
        return view();
    }

    public function doUploadPic () {
        $file = request()->file('FileName');
        $info = $file->move(ROOT_PATH . DS . 'uploads');
        if ($info) {
            $path = WEB_URL . DS . 'uploads' . DS . $info->getSaveName();
            echo str_replace("\\", "/", $path);
        }
    }

    public function dels () {
        $forum = new ForumModel();
        if ($forum->destroy(input('post.id'))) {
            return json(['code' => 200, 'msg' => '删除成功']);
        }
        return json(['code' => 0, 'msg' => '删除失败']);
    }

    public function delss () {
        $forum = new ForumModel();
        $params = input('post.');
        $ids = implode(',', $params['ids']);
        $result = $forum->batches('delete', $ids);
        if ($result) {
            return json(['code' => 200, 'msg' => '批量删除成功']);
        }
        return json(['code' => 0, 'msg' => '批量删除失败']);
    }

    public function change_choice () {
        if (request()->isAjax()) {
            $change = input('change');
            $choice = db('forum')->field('choice')->where('id', $change)->find();
            $choice = $choice['choice'];
            if ($choice == 1) {
                db('forum')->where('id', $change)->update(['choice' => 0]);
                echo 1;
            }
            db('forum')->where('id', $change)->update(['choice' => 1]);
            echo 2;
        }
        $this->error('非法操作');
    }

    public function change_set_top () {
        if (request()->isAjax()) {
            $change = input('change');
            $set_top = db('forum')->field('settop')->where('id', $change)->find();
            $set_top = $set_top['settop'];
            if ($set_top == 1) {
                db('forum')->where('id', $change)->update(['settop' => 0]);
                echo 1;
            }
            db('forum')->where('id', $change)->update(['settop' => 1]);
            echo 2;
        }
        $this->error('非法操作');
    }

    public function change_open () {
        if (request()->isAjax()) {
            $change = input('change');
            $open = db('forum')->field('open')->where('id', $change)->find();
            $open = $open['open'];
            if ($open == 1){
                db('forum')->where('id', $change)->update(['open' => 0]);
                echo 1;
            }
            db('forum')->where('id', $change)->update(['open' => 1]);
            echo 2;
        }
        $this->error('非法操作');
    }
}
