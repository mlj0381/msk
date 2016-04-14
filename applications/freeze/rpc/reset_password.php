<?php
/**
 * 冻品管家账号密码修改---------------IBS2101109
 */
$remote['freeze_reset_password'] = array(
    'url' => '/bs/slInfo/updatePsd',

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
        'account' => array(
            'name' => '卖家账号',
            'column' => 'houseAccount',
            'type' => 'String',
            'require' => false,
        ),
        'old_password' => array(
            'name' => '旧密码',
            'column' => 'oldAccountPsd',
            'type' => 'String',
            'require' => false,
        ),
        'new_password' => array(
            'name' => '新密码',
            'column' => 'newAccountPsd',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'response' => array(

    ),
);