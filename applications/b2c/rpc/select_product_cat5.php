<?php
/**
 * 产品净重分类查询---------------IPD141138
 */
$remote['b2c_select_product_cat5'] = array(
    'url' => '/pd/pd_weight',

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
        'classesCode' => array(
            'name' => '一级分类编码',
            'column' => 'classesCode',
            'type' => 'String',
            'default' => '',
            'require' => true,
        ),
        'machiningCode' => array(
            'name' => '二级分类编码',
            'column' => 'machiningCode',
            'type' => 'String',
            'default' => '',
            'require' => true,
        ),
        'breedCode' => array(
            'name' => '品种编码',
            'column' => 'breedCode',
            'type' => 'String',
            'default' => '',
            'require' => true,
        ),
        'featureCode' => array(
            'name' => '特征编码',
            'column' => 'featureCode',
            'type' => 'String',
            'default' => '',
            'require' => true,
        ),
    ),

    'response' => array(
        'weightCode' => array(
            'name' => '产品净重编码',
            'column' => 'weightCode',
            'type' => 'String',
        ),
        'weightName' => array(
            'name' => '产品净重名称',
            'column' => 'weightName',
            'type' => 'String',
        ),
    ),

);