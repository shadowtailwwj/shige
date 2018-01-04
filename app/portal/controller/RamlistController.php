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
use app\portal\service\PostService;
use app\portal\model\PortalPostModel;
use think\Db;

class RamlistController extends HomeBaseController
{
    public function index()
    {
        $ramble = Db::name('portal_ramble')
            ->alias('a')
            ->join('portal_category_ramble p','a.cate=p.cate_id')
            ->where('flag',1)
            ->select();
        $cate = Db::name('portal_category_ramble')->select();
        $this->assign('ramble', $ramble);
        $this->assign('cate', $cate);
        return $this->fetch();
    }

}

