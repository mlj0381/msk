<?php
/**
 * 产品盘价查询--------------- IPD141111
 */
$remote['b2c_select_price_offer'] = array(

    'url' => '/bp/bpPrice/list',

    'request' => array(
        'member_id' => array(
            'name' => '登陆的用户ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'param' => array(
            'name' => '业务参数',
            'column' => 'param',
            'type' => 'Object',
            'require' => false,
        ),
    ),

    'param' => array(
        'pricePeriod' => array(
            'name' => '价盘周期编码',
            'column' => 'pricePeriod',
            'type' => 'String',
            'require' => true,
        ),
    ),

    'response' => array(
        'productslist' => array(
            'name' => '产品列表',
            'column' => 'productslist',
            'type' => 'List',
        ),
    ),

    'productslist' => array(
        'logiAreaCode' => array(
            'name' => '物流区编码',
            'column' => 'logiAreaCode',
            'type' => 'String',
        ),
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'productCode' => array(
            'name' => '商品ID',
            'column' => 'productCode',
            'type' => 'String',
        ),
        'pricelist' => array(
            'name' => '价格列表',
            'column' => 'pricelist',
            'type' => 'List',
        ),
    ),

    'pricelist' => array(
        'orderlevelCode' => array(
            'name' => '订单等级',
            'column' => 'orderlevelCode',
            'type' => 'String',
        ),
        'priceOfKg' => array(
            'name' => 'priceOfKg',
            'column' => 'priceOfKg',
            'type' => 'float',
        ),
        'priceOfBox' => array(
        	'name' => 'priceOfBox',
        	'column' => 'priceOfBox',
        	'type' => 'float',
        ),
        'boxMin' => array(
        	'name' => 'boxMin',
        	'column' => 'boxMin',
        	'type' => 'int',
        ),
        'boxMax' => array(
        	'name' => 'boxMax',
        	'column' => 'boxMax',
       		'type' => 'int',
        ),
    ),
);