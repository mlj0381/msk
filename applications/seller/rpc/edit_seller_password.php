<?php
/**
 * 修改卖家账号密码---------------ISL231183
 */
$remote['seller_edit_seller_password'] = array(
    'url' => '/sl/slInfo/slAccount/psdUpdate',

    'request' => array(
        'member_id' => array(
            'name' => '登陆的用户ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'param' => array(
            'name' => '参数',
            'column' => 'param',
            'type' => 'object',
            'default' => Array(),
        ),
    ),

    'param' => array(
        'slAccount' => array(
            'name' => '卖家账号',
            'column' => 'slAccount',
            'type' => 'String',
            'require' => false,
        ),
        'oldAccountPsd' => array(
            'name' => '旧密码',
            'column' => 'oldAccountPsd',
            'type' => 'String',
            'require' => false,
        ),
        'newAccountPsd' => array(
            'name' => '新密码',
            'column' => 'newAccountPsd',
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