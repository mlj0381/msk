<?php
/**
 * 查询 商家基本信息---------------ISL231181
 */
$remote['seller_select_seller_info'] = array(
    'url' => '/sl/slInfo/searchAll',

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
            'require' => true
        ),
    ),

    'response' => array(
        'slAccount' => array(
            'name' => '卖家账号信息',
            'column' => 'slAccount',
            'type' => 'Object',
        ),
    ),

    'slAccount' => array(
        'slAccount' => array(
            'name' => '卖家账号',
            'column' => 'slAccount',
            'type' => 'String',
        ),
        'slTel' => array(
            'name' => '登录手机号码',
            'column' => 'slTel',
            'type' => 'String',
        ),
        'slShowName' => array(
            'name' => '卖家显示名称',
            'column' => 'slShowName',
            'type' => 'String',
        ),
        'slContact' => array(
            'name' => '联系人姓名',
            'column' => 'slContact',
            'type' => 'String',
        ),
        'accountPsd' => array(
            'name' => '登录密码',
            'column' => 'accountPsd',
            'type' => 'String',
        ),
        'authStatus' => array(
            'name' => '认证状态',
            'column' => 'authStatus',
            'type' => 'Integer',
        ),
        'fromFlg' => array(
            'name' => '注册来源',
            'column' => 'fromFlg',
            'type' => 'String',
        ),
    ),

);