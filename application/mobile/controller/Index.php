<?php

namespace app\mobile\controller;

use think\Controller;
use think\Db;

class Index extends Common
{
    public function _initialize () {
        $show['show'] = 1;
        $open['open'] = 1;
        $choice['choice'] = 1;
        $tptm = Db::name('member')->order('userid desc')->limit(12)->select();
        $this->assign('tptm',$tptm);
        $tptl =Db::name('links')->where($show)->order('id desc')->select();
        $this->assign('tptl', $tptl);
        $tpte = Db::name('forum')->where($open)->where($choice)->order('id desc')->limit(9)->select();
        $this->assign('tpte', $tpte);
        $tptf = Db::name('forum')->where($open)->order('view desc')->limit(9)->select();
        $this->assign('tptf', $tptf);
        $tpto = Db::name('category')->where($show)->order('sort desc')->limit(12)->select();
        $this->assign('tpto', $tpto);
    }

    public function index () {
        $forum = Db::name('forum');
        $open['open'] = 1;
        $settop['settop'] = 1;
        $tptc = $forum->alias('f')->join('category c', 'c.id=f.tid')->join('member m', 'm.userid=f.uid')->field('f.*,c.id as cid,m.userid,m.userhead,m.username,c.name')->where($open)->where($settop)->order('f.id desc')->limit(5)->select();
        $this->assign('tptc', $tptc);
        $tptcs = $forum->alias('f')->join('category c', 'c.id=f.tid')->join('member m', 'm.userid=f.uid')->field('f.*,c.id as cid,m.userid,m.userhead,m.username,c.name')->where($open)->order('f.id desc')->paginate(15);
        $this->assign('tptcs', $tptcs);
        return view();
    }

    public function search () {
        $ks = input('ks');
        if (empty($ks)) {
            return $this->error("您好，您迷路了");
        }
        $forum = Db::name('forum');
        $open['open'] = 1;
        $tptc = $forum->alias('f')->join('category c', 'c.id=f.tid')->join('member m', 'm.userid=f.uid')->field('f.*,c.id as cid,m.userid,m.userhead,m.username,c.name')->order('f.id desc')->where($open)->where('title', 'like', '%' . $ks . '%')->paginate(15, false, $config = [
            'query' =>  ['ks' => $ks],
        ]);
        $this->assign('tptc', $tptc);
        return view();
    }

    public function view () {
        $id = input('id');
        if (empty($id)) {
            return $this->error("您好，您迷路了");
        }
        $category = Db::name('category');
        $c = $category->where("id={$id}")->find();
        if ($c) {
            $forum = Db::name('forum');
            $open['open'] = 1;
            $tptc = $forum->alias('f')->join('category c', 'c.id=f.tid')->join('member m', 'm.userid=f.uid')->field('f.*,c.id as cid,m.userid,m.userhead,m.username,c.name')->where("f.tid={$id}")->where($open)->order('f.id desc')->paginate(15);
            $this->assign('tptc', $tptc);
            $tpti = Db::name('category')->where("id={$id}")->find();
            $this->assign('tpti', $tpti);
            return view();
        }
        $this->error('您好，您迷路了');
    }

    public function choice () {
        $forum = Db::name('forum');
        $open['open'] = 1;
        $choice['choice'] = 1;
        $tptc = $forum->alias('f')->join('category c', 'c.id=f.tid')->join('member m', 'm.userid=f.uid')->field('f.*,c.id as cid,m.userid,m.userhead,m.username,c.name')->where($open)->where($choice)->order('f,id desc')->paginate(15);
        $this->assign('tptc', $tptc);
        return view();
    }

    public function thread () {
        $id = input('id');
        if (empty($id)) {
            return $this->error('您好，您迷路了');
        }
        $forum = Db::name('forum');
        $a = $forum->where("id={$id}")->find();
        if ($a) {
            $forum->where("id={$id}")->setInc('view', 1);
            $t = $forum->alias('f')->join('category c', 'c.id=f.tid')->join('member m', 'm.userid=f.uid')->field('f.*,c.id as cid,c.name,m.userid,m.grades,m.point,m.userhead,m.username')->find($id);
            $this->assign('t', $t);
            $tptc = Db::name('comment')->alias('c')->join('member m', 'm.userid=c.uid')->where("fid={$id}")->order('c.id asc')->paginate(15);
            $this->assign('tptc', $tptc);
            return view();
        }
        return $this->error('您好，您迷路了');
    }
}
