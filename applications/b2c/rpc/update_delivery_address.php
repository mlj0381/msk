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
            'require' => true,
        ),
        'rpc_addr_id' => array(
            'name' => '地址ID',
            'column' => 'id',
            'type' => 'String',
            'require' => false,
        ),
        'addr' => array(
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

    'response' => array(
        'buyerId' => array(
            'name' => '买家ID',
            'column' => 'buyerId',
            'type' => 'String',
        ),
        'id' => array(
            'name' => '地址ID',
            'column' => 'rpc_addr_id',
            'type' => 'long',
        ),
        'receiveAddr' => array(
            'name' => '收货地址',
            'column' => 'receiveAddr',
            'type' => 'String',
        ),
    ),
);