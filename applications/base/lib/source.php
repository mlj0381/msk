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


class base_source
{
	private $url = '';
	private $module = ''; // member/seller/product/order
	private $app = ''; // 
	private $action = ''; // add/update/delete/query
	private $params = Array();
	private $token = '';

	private function __construct(){
		
	}

    protected function success($data)
    {
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode(array(
            'result' => 'success',
            'data' => $data,
        ));
        exit;
    }

    protected function failure($msg)
    {
        header('Content-Type:application/json; charset=utf-8');
        echo json_encode(array(
            'result' => 'failure',
            'data' => array(),
            'msg' => $msg,
        ));
        exit;
    }
}
