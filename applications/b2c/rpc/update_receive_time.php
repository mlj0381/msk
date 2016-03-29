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
        'paramList' => array(
            'name' => '业务参数',
            'column' => 'paramList',
            'type' => 'Object',
            'require' => false,
        ),
    ),

    'paramList' => array(
        'buyerId' => array(
            'name' => '买家ID',
            'column' => 'buyerId',
            'type' => 'String',
            'require' => true,
        ),
        'timeDescribe' => array(
            'name' => '时间描述',
            'column' => 'timeDescribe',
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