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

//买手店卖出商品的订单表
$db['buyer_order'] = array(
    'columns' => array(
    		'order_id' => array(
    				'type' => 'bigint unsigned',
    				'required' => true,
    				'pkey' => true,
    				'extra' => 'auto_increment',
    				'comment' => '订单ID',
    		),
    		'goods_order_id' => array(
    				'type' => 'bigint unsigned',
    				'required' => true,
    				'default' => 0,
    				'comment' => '订单系统生成的ID',
    		),
    		'buyer_id' => array(
    				'type' => 'bigint unsigned',
    				'required' => true,
    				'default' => 0,
    				'comment' => '买手店ID',
    		),
    		'manager_id' => array(
    				'type' => 'bigint unsigned',
    				'required' => true,
    				'default' => 0,
    				'comment' => '冻品管家ID',
    		),
    		'member_id' => array(
    				'type' => 'bigint unsigned',
    				'required' => true,
    				'default' => 0,
    				'comment' => '会员ID',
    		),
    		'count' => array(
    				'type' => 'int unsigned',
    				'required' => true,
    				'default' => 0,
    				'comment' => '成交量',
    		),
    		'price' => array(
    				'type' => 'money',
    				'required' => true,
    				'default' => 0,
    				'comment' => '成交价格',
    		),
    		'pay_status' => array(
		    		'type' => 'bool',
		    		'required' => true,
		    		'default' => 'false',
    				'comment' => '付款状态',
    		),
    		'send_status' => array(
		    		'type' => array(
		    				'nosend' => ('未发货') ,
		    				'send' => ('发货') ,
		    				'end' => ('签收') ,
		    		) ,
		    		'default' => 'nosend',
		    		'required' => true,
    				'comment' => '发货状态',
    		),
    		'business_status' => array(
    				'type' => array(
    						'cancel' => ('取消订单') ,
    						'go' => ('进行') ,
    						'finish' => ('完成') ,
    				) ,
    				'default' => 'go',
    				'required' => true,
    				'comment' => '交易状态',
    		),
    		'createtime' => array(
    				'type' => 'time',
		    		'required' => true,
		    		'default' => 0,
    				'comment' => '创建时间',
    		) ,
    		'updatetime' => array(
    				'type' => 'time',
		    		'required' => true,
		    		'default' => 0,
    				'comment' => '修改时间',
    		) ,
	
//     		//关系ID-PK
//     		买手ID
//     		订单ID
//     		买家ID
//     		冻品管家ID
//     		成交量
//     		成交价格
//     		付款状态
//     		发货状态
//未加索引................................
    		
	),
	'index' => array(
			'uni_goods_order_id' => array(
					'columns' => array(
							0 => 'goods_order_id',
					),
					'prefix' => 'UNIQUE',
			),
			'ind_buyer_id' => array(
					'columns' => array(
							0 => 'buyer_id',
					),
			),
			'ind_manager_id' => array(
					'columns' => array(
							0 => 'manager_id',
					),
			),
			'ind_member_id' => array(
					'columns' => array(
							0 => 'member_id',
					),
			),
	),
		
    'comment' => '买手店卖出商品订单表',
);
