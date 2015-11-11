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
// | Description 商家商品申请
// +----------------------------------------------------------------------

class seller_ctl_site_goods extends seller_frontpage
{
    public function __construct($app){
        $this->app = $app;
    }

    //商品页
    public function index(){
        echo '111';
    }
    //添加商品
    public function add(){
        $this->pagedata['_PAGE_'] = 'site/goods/from.html';
        $this->output();
    }

    //修改
    public function edit(){

    }

    //删除
    public function del(){

    }

    //商品库存
    public function stock(){

    }

    //仓库中的商品
    public function storage(){

    }

    //价格修改
    private function _price(){

    }
}
