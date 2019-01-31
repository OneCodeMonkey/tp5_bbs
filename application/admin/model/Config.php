<?php

namespace app\admin\model;

use think\Model;

class Config extends Model
{
    function index ($data) {
        $result = $this->isUpdate(true)->allowField(true)->save($data);
        if ($result) {
            return true;
        }
        return false;
    }
}
