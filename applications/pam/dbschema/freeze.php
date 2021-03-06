<?php

// +----------------------------------------------------------------------
// | VMCSHOP [V M-Commerce Shop]
// +----------------------------------------------------------------------
// | Copyright (c) vmcshop.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.vmcshop.com/licensed)
// +----------------------------------------------------------------------
// | Author: Shanghai ChenShang Software Technology Co., Ltd.
// +----------------------------------------------------------------------


$db['freeze'] = array(
    'columns' => array(
        'freeze_id' => array(
            'pkey' => true,
            'type' => 'number',
            'comment' => '会员ID',
        ),
        'openid'=>array(
            'type' =>'varchar(255)',
            'label'=>'OpenId'
        ),
        'login_account' => array(
            'type' => 'varchar(100)',
            'is_title' => true,
            'required' => true,
            'comment' => '登录账号',
        ),
        'login_type' => array(
            'pkey' => true,
            'type' => array(
                'local' => '用户名',
                'mobile' => '手机号码',
                'email' => '邮箱',
            ),
            'default' => 'local',
            'comment' => '登录账号类型',
        ),
        'login_password' => array(
            'type' => 'varchar(32)',
            'required' => true,
            'comment' => '登录密码',
        ),
        'password' => array(
            'type' => 'varchar(32)',
            'required' => true,
            'comment' => '接口明文登录密码',
        ),
        'password_account' => array(
            'type' => 'varchar(100)',
            'required' => true,
            'comment' => '登录密码加密所用账号',
        ),
        'disabled' => array(
            'type' => 'bool',
            'default' => 'false',
        ),
        'createtime' => array(
            'type' => 'time',
            'comment' => '创建时间',
        ),
    ),
    'engine' => 'innodb',
    'comment' => '冻品账号表',
);
