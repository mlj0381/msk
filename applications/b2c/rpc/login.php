<?php
/**
 * 买家账号登陆---------------IBY121201
 */
$remote['b2c_login'] = array(
    'url' => '/by/account/login',

    'request' => array(
        'member_id' => array(
            'name' => '登陆的用户ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require'=> false
        ),
        'param' => array(
            'name' => '参数',
            'column' => 'param',
            'type' => 'object',
            'default' => Array(),
            //'require'=> true
        ),
    ),

    'param' => array(
        'login_account' => array(
            'name' => '买家账号或者手机号',
            'column' => 'accountName',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        'login_password' => array(
            'name' => '密码',
            'column' => 'accountPass',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
    ),

    'response' => array(
        'buyerId' => array(
            'name' => '买家ID',
            'column' => 'buyerId',
            'type' => 'String'
        )
    ),
);