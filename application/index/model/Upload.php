<?php

namespace app\index\model;

use think\Model;

class Upload extends Model
{
    function initialize () {
        parent::initialize();
    }

    public function upFile($type, $filename = 'file', $is_water = false) {
        $file = request()->file($filename);
        $info = $file->validate(['size' => 50000, 'ext' => 'jpg,png,gif'])->move(ROOT_PATH . DS . 'uploads');
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
        return ['code' => 0, 'msg' => $file->getError()];
    }
}