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

class seller_ctl_admin_brand extends desktop_controller {

    public function index()
    {
        $this->finder('seller_mdl_brand', array(
            'title' => ('品牌审核'),
            'use_buildin_recycle'=>true,
            'base_filter' => array('status' => array('0', '-1')),
            'actions' =>array(
                array(
                    'label' => '返回品牌列表',
                    'icon' => 'fa-plus',
                    'href' => 'index.php?app=b2c&ctl=admin_brand&act=index',
                ),
            )
        ));
    }
    public function check()
    {
        $this->begin('index.php?app=seller&ctl=admin_brand&act=index');
        if(!$_POST) $this->end(false, '非法请求');
        extract($_POST);
        $mdl_brand = $this->app->model('brand');
        $db = vmc::database();
        $db->beginTransaction();
        if($status == 1){
            $mdl_b2c_brand = app::get('b2c')->model('brand');
            if(!$brand_id = $mdl_b2c_brand->insert($brand)){
                $db->rollback();
            }
        }
        $data = compact('id', 'brand_id', 'status', 'why');
        if(!$mdl_brand->save($data)){
            $db-rollback();
            $this->end(false, '审核失败');
        }
        $db->commit();
        $this->end(true, '审核成功');
    }
}
