<?php
/**
 * 查询产品一级与二级分类---------------IPD141110
 */
$remote['b2c_select_product_cat12'] = array(
    'url' => '/pd/pdBidType',

    'request' => array(
        'member_id' => array(
            'name' => '登陆的用户ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false,
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