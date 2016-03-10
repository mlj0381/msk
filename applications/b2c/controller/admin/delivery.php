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

class b2c_ctl_admin_delivery extends desktop_controller
{
    public function index()
    {
        $this->finder('b2c_mdl_delivery', array(
            'title' => ('发货单'),
            'use_buildin_recycle' => false,
            'use_buildin_filter' => true,
            'base_filter' => array('delivery_type' => 'send'),
        ));
    }
    public function update($delivery_id)
    {
        $this->begin();
        $mdl_delivery = $this->app->model('delivery');
        $delivery = $mdl_delivery->dump($delivery_id);
        $data = $_POST;
        $op_name = $this->user->get_name();
        if (!$op_name) {
            $op_name = $this->user->get_login_name();
        }
        $data['memo'] = '['.date('Y-m-d H:i:s').']'.$op_name.'：'.$data['memo'];
        if($delivery['memo']){
            $delivery['memo'] = $delivery['memo'].'<br>'.$data['memo'];
        }else{
            $delivery['memo'] = $data['memo'];
        }
        $delivery['status'] = $data['status'];
        $flag = vmc::singleton('b2c_order_delivery')->update($delivery, $msg);
        $this->end($flag, $msg);
    }
    public function addnew()
    {
        echo __FILE__.':'.__LINE__;
    }
}
