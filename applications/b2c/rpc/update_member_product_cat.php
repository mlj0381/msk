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
            'type' => 'Object',
            'require' => false,
        ),
    ),

    'param' => array(
        'buyerId' => array(
            'name' => '买家ID',
            'column' => 'buyerId',
            'type' => 'String',
            'require' => true,
        ),
        'classCode' => array(
            'name' => '产品类别编码',
            'column' => 'classCode',
            'type' => 'String',
            'require' => true,
        ),
        'className' => array(
            'name' => '产品类别名称',
            'column' => 'className',
            'type' => 'String',
            'require' => true,
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