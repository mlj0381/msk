<?php
/**
 * 查询产品一级分类---------------IPD141101
 */
$remote['b2c_select_product_cat1'] = array(
    'url' => '/pd/pd_classes',

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

    'response' => array(
        'classesCode' => array(
            'name' => '类别编码',
            'column' => 'classesCode',
            'type' => 'String',
        ),
        'classesName' => array(
            'name' => '类别名称',
            'column' => 'classesName',
            'type' => 'String',
        ),
    ),

);