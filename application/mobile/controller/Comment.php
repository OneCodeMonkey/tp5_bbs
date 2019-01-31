<?php

namespace app\mobile\controller;

use app\index\controller\Common;
use http\Params;
use think\Controller;
use think\Db;
use app\index\model\Comment as CommentModel;

class Comment extends Common
{
    public function add () {
        if (!session('userid') || !session('username')) {
            $this->error('您好，请先登录');
        } else {
            $comment = new CommonModel();
            $id = input('id');
            $uid = session('userid');
            if (request()->isPost()) {
                $webcnt = 1;
                if ($webcnt != config('web.WEB_CNT')) {
                    return json(['code' => 0, 'msg' => '已关闭评论帖子']);
                }
                $member = Db::name('member');
                $t = $member->where('userid', $uid)->find();
                $this->assign('t', $t);
                if ($webcnt != $t['status']) {
                    return json(['code' => 0, 'msg' => '评论帖子异常']);
                }
                $data = input('post.');
                $data['time'] = time();
                $data['fid'] = $id;
                $data['uid'] = session('userid');
                $data['mid'] = input('mid');
                $data['content'] = remove_xss(input('content'));
                $member->where('userid', session('userid'))->setInc('point', config('point.EDIT_POINT'));
                $member->where('userid', input('mid'))->setInc('reply', 1);
                $forum = Db::name('forum');
                $forum->where('id', $id)->setInc('reply', 1);
                if ($comment->add($data)) {
                    return json(['code' => 200, 'msg' => '回复成功']);
                }
                return json(['code' => 0, 'msg' => '回复失败']);
            }
        }
    }

    public function edit () {
        if (!session('userid') || !session('username')) {
            $this->error('您好，请先登录下');
        } else {
            $id = input('id');
            $uid = session('userid');
            $comment = new CommentModel();
            $a = $comment->find($id);
            if (empty($id) || $a == null || $a['uid'] != $uid) {
                $this->error('您好，您迷路了');
            } else {
                if (request()->isPost()) {
                    $webcnt = 1;
                    if ($webcnt != config('web.WEB_CNT')) {
                        return json(['code' => 0, 'msg' => '已关闭修改评论']);
                    }
                    $member = Db::name('member');
                    $t = $member->where('userid', $uid)->find();
                    $this->assign('t', $t);
                    if ($webcnt != $t['status']) {
                        return json(['code' => 0, 'msg' => '修改评论异常']);
                    }
                    $data['id'] = $id;
                    $data['content'] = remove_xss(input('content'));
                    if ($comment->edit($data)) {
                        return json(['code' => 200, 'msg' => '修改成功']);
                    }
                    return json(['code' => 0, 'msg' => '修改失败']);
                }
                $tptc = $comment->alias('c')->join('forum f', 'f.id=c.fid')->field('c.*,f.title')->find($id);
                $this->assign('tptc', $tptc);
                return view();
            }
        }
    }

    public function dels () {
        if (session('userid') != 1) {
            $this->error('您好，您迷路了');
        } else {
            $id = input('id');
            $fid = input('fid');
            $forum = Db::name('forum');
            $forum->where('id', $fid)->setDec('reply', 1);
            if (db('comment')->delete($id)) {
                return json(['code' => 200, 'msg' => '删除成功']);
            }
            return json(['code' => 0, 'msg' => '删除失败']);
        }
    }
}