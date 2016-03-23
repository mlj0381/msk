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
// | Description: msk remote 
// +----------------------------------------------------------------------

$setting = array(
	'remote' => array(
		'default' => array(			
			'scheme' => 'http',
			'host' => '121.40.103.229',
			'port' => '8080',
			'root' => '/msk-web/api',
			'version'	=> 'v1',
			'headers' => array(
				'Content-Type:application/json'
			),			
			'param' => array(
				'siteCode' => '102',
				'auth' => 'msk'
			)
		),
	),

	'result' => array(
		'status' => true, // true|false 处理成功|处理失败
		'returnCode' => '000001',
		'message' => 'Fail Request',
		'result' => array(
		)
	)
);
