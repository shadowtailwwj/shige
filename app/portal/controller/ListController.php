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

class ListController extends HomeBaseController
{
    public function index()
    {
        $id                 = $this->request->param('id', 0, 'intval');
        $poetry_id          = $this->request->param('poetry_id', 0, 'intval');
        $language           = $this->request->param('language', 0, '');
        $portalCategoryModel = new PortalCategoryModel();
        $category = $portalCategoryModel->where('id', $id)->where('status', 1)->find();
        $this->assign('category', $category);
        $listTpl = empty($category['list_tpl']) ? 'list' : $category['list_tpl'];

        $mp3 = Db::name('portal_post')->where('id',$id)->find();
        $album = Db::name('portal_album')->where('id',$mp3['album_id'])->find();
        if($language!=''){
            $where['a.language'] = $language;
        }
        if($poetry_id!=''){
            $where['a.poetry_id'] = $poetry_id;
        }
        $where['a.create_time'] = ['>=', 0];
        $where['a.delete_time'] = 0;
        $postlist = Db::name('portal_post')
            ->field('a.id,post_title,num,poetry_name,album_name')
            ->alias('a')
            ->join('portal_album p','a.album_id=p.id')
            ->join('portal_poetry e','a.poetry_id=e.poetry_id')
            ->where($where)
            ->order('a.create_time desc')
            ->select();
        $this->assign('src', cmf_get_image_url($mp3['music']));
        $this->assign('title', $mp3['post_title']);
        $this->assign('cover', cmf_get_image_url($album['cover']));
        $poetry = Db::name('portal_poetry')->where('flag',1)->select();
        $this->assign('poetry', $poetry);
        $this->assign('postlist', $postlist);
        return $this->fetch('/' . $listTpl);
    }

}
