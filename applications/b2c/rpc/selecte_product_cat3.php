<?php
/**
 * 查询产品三级分类---------------IPD141128
 */
$remote['b2c_selecte_product_cat3'] = array(
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
            'default' => '01',
            'require' => true,
        ),
        'machiningCode' => array(
            'name' => '二级分类编码',
            'column' => 'machiningCode',
            'type' => 'String',
            'default' => '01',
            'require' => true,
        ),
    ),

    'response' => array(
        'pdList' => array(
            'name' => '产品信息列表',
            'column' => 'pdList',
            'type' => 'List',
        ),
    ),

    'pdList' => array(
        'pdTypeCode1' => array(
            'name' => '产品1级分类编码',
            'column' => 'pdTypeCode1',
            'type' => 'String',
        ),
        'pdTypeName1' => array(
            'name' => '产品1级分类名称',
            'column' => 'pdTypeName1',
            'type' => 'String',
        ),
        'pdType2List' => array(
            'name' => '产品信息列表',
            'column' => 'pdType2List',
            'type' => 'List',
        ),
    ),

    'pdType2List' => array(
        'pdTypeCode2' => array(
            'name' => '产品2级分类编码',
            'column' => 'pdTypeCode2',
            'type' => 'String',
        ),
        'pdTypeName2' => array(
            'name' => '产品2级分类名称',
            'column' => 'pdTypeName2',
            'type' => 'String',
        ),
    ),

);