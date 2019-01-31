<?php

namespace app\admin\controller;

use think\Controller;

class Upload extends Common
{
    function _initialize () {
        parent::_initialize();
        $this->model = model('admin/upload');
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
        }
        $data = [
            'code'  =>  1,
            'msg'   =>  $result['msg'],
        ];
        return json($data);
    }

    public function umeditor_upimage () {
        $result = $this->model->upfile('umeditor', 'upfile', true);
        if ($result['code'] == 200) {
            $data = [
                'originalName'  =>  $result['info']['name'],
                'name'          =>  $result['savename'],
                'url'           =>  $result['path'],
                'size'          =>  $result['info']['size'],
                'type'          =>  $result['info']['type'],
                'state'         =>  "SUCCESS",
            ];
        }
        $data = [
            'originalName'      =>  $result['info']['name'],
            'name'              =>  $result['savename'],
            'url'               =>  $result['path'],
            'size'              =>  $result['info']['size'],
            'type'              =>  $result['info']['type'],
            'state'             =>  $result['msg'],
        ];
        echo json_encode($data);
        exit;
    }
}
