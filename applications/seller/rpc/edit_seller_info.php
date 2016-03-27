<?php
/**
 * 编辑商家基本信息---------------ISL231180
 */
$remote['seller_edit_seller_info'] = array(
    'url' => '/sl/slInfo/newOrUpdateAll',

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
            'name' => '卖家账号信息',
            'column' => 'slAccount',
            'type' => 'Object',
            'require' => false
        ),
    ),

    'slAccount' => array(
        'login_account' => array(
            'name' => '卖家账号',
            'column' => 'slAccount',
            'type' => 'String',
            'require' => false
        ),
        'mobile' => array(
            'name' => '登录手机号码',
            'column' => 'slTel',
            'type' => 'String',
            'require' => false
        ),
        'show_name' => array(
            'name' => '卖家显示名称',
            'column' => 'slShowName',
            'type' => 'String',
            'require' => false
        ),
        'contact_person' => array(
            'name' => '联系人姓名',
            'column' => 'slContact',
            'type' => 'String',
            'require' => false
        ),
        'login_password' => array(
            'name' => '登录密码',
            'column' => 'accountPsd',
            'type' => 'String',
            'require' => false
        ),
        'authStatus' => array(
            'name' => '认证状态',
            'column' => 'authStatus',
            'type' => 'Integer',
            'require' => false
        ),
        'fromFlg' => array(
            'name' => '注册来源',
            'column' => 'fromFlg',
            'type' => 'String',
            'require' => false
        ),
    ),

    'response' => array(),

);