<?php
/**
 * 查询收货地址---------------IBY121208
 */
$remote['b2c_select_delivery_address'] = array(

    'url' => '/by/receiveAddr/findList',

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
        'buyer_id' => array(
            'name' => '买家ID',
            'column' => 'buyerId',
            'type' => 'String',
            'require' => true,
        ),
    ),

    'response' => array(
        'buyerId' => array(
            'name' => '买家ID',
            'column' => 'buyerId',
            'type' => 'String',
        ),
        'addr_id' => array(
            'name' => '买家收货地址ID',
            'column' => 'id',
            'type' => 'long',
        ),
        'receiveAddr' => array(
            'name' => '收货地址',
            'column' => 'receiveAddr',
            'type' => 'String',
        ),
        'updId' => array(
            'name' => '更新者ID',
            'column' => 'updId',
            'type' => 'String',
        ),
    ),
);