<?php
/**
 * 买家账号密码修改---------------IBY121201
 */
$remote['b2c_edit_password'] = array(
    'url' => '/by/account/updatePwd',

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
            //'require'=> true
        ),
    ),

    'param' => array(
        'buyerId' => array(
            'name' => '买家ID',
            'column' => 'buyerId',
            'type' => 'String',
            'require' => true,
        ),
        'accountName' => array(
            'name' => '账号名',
            'column' => 'accountName',
            'type' => 'String',
            'require' => true,
        ),
        'oldAccountPass' => array(
            'name' => '旧密码',
            'column' => 'oldAccountPass',
            'type' => 'String',
            'require' => true,
        ),
        'newAccountPass' => array(
            'name' => '新密码',
            'column' => 'newAccountPass',
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