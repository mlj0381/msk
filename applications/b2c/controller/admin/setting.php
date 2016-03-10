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
        //$this->mAd = $this->app->model('ad');
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
        if(is_numeric($hot_id)){
            $this->pagedata['hot'] = $this->mSetting->getRow('*', array('id' => $hot_id));
        }
        if ($_POST) {
            $this->save_setting($_POST);
        }
        $this->display('admin/setting/add_keywords.html');
    }

    //添加导航
    public function add_nav($nav_id) {
        if(is_numeric($nav_id)){
            $this->pagedata['nav'] = $this->mSetting->getRow('*', array('id' => $nav_id));
        }

        if ($_POST) {
            $this->save_setting($_POST, 'nav');
        }
        $this->display('admin/setting/add_nav.html');
    }

    //private 保存基本设置
    private function save_setting($post, $type) {
        $action = 'hot_keywords';
        $post['setting_type'] = '0';
        if ($type == 'nav') {
            $action = 'nav_manage';
            $post['setting_type'] = '1';
        }
        $post['status'] = $post['status'] == 'on' ? 'true' : 'false';
        $post['createtime'] = time();
        $this->begin("index.php?app=b2c&ctl=admin_setting&act={$action}");
        if ($this->mSetting->save($post)) {
            $this->end(true, '成功');
        }
        $this->end(false, '失败');
    }

    public function del_setting($id, $type) {
        $action = $type == 'hot' ? 'hot_keywords' : 'nav_manage';
        $this->begin("index.php?app=b2c&ctl=admin_setting&act={$action}");
        if (is_numeric($id) && $this->mSetting->delete(array('id' => $id))) {
            $this->end(true, '成功');
        }
        $this->end(false, '失败');
    }

    //页面列表页
    public function page_list(){
        $this->pagedata['page_list'] = $this->mAd->getList('id, ad_name, status', array('page_id' => '0'));
        $this->page('admin/setting/page.html');
    }
    
    public function add_page($page_id){
        
        if($_POST){
            $this->save_page($_POST);
        }
        $this->pagedata['page_list'] = $this->mAd->getRow('id, ad_name, status', array('id' => $page_id));
        $this->page('admin/setting/add_page.html');
    }
    
    //模块列表
    public function modules($page_id){
        $this->pagedata['pgae_list'] = $this->mAd->getList('id, ad_name', array('page_id' => '0'));
        $this->pagedata['parent'] = $this->mAd->getRow('id, ad_name', array('id' => $page_id));
        $list = $this->mAd->getlist('*', array('page_id' => $page_id, 'ad_type|notin' => array('0')));
        $this->pgaedata['type'] = $this->page_setting($list);
        $this->pagedata['list'] = $list;
        $this->page('admin/setting/modules.html');
    }
    
        
    //添加模块
    public function add_module($page_id){
        $this->pagedata['page_id'] = $page_id;
        $this->pagedata['parent'] = $this->mAd->getList('id, ad_name', array('page_id' => '0'));
        $this->pagedata['page'] = $this->page_setting();
        $this->page('admin/setting/add_module.html');
    }
//    
    private function save_page($post){
        $redirct = 'index.php?app=b2c&ctl=admin_setting&act=page_list';
        if($post['type'] == '1'){
            $redirct = 'index.php?app=b2c&ctl=admin_setting&act=modules&p[0]='.$post['id'];
        }
        $this->begin();
        if($this->mAd->save($post)){
            $this->end(true, '操作成功');
        }
        $this->end(false, '操作失败');
    }
//
//
//    //页面管理
//    public function page_manage() {
//        
//    }
//


    
    //模块广告列表 
    public function module_ad($ad_id, $page_id){
        
        if($_POST){
            $this->add_module_ad($_POST);
        }
        $this->pagedata['pgae_list'] = $this->mAd->getList('id, ad_name', array('page_id' => '0'));
        $this->pagedata['parent'] = $this->mAd->getRow('id, ad_name', array('id' => $page_id));
        $this->pagedata['ad'] = $this->mAd->getRow('id, ad_name', array('id' => $ad_id));
        $this->pagedata['ad_list'] = $this->mAd->getList('*', array('page_id' => $ad_id));
        
        $this->page('admin/setting/module_ad.html');
    }
    
    //模块广告保存
    public function add_ad($ad_id){
        $this->pagedata['ad_id'] = $ad_id;
        $this->pagedata['content'] = $this->mAd->getRow('*', array('id' => $ad_id));
        $this->page('admin/setting/module_content.html');
    }

//
//    public function module_content($mid){
//        $this->pagedata['content'] = $this->mAd->getRow('*', array('id' => $mid));
//        $this->pagedata['page'] = $this->page_setting();
//        $this->page('admin/setting/module_content.html');
//    }
//    
//    //添加编辑页面模块
//    public function add_ad($ad_id) {
//        if ($_POST) {
//            $this->save_post($_POST);
//        }
//        $floor = $this->mAd->getList('id, ad_setting', array('ad_type' => '3'));
//        $floor_ad = array();
//        foreach ($floor as $value) {
//            $floor_ad[] = array('id' => $value['id'], 'floor_name' => $value['ad_setting']['floor_name']);
//        }
//        $this->pagedata['floor_ad'] = $floor_ad;
//        $this->pagedata['page'] = $this->page_setting();
//        $this->pagedata['content'] = $this->mAd->getRow('*', array('id' => $ad_id));
//        $this->page('admin/setting/add_ad.html');
//    }
//
//    //广告内容编辑
//    public function ad_content($ad_id) {
//        if ($_POST) {
//            $this->save_post($_POST);
//        }
//        $this->pagedata['ad_id'] = $ad_id;
//        $this->pagedata['content'] = $this->mAd->getRow('*', array('id' => $ad_id));
//        $this->page('admin/setting/ad_content.html');
//    }
//
//    public function add_floor_ad() {
//        $this->begin('index.php?app=b2c&ctl=admin_setting&act=page_manage');
//        $db = vmc::database();
//        $db->beginTransaction();
//        $post = $_POST;
//        $floor_id = $post['ad_setting']['floor'];
//        $post['createtime'] = time();
//        if (empty($post['id']) && !$ad_id = $this->mAd->insert($post)) {
//            $db->rollback(); 
//            $this->end(false, '添加失败');
//        } else if(!$this->mAd->save($post)) {
//            $db->rollback();
//            $this->end(false, '添加失败');
//        }
//        $ad_id = empty($post['id']) ? $ad_id : $post['id'];
//        $floor = $this->mAd->getRow('id, ad_setting', array('id' => $floor_id));
//        $setting_type = $post['ad_type'] == '5' ? 'floor_window' : 'floor_ad';
//        $floor['ad_setting'][$setting_type] = $floor['ad_setting'][$setting_type] ? $floor['ad_setting'][$setting_type] : array();
//        $floor['ad_setting'][$setting_type][$ad_id]  = $ad_id;
//        if(!$this->mAd->save($floor)){
//            $db->rollback(); 
//            $this->end(false, '添加失败');
//        }
//        $db->commit(); 
//        $this->end(true, '添加成功');
//    }
//
//    public function del_page($ad_id){
//        if(is_numeric($ad_id)){
//            
//        }
//    }
//    
//    //保存
//    private function save_post($post) {
//        $this->begin('index.php?app=b2c&ctl=admin_setting&act=page_manage');
//        $post['createtime'] = time();
//        if ($this->mAd->save($post)) {
//            $this->end(true, '添加成功');
//        }
//        $this->end(false, '添加失败');
//    }
//
//    //广告管理启用
//    public function publish($type, $id) {
//        $this->begin();
//        $data = array('id' => $id, 'status' => $type);
//        if ($this->mAd->save($data)) {
//            $this->end(true, '成功');
//        }
//        $this->end(false, '失败');
//    }
//
//    //更新排序
//    public function update() {
//        extract($_POST);
//        $this->begin('index.php?app=b2c&ctl=admin_setting&act=page_manage');
//        foreach ($order as $key => $value) {
//            $filter = array(
//                'id' => $key,
//                'ordernum' => $value,
//            );
//            if (!$this->mAd->save($filter)) {
//                $this->end(false, '失败');
//            }
//        }
//        $this->end(true, '成功');
//    }
//
   //基本设置启用
   public function setting_publish($type, $id) {
       $this->begin();
       $data = array('id' => $id, 'status' => $type);
       if ($this->mSetting->save($data)) {
           $this->end(true, '成功');
       }
       $this->end(false, '失败');
   }

    private function page_setting(&$items) {
        $page_setting = array(
            'type' => array(
                1 => array(
                    'id' => 1,
                    'title' => '幻灯'
                ),
                array(
                    'id' => 2,
                    'title' => '图片'
                ),
                array(
                    'id' => 3,
                    'title' => '商品'
                ),
            ),
        );
        if (empty($items)) {
            return $page_setting;
        }
        foreach ($items as $k => $item) {
            $items[$k]['page_name'] = $page_setting['page'][$item['page_id']]['title'];
            $items[$k]['position_name'] = $page_setting['position'][$item['position_id']]['title'];
            $items[$k]['type_name'] = $page_setting['type'][$item['ad_type']]['title'];
        }
    }

}
