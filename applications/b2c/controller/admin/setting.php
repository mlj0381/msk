<?php

// +----------------------------------------------------------------------
// | VMCSHOP [V M-Commerce Shop]
// +----------------------------------------------------------------------
// | Copyright (c) vmcshop.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.vmcshop.com/licensed)
// +----------------------------------------------------------------------
// | Author: Shanghai ChenShang Software Technology Co., Ltd.
// +----------------------------------------------------------------------


class b2c_ctl_admin_setting extends desktop_controller {

    var $require_super_op = true;

    public function __construct($app) {
        parent::__construct($app);
        $this->app = $app;
        $this->mAd = $this->app->model('ad');
        $this->mSetting = $this->app->model('setting');
    }

    public function index() {
        if ($_POST) {
            $this->begin();
            foreach ($_POST as $key => $value) {
                $this->app->setConf($key, $value);
            }
            $this->end(true, '保存成功');
        }

        include($this->app->app_dir . '/setting.php');
        foreach ($setting as $key => $value) {
            if ($value['desc']) {
                $this->pagedata['setting'][$key] = $value;
                $this->pagedata['setting'][$key]['value'] = $this->app->getConf($key);
            }
        }
        $this->pagedata['setting']['receiving_time'] = $this->app->getConf('receiving_time');
        //vmc::dump($this->app->app_dir,$this->pagedata['setting']);
        $this->page('admin/setting.html');
    }

    //热门关键词
    public function hot_keywords() {
        $this->pagedata['hot'] = $this->mSetting->getlist('*', array('setting_type' => '0'));
        $this->page('admin/setting/keywords.html');
    }

    //导航管理
    public function nav_manage() {
        $this->pagedata['nav'] = $this->mSetting->getlist('*', array('setting_type' => '1'));
        $this->display('admin/setting/nav.html');
    }

    //添加热门关键词
    public function add_keywords($hot_id) {
        is_numeric($hot_id) && $this->pagedata['hot'] = $this->mSetting->getRow('*', array('id' => $hot_id));
        if($_POST) {
            $this->save_setting($_POST);
        }
        $this->display('admin/setting/add_keywords.html');
    }

    //添加导航
    public function add_nav($nav_id) {
        is_numeric($nav_id) && $this->pagedata['nav'] = $this->mSetting->getRow('*', array('id' => $nav_id));
        if($_POST) {
            $this->save_setting($_POST, 'nav');
        }
        $this->display('admin/setting/add_nav.html');
    }

    //private 保存基本设置
    private function save_setting($post, $type) {
        $action = 'hot_keywords';
        $post['setting_type'] = '0';
        if($type == 'nav'){
            $action = 'nav_manage';
            $post['setting_type'] = '1';
        }
        $post['status'] = $post['status'] == 'on' ? 'true' : 'false';
        $post['createtime'] = time();
        $this->begin("index.php?app=b2c&ctl=admin_setting&act={$action}");
        if($this->mSetting->save($post)){
            $this->end(true, '成功');
        }
        $this->end(false, '失败');
    }

    public function del_setting($id, $type){
        $action = $type == 'hot' ? 'hot_keywords' : 'nav_manage';
        $this->begin("index.php?app=b2c&ctl=admin_setting&act={$action}");
        if(is_numeric($id) && $this->mSetting->delete(array('id' => $id))){
            $this->end(true, '成功');
        }
        $this->end(false, '失败');
    }
    
    //页面管理
    public function page_manage() {
        $this->pagedata['list'] = utils::son($this->mAd->getlist('*'), 'id', 'page');
        $this->page('admin/setting/ad.html');
    }

    //广告位编辑
    public function ad_edit($ad_id) {
        $this->pagedata['ad_id'] = $ad_id;
        $this->page('admin/setting/ad_edit.html');
    }

    //广告内容编辑
    public function ad_content($ad_id) {
        if ($_POST) {
            $this->save_post($_POST);
        }
        $this->pagedata['ad_id'] = $ad_id;
        $this->pagedata['content'] = $this->mAd->getRow('*', array('id' => $ad_id));
        $this->page('admin/setting/ad_content.html');
    }

    //保存
    private function save_post($post) {
        $this->begin('index.php?app=b2c&ctl=admin_setting&act=page_manage');
        if ($this->mAd->save($post)) {
            $this->end(true, '添加成功');
        }
        $this->end(false, '添加失败');
    }

    //广告管理启用
    public function publish($type, $id) {
        $this->begin();
        $data = array('id' => $id, 'status' => $type);
        if ($this->mAd->save($data)) {
            $this->end(true, '成功');
        }
        $this->end(false, '失败');
    }
    
    //基本设置启用
    public function setting_publish($type, $id) {
        $this->begin();
        $data = array('id' => $id, 'status' => $type);
        if ($this->mSetting->save($data)) {
            $this->end(true, '成功');
        }
        $this->end(false, '失败');
    }

}
