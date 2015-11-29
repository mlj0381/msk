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

class seller_ctl_site_brand extends seller_frontpage
{
    public function __construct(&$app){
        parent::__construct($app);
        $this->app = $app;
        $this->verify();
        $this->mBrand = $this->app->model('brand');
    }

    public function index(){
        $this->pagedata['brands'] = $this->mBrand->getList('*', array('seller_id' => $this->seller['seller_id']));
        $this->output();
    }

    //添加品牌
    public function add($brand_id){
        if($_POST) $this->_post($_POST);
        if(is_numeric($brand_id)){
            $this->pagedata['brand'] = $this->mBrand->getRow('*', array('id' => $brand_id));
        }
        $this->output();
    }

    private function _post($post){
        extract($post);
        $redirect = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_brand', 'act' => 'index'));
        if($brand['brand_id']){
            $mdl_b2c_brand = app::get('b2c')->model('brand');
            if(!$mdl_b2c_brand->save($brand)){
                $this->splash('error', $redirect, '添加失败');
            }
        }else{
            $brand['create_time'] = time();
            $brand['seller_id'] = $this->seller['seller_id'];
            if(!$this->mBrand->save($brand)){
                $this->splash('error', $redirect, '添加失败');
            }
        }
        $this->splash('success', $redirect, '添加成功');
    }
    //修改品牌
    public function edit(){

    }

    //删除
    public function remove($brand_id){
        if(!$this->mBrand->delete(array('id' => $brand_id))){
            $this->splash('error', $redirect, '删除失败');
        }
        $this->splash('success', $redirect, '删除成功');
    }

    //判断品牌重名
    public function check_brand_name(){
        $mdl_brand = app::get('b2c')->model('brand');
        $post = $_POST;
        if($mdl_brand->getRow('brand_name', array('brand_name' => $post['brand_name']))){
            $this->splash('error', '', '重名');
        }
        $this->splash('success', '', '可用');
    }

    //取得品牌首字母拼音
    public function brand_initial(){
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
