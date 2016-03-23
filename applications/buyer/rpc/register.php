<?php
/**
 * 买家账号注册---------------IBY121201
 */
$remote['freeze_register'] = array(
    'url' => '/by/account/register',

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
            'name' => '手机号，用户手机号为必填',
            'column' => 'telNo',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '账号名，若不填，则以手机号存入DB',
            'column' => 'accountName',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '账号密码，若不填，则以手机号存入DB',
            'column' => 'accountPass',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '注册来源',
            'column' => 'registerSource',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '更新者ID',
            'column' => 'updId',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
    ),

    'result' => array(
        // 'buyerId' => // os id
    ),
);