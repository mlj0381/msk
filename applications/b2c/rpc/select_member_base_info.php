<?php
/**
 * 查询买家基本信息---------------IBY121202
 */
$remote['b2c_select_member_base_info'] = array(
    'url' => '/by/buyerInfo/findDetail',

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
            'require' => false
        ),
    ),

    'response' => array(
        'buyerId' => array(
            'name' => '买家ID',
            'column' => 'buyerId',
            'type' => 'String',
        ),
        'recPerType' => array(
            'name' => '收货时间段类型',
            'column' => 'recPerType',
            'type' => 'String',
        ),
        'timeDescribe' => array(
            'name' => '时间描述',
            'column' => 'timeDescribe',
            'type' => 'String',
        ),
    ),

);