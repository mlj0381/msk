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


$db['products_price'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
        ) ,
    	'price_period' => array(
    		'type' => 'number',
    		'default' => 0,
    		'required' => true,
    		'comment'	=> '价盘周期',
    	) ,
        'logi_area_code' => array(
            'type' => 'number',
            'default' => 0,
            'required' => true,
        	'comment'	=> '物流区code',
        ) ,
        'seller_code' => array(
            'type' => 'char(10)',
            'default' => 0,
            'required' => true,
        	'comment'	=> '卖家code',
        ) ,
        'product_code' => array(
        	'type' => 'char(10)',
            'default' => 0,
            'required' => true,
        	'comment'	=> '货品code',
        ) ,
        'level_code' => array(
        	'type' => 'number',
        	'default' => 0,
        	'required' => true,
        	'comment'	=> '货品等级code',
        ) ,
        'orderlevelCode' => array(
        	'type' => 'number',
        	'default' => 0,
        	'required' => true,
        	'comment'	=> '对应价盘code',
        ) ,
        'priceOfKg' => array(
        	'type' => 'decimal(20,2)',
        	'default' => '0.00',
        	'required' => true,
        	'comment'	=> 'kg/price',
        ) ,
        'priceOfBox' => array(
        	'type' => 'decimal(20,2)',
        	'default' => '0.00',
        	'required' => true,
        	'comment'	=> 'box/price',
        ) ,
        'boxMin' => array(
        	'type' => 'number',
        	'default' => 0,
        	'required' => true,
        	'comment'	=> 'boxMin',
        ) ,
        'boxMax' => array(
        	'type' => 'number',
        	'default' => 0,
        	'required' => true,
        	'comment'	=> 'boxMax',
        ) ,
    ) ,
    'index' => array(
        'ind_product_level_code' => array(
            'columns' => array(
                0 => 'product_code',
                1 => 'level_code',
            ) ,
        ) ,
        'ind_logi_area_code' => array(
            'columns' => array(
                0 => 'logi_area_code',
            ) ,
        ) ,
        'ind_seller_code' => array(
            'columns' => array(
                0 => 'seller_code',
            ) ,
        ) ,
    ) ,
    'comment' => ('商品价盘表') ,
);
