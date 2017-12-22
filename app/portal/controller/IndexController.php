<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 老猫 <thinkcmf@126.com>
// +----------------------------------------------------------------------
namespace app\portal\controller;

use cmf\controller\HomeBaseController;
use think\Db;

class IndexController extends HomeBaseController
{
    public function index(){

        $poet = Db::name('portal_poet')->where('flag',1)->select();
        $album = Db::name('portal_album')->where('flag',1)->select();
        $category = Db::name('portal_category')->where('flag',1)->select();
        $this->assign('poet', $poet);
        $this->assign('album', $album);
        $this->assign('cate', $category);
        return $this->fetch(':index');
    }
}
