<?php

namespace app\index\model;

use think\Model;

class Member extends Model
{
    function add ($data) {
        $result = $this->isUpdate(false)->allowField(true)->save($data);
        if ($result) {
            return true;
        }
        return false;
    }

    function edit ($data) {
        $result = $this->isUpdate(true)->allowField(true)->save($data);
        if ($result) {
            return true;
        }
        return false;
    }
}