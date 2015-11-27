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


class seller_ctl_site_aftersales extends seller_frontpage
{
    public function __construct(&$app){
        parent::__construct($app);
        $this->app = $app;
    }

    public function order(){
        $this->output();
    }
}
