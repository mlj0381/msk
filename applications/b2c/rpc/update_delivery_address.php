<?php
/**
 * 更新收货地址---------------IBY121208
 */
$remote['b2c_update_delivery_address'] = array(

    'url' => '/by/receiveAddr/update',

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
        'receiveAddr' => array(
            'name' => '收货地址',
            'column' => 'receiveAddr',
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