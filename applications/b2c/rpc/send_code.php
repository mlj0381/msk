<?php
/**
 * 验证码短信平台接口---------------IOL101001
 */
$remote['b2c_send_code'] = array(

    'url' => '/ol/send/captcha',

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
        'mobile' => array(
            'name' => '手机号码',
            'column' => 'mobile',
            'type' => 'String',
            'require' => true,
        ),
    ),

    'response' => array(
        'captcha' => array(
            'name' => '手机号码',
            'column' => 'captcha',
            'type' => 'String',
        ),
    ),
);