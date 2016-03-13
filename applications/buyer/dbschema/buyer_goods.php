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

//买手店商品关系表
$db['buyer_goods'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
        	'comment' => '买手店-商品关系ID',
        ),
        'buyer_id' => array(
            'type' => 'bigint unsigned',
            'required' => true,
        	'default' => 0,
            'comment' => '买手店ID',
        ),
        'goods_id' => array(
            'type' => 'number',
            'required' => true,
            'default' => 0,
            'comment' => '商品ID',
        ),
        'count' => array(
            'type' => 'int unsigned',
            'required' => true,
            'default' => 0,
            'comment' => '商品总量',
        ),
        'count_type' => array(
            'type' => 'char(10)',
            'required' => true,
            'default' => '',
            'comment' => '数量单位类型克-千克',
        ),
//         '购买单价',
//         '卖出定价',
//         '购买时间',
//         '商家ID',
//         '未知字段'
    ),
    'index' => array(
	    'ind_buyerid_goodsid' => array(
	    	'columns' => array(
	    		0 => 'buyer_id',
	    		1 => 'goods_id',
	    	),
	    ),
        'ind_buyer_id' => array(
            'columns' => array(
                0 => 'buyer_id',
            ),
        ),
        'ind_goods_id' => array(
            'columns' => array(
                0 => 'goods_id',
            ),
        ),
    ),
    'comment' => '买手店商品关系表',
);
