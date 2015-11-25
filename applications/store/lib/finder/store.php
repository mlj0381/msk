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



class store_finder_store{

    var $column_edit = '编辑';
    var $detail_basic = '基本信息';
    public function __construct($app){
        $this->app = $app;
    }
    function column_edit($row){
        return '<a class="btn btn-default btn-xs" href="index.php?app=store&ctl=admin_store&act=edit&p[0]='.$row['store_id'].'" ><i class="fa fa-edit"></i> '.('编辑').'</a>';
    }

    public function detail_basic($store_id){
        $render = $this->app->render();
        $render->pagedata['store_info'] = $this->app->model('store')->getRow('*', array('soter_id' => $store_id));
        return $render->fetch('site/finder/store_basic.html');
    }
}
