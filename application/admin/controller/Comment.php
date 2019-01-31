<?php

namespace app\admin\controller;

use http\Params;
use think\Controller;
use app\admin\model\Comment as CommentModel;

class Comment extends Common
{
    public function index () {
        $comment = new CommentModel();
        $tptc = $comment->alias('c')->join('forum f', 'f.id=c.fid')->join('member m', 'm.userid=c.uid')->field('c.*,f.title,m.username')->order('c.id desc')->paginate(15);
        $this->assign('tptc', $tptc);
        return view();
    }

    public function edit () {
        $comment = new CommentModel();
        if (request()->isPost()) {
            $data = input('post.');
            $data['content'] = remove_xss(input('content'));
            if ($comment->edit($data)) {
                return json(['code' => 200, 'msg' => '修改成功']);
            }
            return json(['code' => 0, 'msg' => '修改失败']);
        }
        $tptc = $comment->find(input('id'));
        $this->assign('tptc', $tptc);
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
        $comment = new CommentModel();
        if ($comment->destroy(input('post.id'))) {
            return json(['code' => 200, 'msg' => '删除成功']);
        }
        return json(['code' => 0, 'msg' => '删除失败']);
    }

    public function delss () {
        $comment = new CommentModel();
        $params = input('post.');
        $ids = implode(',', $params['ids']);
        $result = $comment->batches('delete', $ids);
        if ($result) {
            return json(['code' => 200, 'msg' => '批量删除成功']);
        }
        return json(['code' => 0, 'msg' => '批量删除失败']);
    }
}