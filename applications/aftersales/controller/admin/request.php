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


class aftersales_ctl_admin_request extends desktop_controller
{
    public function __construct($app)
    {
        parent::__construct($app);
    }

    public function index()
    {
        $this->finder('aftersales_mdl_request', array(
            'title' => '售后服务申请管理',
            'actions' => array(
                        ),
            'use_buildin_set_tag' => true,
            'use_buildin_recycle' => false,
            'use_buildin_filter' => true,
            ));
    }
    public function update($request_id, $status = '1')
    {
        $this->begin();
        $mdl_as_request = $this->app->model('request');
        //$request_order = $mdl_as_request->dump($request_id);
        $request_order['status'] = $status;
        $request_order['request_id'] = $request_id;
        $this->end($mdl_as_request->save($request_order));
    }
    public function save($request_id)
    {

        $this->begin();
        $data = $_POST;
        if($data['remarks']){
            $op_name = $this->user->get_name();
            if (!$op_name) {
                $op_name = $this->user->get_login_name();
            }
            $data['remarks'] = '['.date('Y-m-d H:i:s').']'.$op_name.'：'.$data['remarks'];
            $request_order = $this->app->model('request')->dump($request_id);
            if($request_order && $request_order['remarks']){
                $data['remarks'] = $request_order['remarks'].'<br>'.$data['remarks'];
            }
        }
        if($data['delivery_id']){
            $data['status'] = '3';
        }
        if($data['bill_id']){
            $data['status'] = '4';
        }
        $this->end($this->app->model('request')->save($data));
    }
}
