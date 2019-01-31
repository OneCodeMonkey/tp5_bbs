<?php

namespace app\admin\controller;

use http\Params;
use think\Controller;
use app\admin\model\Member as MemberModel;

class Member extends Common
{
    public function idnex () {
        $member = new MemberModel();
        $ks = input('ks');
        $tptc = $member->order('userid desc')->where('username', 'like', '%' . $ks . '%')->paginate(15, false, $config = [
            'query' => [
                'ks' => $ks,
            ],
        ]);
        $this->assign('tptc', $tptc);
        return view();
    }
    
    public function add () {
        $member = new MemberModel();
        if (request()->isPost()) {
            $data = input('post.');
            $data['regtime'] = time();
            $data['password'] = substr(md5(input('password')), 8, 16);
            $data['grades'] = 0;
            $data['userhead'] = '/uploads/20170401/default.png';
            $data['userip'] = $_SERVER['REMOTE_ADDR'];
            if ($member->add($data)) {
                return json(['code' => 200, 'msg' => '添加成功']);
            }
            return json(['code' => 0, 'msg' => '添加失败']);
        }
        $tptc = $member->select();
        $this->assign('tptc', $tptc);
        return view();
    }
    
    public function edit () {
        $member = new MemberModel();
        if (request()->isPost()) {
            $data = input('post.');
            if ($member->edit($data)) {
                return json(['code' => 200, 'msg' => '修改成功']);
            }
            return json(['code' => 0, 'msg' => '修改失败']);
        }
        $tptc = $member->find(input('id'));
        $this->assign('tptc', $tptc);
        return view();
    }
    
    public function edits () {
        $member = new MemberModel();
        if (request()->isPost()) {
            $data = input('post.');
            $data['password'] = substr(md5(input('password')), 8, 16);
            if ($member->edit($data)) {
                return json(['code' => 200, 'msg' => '修改成功']);
            }
            return json(['code' => 0, 'msg' => '修改失败']);
        }
        $tptc = $member->find(input('id'));
        $this->assign('tptc', $tptc);
        return view();
    }

    public function dels () {
        $member = new MemberModel();
        if ($member->destroy(input('post.id'))) {
            return json(['code' => 200, 'msg' => '删除成功']);
        }
        return json(['code' => 200, 'msg' => '删除失败']);
    }

    public function delss () {
        $member = new MemberModel();
        $params = input('post.');
        $ids = implode(',', $params['ids']);
        $result = $member->batches('delete', $ids);
        if ($result) {
            return json(['code' => 200, 'msg' => '批量删除成功']);
        }
        return json(['code' => 0, 'msg' => '批量删除失败']);
    }

    public function change_status () {
        if (request()->isAjax()) {
            $change = input('change');
            $status = db('member')->field('status')->where('userid', $change)->find();
            $status = $status['status'];
            if ($status == 1) {
                db('member')->where('userid', $change)->update(['status' => 0]);
                echo 1;
            }
            db('member')->where('userid', $change)->update(['status' => 1]);
            echo 2;
        }
        $this->error('非法操作');
    }
}