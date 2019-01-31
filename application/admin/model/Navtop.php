<?php

namespace app\admin\model;

use think\Model;

class Navtop extends Model
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

    public function cate_tree () {
        $tptc = $this->order('sort ASC')->select();
        return $this->sort($tptc);
    }

    public function sort($data, $tid = 0, $level = 0) {
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

    public function get_children_id ($navid) {
        $navs = $this->select();
        return $this->_get_children_id($navs, $navid);
    }

    public function _get_children_id ($navs, $navid) {
        static $arr = [];
        foreach ($navs as $k => $v) {
            if ($v['tid'] == $navid) {
                $arr[] = $v['id'];
                $this->_get_children_id($navs, $v['id']);
            }
        }
        return $arr;
    }
}