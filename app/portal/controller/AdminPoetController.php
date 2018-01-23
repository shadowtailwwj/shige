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

use cmf\controller\AdminBaseController;
use app\portal\model\PortalPostModel;
use app\portal\service\PostService;
use app\portal\model\PortalCategoryModel;
use think\Db;
use app\admin\model\ThemeModel;

class AdminPoetController extends AdminBaseController
{

    public function index()
    {
        $album = Db::name('portal_poet')->where('flag',1)->select();
        $this->assign('album', $album);
        return $this->fetch();
    }


    public function add()
    {
        $themeModel        = new ThemeModel();
        $articleThemeFiles = $themeModel->getActionThemeFiles('portal/Album/index');
        $this->assign('article_theme_files', $articleThemeFiles);
        $times = Db::name('times')->select();
        $this->assign('times', $times);
        return $this->fetch();
    }


    public function addPost()
    {
        if ($this->request->isPost()) {
            $data = $this->request->param();

            $result = $this->validate($data, 'AdminPoet');

            if ($result !== true) {
                $this->error($result);
            }
            $data['create_time'] = time();
            $data['published_time'] = time();
            $data['update_time'] = time();
            $res = Db::name('portal_poet')->insert($data);;

            if ($res!=1) {
                $this->error('添加失败!');
            }

            $this->success('添加成功!', url('AdminPoet/index'));
        }

    }


    public function edit()
    {
        $id = $this->request->param('id', 0, 'intval');

        $post = Db::name('portal_poet')->where('id',$id)->find();
        $times = Db::name('times')->select();
        $this->assign('times', $times);
        $this->assign('post', $post);
        return $this->fetch();
    }


    public function editPost()
    {
        $id = $this->request->param('id', 0, 'intval');
        if ($this->request->isPost()) {
            $data = $this->request->param();

            $result = $this->validate($data, 'AdminPoet');

            if ($result !== true) {
                $this->error($result);
            }

            $data['update_time'] = time();
            $res = Db::name('portal_poet')->where('id',$id)->update($data);;

            if ($res!=1) {
                $this->error('修改失败!');
            }

            $this->success('修改成功!', url('AdminPoet/index'));
        }
    }


    public function delete()
    {
        $id = $this->request->param('id', 0, 'intval');
        $data['flag'] = 0;
        $res = Db::name('portal_poet')->where('id',$id)->update($data);

        if ($res!=1) {
            $this->error('删除失败!');
        }
        $this->success('删除成功!', url('AdminPoet/index'));
    }


    public function publish()
    {
        $param           = $this->request->param();
        $portalPostModel = new PortalPostModel();

        if (isset($param['ids']) && isset($param["yes"])) {
            $ids = $this->request->param('ids/a');

            $portalPostModel->where(['id' => ['in', $ids]])->update(['post_status' => 1, 'published_time' => time()]);

            $this->success("发布成功！", '');
        }

        if (isset($param['ids']) && isset($param["no"])) {
            $ids = $this->request->param('ids/a');

            $portalPostModel->where(['id' => ['in', $ids]])->update(['post_status' => 0]);

            $this->success("取消发布成功！", '');
        }

    }


    public function top()
    {
        $param           = $this->request->param();
        $portalPostModel = new PortalPostModel();

        if (isset($param['ids']) && isset($param["yes"])) {
            $ids = $this->request->param('ids/a');

            $portalPostModel->where(['id' => ['in', $ids]])->update(['is_top' => 1]);

            $this->success("置顶成功！", '');

        }

        if (isset($_POST['ids']) && isset($param["no"])) {
            $ids = $this->request->param('ids/a');

            $portalPostModel->where(['id' => ['in', $ids]])->update(['is_top' => 0]);

            $this->success("取消置顶成功！", '');
        }
    }


    public function recommend()
    {
        $param           = $this->request->param();
        $portalPostModel = new PortalPostModel();

        if (isset($param['ids']) && isset($param["yes"])) {
            $ids = $this->request->param('ids/a');

            $portalPostModel->where(['id' => ['in', $ids]])->update(['recommended' => 1]);

            $this->success("推荐成功！", '');

        }
        if (isset($param['ids']) && isset($param["no"])) {
            $ids = $this->request->param('ids/a');

            $portalPostModel->where(['id' => ['in', $ids]])->update(['recommended' => 0]);

            $this->success("取消推荐成功！", '');

        }
    }


    public function listOrder()
    {
        parent::listOrders(Db::name('portal_category_post'));
        $this->success("排序更新成功！", '');
    }

    public function move()
    {

    }

    public function copy()
    {

    }


}
