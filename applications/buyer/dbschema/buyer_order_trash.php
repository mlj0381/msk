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

/*
 * 买手店订单回收站表
 */
$db['buyer_order_trash'] = array(
    'columns' => array(
    	'id' => array(
    		'type' => 'number',
    		'required' => true,
            'pkey' => true,
			'extra' => 'auto_increment',
    	),
    	'buyer_id' => array(
    		'type' => 'number',
    		'required' => true,
    		'comment' => '买手店ID',
    	),
    	'order_id' => array(
    		'type' => 'bigint unsigned',
    		'required' => true,
    		'comment' => '订单ID',
    	),
        'createtime' => array(
            'type' => 'time',
            'required' => true,
            'default' => 0,
            'comment' => '添加时间',
        ),
        'status' => array(
        	'type' => array(
        		0 => ('不显示'),
        		1 => ('正常'),
        	),
        	'required' => true,
        	'default' => 1,
        	'comment' => '状态',
        ),
    ),
    'index' => array(
    	'ind_buyer_id' => array(
    		'columns' => array(
    			0 => 'buyer_id',
    		),
    	),
    	'ind_order_id' => array(
    		'columns' => array(
    			0 => 'order_id',
    		),
    	),
    ),
    'comment' => '买手店订单回收站表',
);
