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
class seller_finder_sellers{

    public $column_seller_account = '登录帐号';
    public $column_basic = '详细信息';
    //public $detail_basic = '编辑';
    public function __construct($app){
        $this->app = $app;
    }
    public function column_seller_account($seller)
    {
        $login_account = app::get('pam')->model('sellers')->getRow('login_account', array('seller_id' => $seller['seller_id']));
        return $login_account['login_account'];
    }

    public function column_basic($seller){
        return '<a href="index.php?app=seller&ctl=admin_seller&act=detail&p[0]='.$seller['seller_id'].'"> 查看详情</a>';

    }
}
