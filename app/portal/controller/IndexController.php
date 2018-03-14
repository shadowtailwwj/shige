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
use app\portal\model\PortalCategoryModel;
use think\Db;

class IndexController extends HomeBaseController
{

    public function index(){

        $poet = Db::name('portal_poet')->where('flag',1)->select();
        $poetry = Db::name('portal_poetry')->where('flag',1)->select();
        $album = Db::name('portal_album')->where('flag',1)->limit(10)->select();
        $advert = Db::name('advert')->where('flag',1)->select();
        $ramble = Db::name('portal_ramble')->where('flag',1)->select();
        $video = Db::name('video')->where('flag',1)->select();
        $albumCate = Db::name('portal_category_album')->select();
        $videoCate = Db::name('portal_category_video')->select();
        $category = Db::name('portal_category')->where('flag',1)->select();
        $portalCategoryModel = new PortalCategoryModel();
        $categoryTree        = $portalCategoryModel->getAttrs($category,0);
        $this->assign('poet', $poet);
        $this->assign('poetry', $poetry);
        $this->assign('album', $album);
        $this->assign('advert', $advert);
        $this->assign('ramble', $ramble);
        $this->assign('albumCate', $albumCate);
        $this->assign('videoCate', $videoCate);
        $this->assign('cate', $categoryTree);
        $this->assign('video', $video);
        return $this->fetch(':index');

    }
}