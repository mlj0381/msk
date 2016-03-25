<?php
/**
 * 查询产品分类---------------IPD141111
 */
$remote['b2c_select_product_price'] = array(
    'url' => '/pd/pd_pricecycle',

    'request' => array(
        'param' => array(
            'name' => '参数',
            'column' => 'param',
            'type' => 'object',
            'default' => Array(),
        ),
    ),

    'param' => array(
        'classesCode' => array(
            'name' => '产品类别编码',
            'column' => 'classesCode',
            'type' => '文本',
            'require' => true,
        ),
        'breedCode' => array(
            'name' => '产品种类编码',
            'column' => 'breedCode',
            'type' => '文本',
            'require' => true,
        ),
        'featureCode' => array(
            'name' => '产品特征编码',
            'column' => 'featureCode',
            'type' => '文本',
            'require' => true,
        ),
        'gradeCode' => array(
            'name' => '产品等级编码',
            'column' => 'gradeCode',
            'type' => '文本',
            'require' => true,
        ),
        'logiAreaCode' => array(
            'name' => '物流区编码',
            'column' => 'logiAreaCode',
            'type' => '文本',
            'require' => true,
        ),
    ),

    'response' => array(
        'productID' => array(
            'name' => '商品ID',
            'column' => 'productID',
            'type' => '文本',
        ),
        'pricelist' => array(
            'name' => '价格列表',
            'column' => 'pricelist',
            'type' => 'List',
        ),
    ),

    'pricelist' => array(
        'orderLevel' => array(
            'name' => '订单等级等级',
            'column' => 'orderLevel',
            'type' => '文本',
        ),
        'price' => array(
            'name' => '商品价格',
            'column' => 'price',
            'type' => '文本',
        ),
    ),

);