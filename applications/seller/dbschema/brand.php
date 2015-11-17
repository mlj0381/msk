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
// | 商家品牌申请、授权
// +----------------------------------------------------------------------
$db['brand'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            //'in_list' => true,
			'comment' => 'id',
        ),
        'brand_id' => array(
            'type' => 'number',
            'lable' => '品牌',
            'default' => 0,
            'required' => false,
            'in_list' => false,
			'comment' => '品牌ID',
        ),
		'seller_id' => array(
            'type' => 'number',
            'required' => false,
			'default' => 0,
            'label' => '商家',
			'searchtype' => 'has',
            'in_list' => true,
            'default_in_list' => true,
            'order' => '1',
			'comment' => '商家',
        ),
		'status' => array(
            'type' => array(
                0 => ('待核'),
                1 => ('正常'),
				-1 => ('未通过'),
            ),
            'default' => '0',
            'required' => false,
            'label' => '状态' ,
            'in_list' => true,
			'default_in_list' => true,
			'filtertype' => 'normal',
			'comment' => '状态',
        ),
		'create_time' => array (
            'type' => 'time',
            'label' => ('创建时间'),
            'in_list' => true,
            'default_in_list' => false,
			'filtertype' => 'time',
            'filterdefault'=>true,
        ),
        'extra' => array (
            'type' => 'serialize',
            'label' => ('品牌'),
            'in_list' => true,
            //'default_in_list' => false,
        ),
        'why' => array(
            'type' => 'text',
            'label' => ('未通过原因'),
            'comment' => ('未通过原因'),
        ),
    ),
	'index' => array(
		'ind_status' => array(
			'columns' => array(
				0 => 'status',
			),
		),
        'ind_seller_id' => array(
			'columns' => array(
				0 => 'seller_id',
			),
		),
	),
    'version' => '$Rev$',
    'comment' => '商家品牌表' ,
);
