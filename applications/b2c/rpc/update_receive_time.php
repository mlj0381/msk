<?php
/**
 * 更新收货时间---------------IBY121209
 */
$remote['b2c_update_receive_time'] = array(
    'url' => '/by/receiveTime/update',

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
        'buyer_id' => array(
            'name' => '买家ID',
            'column' => 'buyerId',
            'type' => 'String',
            'require' => false,
        ),
        'recPerType' => array(
            'name' => '收货时间段类型',
            'column' => 'recPerType',
            'type' => 'String',
            'require' => false,
        ),
        'timeDescribe' => array(
            'name' => '时间描述',
            'column' => 'timeDescribe',
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