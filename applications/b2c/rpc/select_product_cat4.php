<?php
/**
 * 产品特征查询接口---------------IPD141129
 */
$remote['b2c_select_product_cat4'] = array(
    'url' => '/pd/pd_feature',

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
    ),

    'response' => array(
        'featureCode' => array(
            'name' => '产品特征编码',
            'column' => 'featureCode',
            'type' => 'String',
        ),
        'featureName' => array(
            'name' => '产品特征名称',
            'column' => 'featureName',
            'type' => 'String',
        ),
    ),

);