<?php

namespace app\admin\controller;

use http\Params;
use think\Controller;
use app\admin\model\Navtop as NavtopModel;

class Navtop extends Common
{
    protected $beforeActionList = [
        'delsoncate' => [
            'only' => 'dels',
        ],
    ];

    public function index () {
        $navtop = new NavtopModel();
        $tptc = $navtop->cate_tree();
        $this->assign('tptc', $tptc);
        return view();
    }

    public function add () {
        $navtop = new NavtopModel();
        if (request()->isPost()) {
            $data = input('post.');
            $data['time'] = time();
            if ($navtop->add($data)) {
                return json(['code' => 200, 'msg' => '添加成功']);
            }
            return json(['code' => 0, 'msg' => '添加失败']);
        }
        $tptc = $navtop->cate_tree();
        $this->assign('tptc', $tptc);
        return view();
    }

    public function edit () {
        $navtop = new NavtopModel();
        if (request()->isPost()) {
            $data = input('post.');
            $data['blank'] = input('blank');
            if ($navtop->edit($data)) {
                return json(['code' => 200, 'msg' => '修改成功']);
            }
            return json(['code' => 0, 'msg' => '修改失败']);
        }
        $tptc = $navtop->find(input('id'));
        $tptcs = $navtop->cate_tree();
        $this->assign(['tptcs' => $tptcs, 'tptc' => $tptc]);
        return view();
    }

    public function dels () {
        $dels = db('navtop')->delete(input('id'));
        if ($dels) {
            return json(['code' => 200, 'msg' => '删除成功']);
        }
        return json(['code' => 0, 'msg' => '删除失败']);
    }

    public function delsoncate () {
        $navid = input('id');
        $navtop = new NavtopModel();
        $sonids = $navtop->get_children_id($navid);
        if ($sonids) {
            db('navtop')->delete($sonids);
        }
    }

    public function change_show () {
        if (request()->isAjax()) {
            $change = input('change');
            $show = db('navtop')->field('show')->where('id', $change)->find();
            $show = $show['show'];
            if ($show == 1) {
                db('navtop')->where('id', $change)->update(['show' => 0]);
                echo 1;
            }
            db('navtop')->where('id', $change)->update(['show' => 1]);
        }
        $this->error('非法操作');
    }

    public function change_blank () {
        if (request()->isAjax()) {
            $change = input('change');
            $blank = db('navtop')->field('blank')->where('id', $change)->find();
            $blank = $blank['blank'];
            if ($blank == 1) {
                db('navtop')->where('id', $change)->update(['blank' => 0]);
                echo 1;
            }
            db('navtop')->where('id', $change)->update(['blank' => 1]);
            echo 2;
        }
        $this->error('非法操作');
    }
}
