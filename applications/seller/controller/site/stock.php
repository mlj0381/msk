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
// | Description 库存管理
// +----------------------------------------------------------------------

class seller_ctl_site_stock extends seller_frontpage
{
    public function __construct(&$app){
        parent::__construct($app);
        $this->verify();
    }

    public function index(){

    }

    //库存增加/减少
    public function edit(){

    }

    //库存冻结
    public function freez(){

    }
}
