<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Links as LinksModel;

class Links extends Common
{
    public function index () {
        $links = new LinksModel();
        $tptc = $links->order('id desc')->paginate(15);
        $this->assign('tptc', $tptc);
        return view();
    }

    public function add () {
        $links = new LinksModel();
        if (request()->isPost()) {
            $data = input('post.');
            $data['time'] = time();
            if ($links->add($data)) {
                return json(['code' => 200, 'msg' => '添加成功']);
            }
            return json(['code' => 0, 'msg' => '添加失败']);
        }
        $tptc = $links->select();
        $this->assign('tptc', $tptc);
        return view();
    }

    public function edit () {
        $links = new LinksModel();
        if (request()->isPost()) {
            $data = input('post.');
            $data['time'] = time();
            if ($links->add($data)) {
                return json(['code' => 200, 'msg' => '添加成功']);
            }
            return json(['code' => 0, 'msg' => '添加失败']);
        }
        $tptc = $links->find(input('id'));
        $this->assign('tptc', $tptc);
        return view();
    }

    public function dels () {
        $links = new LinksModel();
        if ($links->destroy(input('post.id'))) {
            return json(['code' => 200, 'msg' => '删除成功']);
        }
        return json(['code' => 0, 'msg' => '删除失败']);
    }

    public function delss () {
        $links = new LinksModel();
        $params = input('post.');
        $ids = implode(',', $params['ids']);
        $result = $links->batches('delete', $ids);
        if ($result) {
            return json(['code' => 200, 'msg' => '批量删除成功']);
        }
        return json(['code' => 0, 'msg' => '批量删除失败']);
    }

    public function change_show () {
        if (request()->isAjax()) {
            $change = input('change');
            $show = db('links')->field('show')->where('id', $change)->find();
            $show = $show['show'];
            if ($show == 1) {
                db('links')->where('id', $change)->update(['show' => 0]);
                echo 1;
            }
            db('links')->where('id', $change)->update(['show' => 1]);
            echo 2;
        }
        $this->error('非法操作');
    }
}
