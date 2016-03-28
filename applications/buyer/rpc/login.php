<?php
/**
 * 买家账号登陆---------------IBY121201
 */
$remote['buyer_login'] = array(
    'url' => '/bs/slInfo/slAccount/search',

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
        'uname' => array(
            'name' => '买家账号或者手机号',
            'column' => 'slAccount',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        'password' => array(
            'name' => '密码',
            'column' => 'accountPsd',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
    ),

    'response' => array(
        'totalCount' => array(
            'name' => '买家ID',
            'column' => 'totalCount',
            'type' => 'String'
        ),
        'buyershopList' => array(
        	
        )
    ),
);