<?php
/**
 * 产品品种查询接口---------------IPD141128
 */
$remote['b2c_select_product_cat3'] = array(
    'url' => '/pd/pd_breed',

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
    ),

    'response' => array(
        'breedCode' => array(
            'name' => '产品品种编码',
            'column' => 'breedCode',
            'type' => 'String',
        ),
        'breedName' => array(
            'name' => '产品品种名称',
            'column' => 'breedName',
            'type' => 'String',
        ),
    ),

);