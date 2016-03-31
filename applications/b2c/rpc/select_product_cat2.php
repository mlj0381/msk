<?php
/**
 * 查询产品二级分类---------------IPD141104
 */
$remote['b2c_select_product_cat2'] = array(
    'url' => '/pd/pd_machining',

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
        'cat_id1' => array(
            'name' => '一级分类编码',
            'column' => 'classesCode',
            'type' => 'String',
            'default' => '',
            'require' => true,
        ),
    ),

    'response' => array(
        'machiningCode' => array(
            'name' => '产品品种编码',
            'column' => 'machiningCode',
            'type' => 'String',
        ),
        'machiningName' => array(
            'name' => '产品品种名称',
            'column' => 'machiningName',
            'type' => 'String',
        ),
    ),

);