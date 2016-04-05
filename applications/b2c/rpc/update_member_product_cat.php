<?php

/**
 * 更新买家经营产品类别---------------IBY121203
 */
$remote['b2c_update_member_product_cat'] = array(

    'url' => '/by/pdClassification/update',

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
            'type' => 'List',
            'require' => false,
        ),
    ),

    'param' => array(
        'member_id' => array(
            'name' => '买家ID',
            'column' => 'buyerId',
            'type' => 'String',
            'require' => false,
        ),
        'cat_id' => array(
            'name' => '产品类别编码',
            'column' => 'classCode',
            'type' => 'String',
            'require' => false,
        ),
        'cat_name' => array(
            'name' => '产品类别名称',
            'column' => 'className',
            'type' => 'String',
            'require' => false,
        ),
        'updId' => array(
            'name' => '更新者ID',
            'column' => 'updId',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'response' => array(),
);