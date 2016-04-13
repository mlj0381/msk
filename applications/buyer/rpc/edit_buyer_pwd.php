<?php
/**
 * 编辑买手信息---------------IBS2101102
 */
$remote['buyer_edit_buyer_pwd'] = array(
    'url' => '/bs/slInfo/slAccount/newOrUpdate',

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
        'slAccount' => array(
            'name' => '买手账号信息',
            'column' => 'slAccount',
            'type' => 'object',
        ),
        'loginId' => array(
            'name' => '  创建者ID/更新者ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'delFlg' => array(
            'name' => '  删除标志',
            'column' => 'delFlg',
            'type' => 'String',
            'default' => '0',
            'require' => false,
        ),
        'ver' => array(
            'name' => '  版本号',
            'column' => 'ver',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
    ),

    'slAccount' => array(
	    'buyer_code' => array(
	    	'name' => '买手ID',
	    	'column' => 'slCode',
	    	'type' => 'String',
	    	'require' => false,
	    ),
        'login_account' => array(
            'name' => '卖家账号',
            'column' => 'slAccount',
            'type' => 'String',
            'require' => false,
        ),
        'phone' => array(
            'name' => '登录手机号码',
            'column' => 'slTel',
            'type' => 'String',
            'require' => false,
        ),
        'local' => array(
            'name' => '卖家显示名称',
            'column' => 'slShowName',
            'type' => 'String',
            'require' => false,
        ),
        'name' => array(
            'name' => '联系人姓名',
            'column' => 'slContact',
            'type' => 'String',
            'require' => false,
        ),
        'password' => array(
            'name' => '登录密码',
            'column' => 'accountPsd',
            'type' => 'String',
            'require' => false,
        ),
        'authStatus' => array(
            'name' => '认证状态',
            'column' => 'authStatus',
            'type' => 'Integer',
            'require' => false,
        ),
        'fromFlg' => array(
            'name' => '注册来源',
            'column' => 'fromFlg',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'response' => array(),

);