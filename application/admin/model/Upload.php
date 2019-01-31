<?php

namespace app\admin\model;

use think\Model;

class Upload extends Model
{
    function initialize ($data) {
       parent::initialize();
    }

    public function upfile ($type, $filename = 'file', $is_water = false) {
        $file = request()->file($filename);
        $info = $file->move(ROOT_PATH . DS . 'uploads');
        if ($info) {
            $path = DS . 'uploads' . DS . $info->getSaveName();
            $path = str_replace("\\", "/", $path);
            return [
                'code' => 200,
                'msg' => '上传成功',
                'path' => $path,
                'savename' => $info->getSaveName(),
                'filename' => $info->getFilename(),
                'info' => $info->getInfo(),
            ];
        }
        return [
            'code' => 0,
            'msg' => $file->getError(),
        ];
    }
}
