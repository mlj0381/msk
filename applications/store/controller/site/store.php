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

class store_ctl_site_store extends site_controller
{
    public function __construct(&$app){
        parent::__construct($app);
        $this->app = $app;
        $this->set_tmpl('store');
    }
    public function index($store_id){
        $this->page('site/index.html');
    }
}
