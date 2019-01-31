<?php

namespace app\admin\controller;

use think\Controller;
use app\admin\model\Banner as BannerModel;

class Banner extends Common
{
    public function index () {
        $banner = new BannerModel();
        $tptc = $banner->order('id desc')->paginate(15);
        $this->assign('tptc', $tptc);
        return view();
    }

    public function add () {
        $banner = new BannerModel();
        if (request()->isPost()) {
            $data = input('post.');      // todo why add a "."
            $data['time'] = time();
            if ($banner->add($data)) {
                return json(['code' => 200, 'msg' => '添加成功']);
            }
            return json(['code' => 0, 'msg' => '添加失败']);
        }
        $tptc = $banner->select();
        $this->assign('tptc', $tptc);
        return view();
    }

    public function edit () {
        $banner = new BannerModel();
        if (request()->isPost()) {
            $data = input('post.');     // todo why add a "."
            if ($banner->edit($data)) {
                return json(['code' => 200, 'msg' => '修改成功']);
            }
            return json(['code' => 0, 'msg' => '修改失败']);
        }
        $tptc = $banner->find(input('id'));
        $this->assign('tptc', $tptc);
        return view();
    }

    public function dels () {
        $banner = new BannerModel();
        if ($banner->destroy(input('post.id'))) {
            return json(['code' => 200, 'msg' => '删除成功']);
        }
        return json(['code' => 0, 'msg' => '删除失败']);
    }

    public function delss () {
        $banner = new BannerModel();
        $params = input('post.');       // todo why add a "."
        $ids = implode(',', $params['ids']);
        $result = $banner->batches('delete', $ids);
        if ($result) {
            return json(['code' => 200, 'msg' => '批量删除成功']);
        }
        return json(['code' => 0, 'msg' => '批量删除成功']);
    }

    public function changeshow () {
        if (request()->isAjax()) {
            $change = input('change');
            $show = db('banner')->field('show')->where('id', $change)->find();
            $show = $show['show'];
            if ($show == 1) {
                db('banner')->where('id', $change)->update(['show' => 0]);
                echo 1;
            }
            db('banner')->where('id', $change)->update(['show' => 1]);
            echo 2;
        }
        $this->error('非法操作');
    }
}