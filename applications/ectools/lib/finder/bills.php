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


class ectools_finder_bills
{
    public $detail_products = '单据操作';
    public function detail_bill($bill_id)
    {
        $mdl_bills = app::get('ectools')->model('bills');
        $bill = $mdl_bills->dump($bill_id);
        $render = app::get('ectools')->render();
        $render->pagedata['bill'] = $bill;
        return $render->fetch('bills/detail.html');
    }
}
