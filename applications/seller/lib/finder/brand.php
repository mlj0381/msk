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

class seller_finder_brand{
    public function __construct($app){
        $this->app = $app;
    }
    var $column_edit = '编辑';
    var $detail_basic = '查看';
    function column_edit($row){
        return '<a class="btn btn-default btn-xs" href="index.php?app=b2c&ctl=admin_brand&act=edit&p[0]='.$row['brand_id'].'" ><i class="fa fa-edit"></i> '.('编辑').'</a>';
    }

    public function detail_basic($id){
        $render = $this->app->render();
        $render->pagedata['brand'] = $this->app->model('brand')->getRow('*', array('id' => $id));
        return $render->fetch('admin/brand/finder/brand.html');
    }
}
