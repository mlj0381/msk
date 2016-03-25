<?php
/**
 * 创建购买需求订单---------------ISO151401
 */
$remote['b2c_order_create'] = array(
    'url' => '/so/pro/new',
    'request' => array(
        'member_id' => array(
            'name' => '登陆的用户ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'param' => array(
            'name' => '参数',
            'column' => 'param',
            'type' => 'object',
        ),
    ),

    'param' => array(
        'districtCode' => array(
            'name' => '区域',
            'column' => 'districtCode',
            'type' => 'String',
            'require' => true,
        ),
        'buyersId' => array(
            'name' => '买家ID',
            'column' => 'buyersId',
            'type' => 'String',
            'require' => true,
        ),
        'buyersCode' => array(
            'name' => '买家编码',
            'column' => 'buyersCode',
            'type' => 'String',
            'require' => true,
        ),
        'buyersType' => array(
            'name' => '买家类别',
            'column' => 'buyersType',
            'type' => 'String',
            'require' => true,
        ),
        'buyersName' => array(
            'name' => '买家名称',
            'column' => 'buyersName',
            'type' => 'String',
            'require' => true,
        ),
        'sellerCode' => array(
            'name' => '卖家编码',
            'column' => 'sellerCode',
            'type' => 'String',
            'require' => true,
        ),
        'sellerName' => array(
            'name' => '卖家名称',
            'column' => 'sellerName',
            'type' => 'String',
            'require' => true,
        ),
        'products' => array(
            'name' => '产品列表,包含至少一件产品',
            'column' => 'products',
            'type' => 'List',
            'require' => false,
        ),
    ),
    'products' => array(
        'pdCode' => array(
            'name' => '产品编码',
            'column' => 'pdCode',
            'type' => 'String',
            'require' => true,
        ),
        'pdName' => array(
            'name' => '产品名称',
            'column' => 'pdName',
            'type' => 'String',
            'require' => true,
        ),
        'orderPrice' => array(
            'name' => '订单价格',
            'column' => 'orderPrice',
            'type' => 'String',
            'require' => false,
        ),
        'priceCycle' => array(
            'name' => '价盘周期',
            'column' => 'priceCycle',
            'type' => 'String',
            'require' => false,
        ),
        'orderQty' => array(
            'name' => '订单数量',
            'column' => 'orderQty',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'response' => array(
        'proCode' => array(
            'name' => '购物需求订单编码',
            'column' => 'proCode',
            'type' => 'String',
        ),
    ),
);