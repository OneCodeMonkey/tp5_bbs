<?php

namespace app\admin\model;

use think\Model;

class Category extends Model
{
    function add ($data) {
        $result = $this->isUpdate(false)->allowField(true)->save($data);
        if ($data) {
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

    public function cate_tree () {
        $tptc = $this->order('id ASC')->select();
        return $this->sort($tptc);
    }

    public function sort ($data, $tid = 0, $level = 0) {
        static $arr = [];
        foreach ($data as $k => $v) {
            if ($v['tid'] == $tid) {
                $v['level'] = $level;
                $arr[] = $v;
                $this->sort($data, $v['id'], $level + 1);
            }
        }
        return $arr;
    }

    public function get_children_id ($cate_id) {
        $cates = $this->select();
        return $this->_get_children_id($cates, $cate_id);
    }

    public function _get_children_id ($cates, $cate_id) {
        static $arr = [];
        foreach ($cates as $k => $v) {
            if ($v['tid'] == $cate_id) {
                $arr[] = $v['id'];
                $this->_get_children_id($cates, $v['id']);
            }
        }
        return $arr;
    }
}