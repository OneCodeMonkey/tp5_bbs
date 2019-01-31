<?php
namespace app\mobile\controller;

use think\Controller;
use think\Db;

class Common extends Controller
{
    public function __construct () {
        parent::__construct();
        $tptop = Db::name('navtop')->where("tid=0")->order('sort ASC')->select();
        $this->assign("tptop", $tptop);
        $tptops = Db::name('navtop')->where("tid != 0")->order('sort ASC')->select();
        $this->assign('tptops', $tptops);
        $tptuser = Db::name('member')->where('userid', session('userid'))->find();
        $this->assign('tptuser', $tptuser);
    }
}