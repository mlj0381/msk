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
        $this->app = $app;
    }

    public function index(){
        $this->output();
    }

    //举报管理
    public function complaints(){
        $this->output();
    }
    //店铺设置
    public function setting(){
		$this->output();
    }
    //修改基本信息
    public function edit(){

    }
    //评价
    public function appraisal(){
        $this->output();
    }

    public function clerk_setting(){
        $this->output();
    }

}
