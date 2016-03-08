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
// | 商家品牌申请、授权
//

class seller_ctl_site_brand extends seller_frontpage {

    public function __construct(&$app) {
        parent::__construct($app);
        $this->app = $app;
        $this->verify();
        $this->mBrand = $this->app->model('brand');
    }

    public function index() {
        $this->title = '商品品牌';
        //查询详细信息
        $this->pagedata['brands'] = app::get('b2c')->model('brand')->getList('*', array('seller_id' => $this->seller['seller_id']));
        $this->output();
    }

    //添加品牌
    public function add($brand_id) {
        if ($_POST) {
            $this->_post($_POST);
        }
        if (is_numeric($brand_id)) {
            $this->pagedata['brand'] = app::get('b2c')->model('brand')->getRow('*', array('brand_id' => $brand_id, 'seller_id' => $this->seller['seller_id']));
        }
        $this->output();
    }

    private function _post($post) {
        extract($post);
        $db = vmc::database();
        $db->beginTransaction();
        $redirect = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_brand', 'act' => 'index'));
        $brand['seller_id'] = $this->seller['seller_id'];
        $mdl_b2c_brand = app::get('b2c')->model('brand');
        if ($brand['brand_id']) {
            $brand_name = $this->mBrand->getRow('brand_name', array('brand_id' => $brand['brand_id'], 'seller_id' => $this->seller['seller_id']));
            $b2c_fun_name = 'save';
            $seller_fun_name = 'update';
            $brand['brand_name'] = $brand_name['brand_name'];
        } else {
            $brand['create_time'] = time();
            $b2c_fun_name = 'insert';
            $seller_fun_name = 'save';
        }

        if (!$brand_id = $mdl_b2c_brand->$b2c_fun_name($brand)) {
            $db->rollback();
            $this->splash('error', $redirect, '添加失败');
        }
        $brand['brand_id'] = $brand['brand_id'] ? $brand['brand_id'] : $brand_id;
        $filter = array('seller_id' => $this->seller['seller_id'], 'brand_id' => $brand['brand_id']);
        if (!$this->mBrand->$seller_fun_name($brand, $filter)) {
            $db->rollback();
            $this->splash('error', $redirect, '添加失败');
        }
        $db->commit();
        $this->splash('success', $redirect, '添加成功');
    }

    //修改品牌
    public function edit() {
        
    }

    //删除
    public function remove($brand_id) {
        $redirect = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_brand', 'act' => 'index'));
        $filter = app::get('store')->model('store')->getList('store_id', array('seller_id' => $this->seller['seller_id']));
        $mdl_b2c_goods = app::get('b2c')->model('goods');
        foreach ($filter as $value) {
            $value['brand_id'] = $brand_id;
            if ($mdl_b2c_goods->count($value)) {
                $this->splash('error', $redirect, '该品牌下还有商品，不允许删除');
            }
        }
        $db = vmc::database();
        $db->beginTransaction();
        $result = $this->mBrand->delete(array('brand_id' => $brand_id, 'seller_id' => $this->seller['seller_id']));
        if (!$result) {
            $db->rollback();
            $this->splash('error', $redirect, '删除失败');
        }
        $result = app::get('b2c')->model('brand')->delete(array('brand_id' => $brand_id, 'seller_id' => $this->seller['seller_id']));
        if (!$result) {
            $db->rollback();
            $this->splash('error', $redirect, '删除失败');
        }
        $db->commit();
        $this->splash('success', $redirect, '删除成功');
    }

    //判断品牌重名
    public function check_brand_name() {
        $mdl_brand = app::get('b2c')->model('brand');
        $post = $_POST;
        if ($mdl_brand->getRow('brand_name', array('brand_name' => $post['brand_name']))) {
            $this->splash('error', '', '重名');
        }
        $this->splash('success', '', '可用');
    }

    //取得品牌首字母拼音
    public function brand_initial() {
        $initials = new base_py('utf-8');
        $py = $initials->getInitials($_POST['brand_name']);
        preg_match('/^[A-Za-z]/', $py, $result);
        $inital = current($result);
        if ($inital) {
            $this->splash('success', '', $inital);
        }
        $this->splash('error', '', '~');
    }

}
