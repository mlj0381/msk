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
// | Description 商家店铺
// +----------------------------------------------------------------------

class seller_ctl_site_store extends seller_frontpage
{
    public function __construct(&$app){
        parent::__construct($app);
    }

    public function index(){

    }

    //店铺设置
    public function setting(){
		die('Store');
    }
    //修改基本信息
    public function edit(){

    }

}
