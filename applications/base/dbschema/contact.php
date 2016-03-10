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


$db['contact'] = array(
    'columns' => array(
        'company_id' => array(
            'type' => 'number',
            'required' => true,
            'label' => '联系人ID',
            'pkey' => true,
            'extra' => 'auto_increment',
            'in_list' => true,
            'comment' => '联系人ID',
        ),
        
        'contact_addr' => array(
            'type' => 'varchar(200)',
            //'required' => true,
            'label' => '公司地址',
            'in_list' => false,
            'comment' => '公司地址',
        ),
        
        'contact_area' => array(
            'label' => ('地区'),
            'type' => 'region',
            'sdfpath' => 'contact/area',
            'filtertype' => 'yes',
            'filterdefault' => true,
            'in_list' => true,
            'default_in_list' => true,
        ),
        'uid' => array(
            'type' => 'number',
            'required' => false,
            'default' => 0,
            'label' => '所属用户id',
            'searchtype' => 'has',
            'in_list' => true,
            'default_in_list' => true,
            'order' => '1',
            'comment' => '所属用户id',
        ),
        
        'boss_name' => array(
            'type' => 'varchar(100)',
            'required' => true,
            'label' => '老板姓名',
            'in_list' => true,
            'default_in_list' => true,
            'comment' => '老板姓名',
        ),
        'boss_mobile' => array(
            'type' => 'varchar(20)',
            'default' => '',
            'label' => '老板电话',
            'comment' => '老板电话',
        ),
        'boss_qq' => array(
            'type' => 'varchar(20)',
            'default' => '',
            'label' => '老板QQ',
            'comment' => '老板QQ',
        ),
        'boss_wechat' => array(
            'type' => 'varchar(20)',
            'default' => '',
            'label' => '老板wechat',
            'comment' => '老板wechat',
        ),
        
        'name' => array(
            'type' => 'varchar(100)',
            'required' => true,
            'label' => '姓名',
            'in_list' => true,
            'default_in_list' => true,
            'comment' => '姓名',
        ),
        'tel' => array(
            'type' => 'varchar(50)',
            'label' => ('固定电话'),
            'searchtype' => 'head',
            'editable' => true,
            'filtertype' => 'normal',
            'filterdefault' => 'true',
            'in_list' => true,
            'default_in_list' => false,
        ),
        'email' => array(
            'type' => 'varchar(200)',
            'sdfpath' => 'consignor/email',
            'label' => ('联系人Email'),
            'comment' => ('联系人Email'),
        ),
        'contact_qq' => array(
            'type' => 'varchar(20)',
            'default' => '',
            'label' => '联系人QQ',
            'comment' => '联系人QQ',
        ),
        'contact_wechat' => array(
            'type' => 'varchar(20)',
            'default' => '',
            'label' => '联系人wechat',
            'comment' => '联系人wechat',
        ),
        'from' => array(
            'label' => ('所属'),
            'type' => array(
                0 => 'member',
                1 => 'seller'
            ),
            'default' => '0',
            'in_list' => true,
            'default_in_list' => false,
            'comment' => '所属',
        ),
    ),
    'index' => array(

    ),
    'version' => '$Rev$',
    'comment' => '联系人表',
);
