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


class aftersales_ctl_site_store extends seller_ctl_site_seller
{
    public $title = '售后服务';
    /**
     * 构造方法.
     *
     * @param object application
     */
    public function __construct(&$app)
    {
        $this->app_current = $app;
        $this->app_seller = app::get('seller');
        parent::__construct($this->app_seller);
    }
    public function index()
    {
        echo '售后服务';
    }

}
