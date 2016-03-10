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


class store_ctl_admin_store extends desktop_controller {
    function index($type) {
        $title = '店铺列表';
        $checkin = array('status' => array('1'));
        if($type == 'checkin'){
            $checkin = array('status' => array('0', '-1'));
            $title = '店铺审核';
        }
        $this->finder('store_mdl_store', array(
            'title' => $title,
            'base_filter' => $checkin,
            'actions' => array(
                array(
                    'label' => ('添加店铺') ,
                    'icon' => 'fa-plus',
                    'href' => 'index.php?app=store&ctl=admin_store&act=edit',
                ) ,
            )
        ));
    }

    public function checkin(){
        $this->begin('index.php?app=store&ctl=admin_store&act=index&p[0]=checkin');
        if(!$_POST) $this->end(false, '非法请求');
        $post = $_POST;

        if(!$this->app->model('store')->save($post['store'])){
            $this->end(false, '审核失败');
        }
        $this->end(true, '审核成功');
    }

    function save() {
        $this->begin('index.php?app=store&ctl=admin_store&act=index');
        $data = $_POST;
        $mdl_store = $this->app->model('store');

        if ($mdl_store->save($data)) {
            $this->end(true, '保存成功');
        } else {
            $this->end(false, '保存失败');
        }
    }
    function edit($store_id) {
        if($store_id){
            $mdl_store = $this->app->model('store');
            $this->pagedata['store'] = $mdl_store->dump($store_id);
        }
        $this->page('admin/edit.html');
    }

}
