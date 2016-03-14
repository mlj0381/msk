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

//买手和冻品管家关系表
$db['buyer_manager'] = array(
    'columns' => array(
    		'id' => array(
    				'type' => 'bigint unsigned',
    				'required' => true,
    				'pkey' => true,
    				'extra' => 'auto_increment',
    				'comment' => '订单ID',
    		),
    		'buyer_id' => array(
    				'type' => 'bigint unsigned',
    				'required' => true,
    				'default' => 0,
    				'comment' => '买手店ID',
    		),
    		'manager_mobile' => array(
    				'type' => 'int(11)',
    				'required' => true,
    				'default' => 0,
    				'comment' => '冻品管家手机号-和买手店组合唯一',
    		),
    		'manager_status' => array(
		    		'type' => 'bool',
		    		'required' => true,
		    		'default' => 'false',
    				'comment' => '对应冻品管家是否同意请求',
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
	
//     		//邀请码怎么生成和多少位等等建议按照请求时间给4位或者别的
    		
	),
	'index' => array(
			'uni_buyer_manager' => array(
					'columns' => array(
							0 => 'buyer_id',
							1 => 'manager_mobile',
					),
					'prefix' => 'UNIQUE',
			),
	),
		
    'comment' => '买手和冻品管家关系表',
);
