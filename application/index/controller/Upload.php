<?php

namespace app\index\controller;

use http\Params;
use think\Controller;

class Upload extends Controller
{
    function _initialize () {
        parent::_initialize();
        $this->model = model('index/upload');
    }

    public function upimage () {
        return json($this->model->upfile('images'));
    }

    public function upfile () {
        return json($this->model->upfile('files'));
    }

    public function layedit_upimage () {
        $result = $this->model->upfile('layedit', 'file', true);
        if ($result['code'] == 200) {
            $data = [
                'code'  =>  0,
                'msg'   =>  '上传成功',
                'data'  =>  [
                    'src'   =>  $result['path'],
                    'title' =>  $result['info']['name'],
                ],
            ];
        } else {
            $data = ['code' => 1, 'msg' => $result['msg']];
        }
        return json($data);
    }

    public function umeditor_upimage () {
        $result = $this->model->upfile('umeditor', 'upfile', true);
        $data = [
            'originalName'  =>  $result['info']['name'],
            'name'          =>  $result['savename'],
            'url'           =>  $result['path'],
            'size'          =>  $result['info']['size'],
            'type'          =>  $result['info']['type'],
            'status'        =>  $result['code'] == 200 ? "SUCCESS" : $result['msg'],
        ];
        echo json_encode($data);
        exit;
    }

    public function doUploadPic () {
        if (!session('userid') || !session('username')) {
            $this->error('您好，请先登录下', url('login/index'));
        } else {
            $file = request()->file('FileName');
            $info = $file->move(ROOT_PATH . DS . 'uploads');
            if ($info) {
                $path = WEB_URL . DS . 'uploads' . DS . $info->getSaveName();
                echo str_replace("\\", "/", $path);
            }
        }
    }
}