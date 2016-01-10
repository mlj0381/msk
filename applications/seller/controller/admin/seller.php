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

class seller_ctl_admin_seller extends desktop_controller {
    
    public function index($type) {
        $title = '商家管理';
        $checkin = array('checkin' => array('1'));
        if($type == 'checkin'){
            $checkin = array('checkin' => array('0', '-1'));
            $title = '商家审核';
        }
        $this->finder('seller_mdl_sellers', array(
            'title' => $title ,
            'base_filter' => $checkin,
            'use_buildin_recycle'=>true,
            'actions' => array(
                array(
                    'label' => ('添加商家') ,
                    'icon' => 'fa-plus',
                    'href' => 'index.php?app=seller&ctl=admin_brand&act=create',
                ) ,
            )
        ));

    }
    public function checkin()
    {
        $this->begin('index.php?app=seller&ctl=admin_seller&act=index&p[0]=checkin');
        if(!$_POST) $this->end(false, '非法请求');
        $user_passport = vmc::singleton('seller_user_passport');
        if(!$user_passport->update_selelr($_POST['seller'])){
           $this->end(false, '审核失败');
       }
        $this->end(true, '审核成功');
    }
    public function assign_goods($store_id, $type = 'Y'){
        $goods = app::get('b2c')->model('goods')->getList('*', array('assign' => $type));
        $mdl_cat = app::get('b2c')->model('goods_cat');
        foreach ($goods as $key => $value) {
            $cat_name = $mdl_cat->getRow('cat_name', array('cat_id' => $value['cat_id']));
            $goods[$key]['cat_id'] = $cat_name['cat_name'];
        }
        $this->pagedata['store_id'] = $store_id;
        $this->pagedata['goods'] = $goods;
        $this->page('admin/seller/assign_goods.html');
    }


    public function assign_post(){
        $this->begin('index.php?app=seller&ctl=admin_seller&act=index');
        if(!$_POST) $this->end(false, '非法请求');
        $mdl_goods = app::get('b2c')->model('goods');
        $update_value = array('store_id' => $_POST['store_id'], 'assign' => $_POST['assign']);
        if(!$mdl_goods->update($update_value, array('goods_id|in' => $_POST['goods_id']))){
            $this->end(false, '分配失败');
        }else{
            $this->end(ture, '分配成功');
        }
    }
    // public function checked($id, $type)
    // {
    //     if($_POST) $this->_checked($_POST);
    //     if($type == 'store'){
    //        $model = app::get('store')->model('store');
    //     }else{
    //        $model = $this->app->model($type);
    //     }
    //     $this->pagedata['seller_info'] = $model->getRow('*', array('seller_id' => $id));
    //     $this->_editor();
    //     $this->display("admin/seller/finder/{$type}.html");
    // }
    // private function _checked($post)
    // {
    //     $this->begin('index.php?app=seller&ctl=admin_seller&act=index');
    //     if($post['seller_type'] == 'store'){
    //         $model = app::get('store')->model('store');
    //     }else{
    //         $model = $this->app->model($post['seller_type']);
    //     }
    //     $db = vmc::database();
    //     $db->beginTransaction();
    //     if(!$model->update(array('status' => $post['status']), array('seller_id' => $post['seller_id']))){
    //         $this->end(false, '审核失败');
    //     }
    //     $mdl_seller = $this->app->model('sellers');
    //     $seller_check = $mdl_seller->dump($post['seller_id'], '*', 'checkin');
    //     $suatus[] = array_shift($seller_check['company']);
    //     array_unshift($suatus, array_shift($seller_check['aptitudes']));
    //     array_unshift($suatus, array_shift($seller_check['store']));
    //     array_unshift($suatus, array_shift($seller_check['brand']));
    //     $status = ture;
    //     foreach ($suatus as $key => $value) {
    //         if($value['status'] == '-1' || $value['status'] == '0'){
    //             $status = false;
    //             break;
    //         }
    //     }
    //     if($status){
    //         if(!$mdl_seller->update(array('checkin' => '1'), array('seller_id' => $post['seller_id']))){
    //             $db->rollback();
    //         }
    //     }
    //     //写入日志
    //
    //     $db->commit();
    //     $this->end(true, '审核成功');
    // }
    private function _editor()
    {
        $this->pagedata['sections'] = array();
        $sections = array(
            'basic' => array(
                'label' => ('营业执照') ,
                'file' => 'admin/seller/finder/company/business.html',
            ) ,
            'content' => array(
                'label' => ('公司信息') ,
                'file' => 'admin/seller/finder/company/company.html',
            ) ,
            'params' => array(
                'label' => ('法人信息') ,
                'file' => 'admin/seller/finder/company/legal.html',
            ) ,
            'template' => array(
                'label' => ('组织机构') ,
                'file' => 'admin/seller/finder/company/organization.html',
            ) ,
        );
        foreach ($sections as $key => $section) {
            $this->pagedata['sections'][$key] = $section;
        }
    }

    function create() {
        $this->page('admin/seller/index.html');
    }
    function save() {
        $this->begin('index.php?app=seller&ctl=admin_seller&act=index');
        $objBrand = $this->app->model('seller');
        $brandname = $objBrand->dump(array(
            'brand_name' => $_POST['brand_name'],
            'brand_id'
        ));
        if (empty($_POST['brand_id']) && is_array($brandname)) {
            $this->end(false, ('品牌名重复'));
        }
        $_POST['ordernum'] = intval($_POST['ordernum']);
        $data = $this->_preparegtype($_POST);
        #↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓记录管理员操作日志@lujy↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
        if ($obj_operatorlogs = vmc::service('operatorlog.goods')) {
            $olddata = app::get('seller')->model('brand')->dump($_POST['brand_id']);
        }
        #↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑记录管理员操作日志@lujy↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
        if ($objBrand->save($data)) {
            #↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓记录管理员操作日志@lujy↓↓↓↓↓↓↓↓↓↓↓↓↓↓↓
            if ($obj_operatorlogs = vmc::service('operatorlog.goods')) {
                if (method_exists($obj_operatorlogs, 'brand_log')) {
                    $obj_operatorlogs->brand_log($_POST, $olddata);
                }
            }
            #↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑记录管理员操作日志@lujy↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
            $this->end(true, ('品牌保存成功'));
        } else {
            $this->end(false, ('品牌保存失败'));
        }
    }
    function edit($brand_id) {
        $this->path[] = array(
            'text' => ('商品品牌编辑')
        );
        $objBrand = $this->app->model('brand');
        $this->pagedata['brandInfo'] = $objBrand->dump($brand_id);
        $this->page('admin/goods/brand/detail.html');
    }
    function _preparegtype($data) {
        $data['seo_info']['seo_title'] = $data['seo_title'];
        $data['seo_info']['seo_keywords'] = $data['seo_keywords'];
        $data['seo_info']['seo_description'] = $data['seo_description'];
        $data['seo_info'] = serialize($data['seo_info']);
        unset($data['seo_title']);
        unset($data['seo_keywords']);
        unset($data['seo_description']);
        return $data;
    }

}
