<?php
/**
 * 买家账号登陆---------------IBY121201
 */
$remote['freeze_login'] = array(
    'url' => '/by/account/login',

    'params' => array(
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
        '' => array(
            'name' => '买家账号或者手机号',
            'column' => 'accountName',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '密码',
            'column' => 'accountPass',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
    ),

    'result' => array(
        // 'buyerId' => // os id
    ),
);