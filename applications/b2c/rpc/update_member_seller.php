<?php

/**
 * 更新买家销售对象---------------IBY121204
 */
$remote['b2c_update_member_seller'] = array(

    'url' => '/by/salesTarget/update',

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
        'salesTargetType' => array(
            'name' => '销售对象类型',
            'column' => 'salesTargetType',
            'type' => 'String',
            'require' => false,
        ),
        'salesTargetName' => array(
            'name' => '销售对象名称',
            'column' => 'salesTargetName',
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