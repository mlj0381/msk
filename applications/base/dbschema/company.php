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


$db['company'] = array(
    'columns' => array(
        'company_id' => array(
            'type' => 'number',
            'required' => true,
            'label' => '公司ID',
            'pkey' => true,
            'extra' => 'auto_increment',
            'in_list' => true,
            'comment' => '公司ID',
        ),
        'name' => array(
            'type' => 'varchar(100)',
            'required' => true,
            'label' => '公司名称',
            'default' => '',
            'in_list' => true,
            'default_in_list' => true,
            'comment' => '公司名称',
        ),
        'enterprise_type' => array(
            'label' => ('公司类型'),
            'type' => array(
                1 => ('政府机关/事业单位'),
                2 => ('国营'),
                3 => ('私营'),
                4 => ('中外合资'),
                5 => ('外资'),
                6 => ('其他'),
            ),
            'default' => '1',
            'in_list' => true,
            'default_in_list' => false,
            'comment' => '公司类型',
        ),
        'area' => array(
            'type' => 'region',
            'required' => true,
            'default' => '',
            'label' => '公司地区',
            'in_list' => false,
            'comment' => '公司地区',
        ),
        'address' => array(
            'type' => 'varchar(200)',
            'required' => true,
            'default' => '',
            'label' => '公司地址',
            'in_list' => false,
            'comment' => '公司地址',
        ),
        'registered_capital' => array(
            'type' => 'number',
            'required' => true,
            'default' => 0,
            'label' => '注册资本',
            'in_list' => false,
            'comment' => '注册资本',
        ),
        'reality_capital' => array(
            'type' => 'number',
            'required' => true,
            'default' => 0,
            'label' => '实收资本',
            'in_list' => false,
            'comment' => '实收资本',
        ),
        'web_site' => array(
            'type' => 'varchar(100)',
            'required' => true,
            'default' => '',
            'label' => '网站地址',
            'in_list' => false,
            'comment' => '网站地址',
        ),
        'leagl_person' => array(
            'type' => 'varchar(100)',
            'required' => true,
            'default' => '',
            'label' => '法人代表',
            'in_list' => false,
            'comment' => '法人代表',
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
        'establishment_date' => array(
            'type' => 'date',
            'required' => true,
            'default' => '0000-00-00',
            'label' => '成立日期',
            'in_list' => false,
            'comment' => '成立日期',
        ),
        'business_scope' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '营业期限',
            'in_list' => false,
            'comment' => '营业期限',
        ),
        'operating_period' => array(
            'type' => 'varchar(100)',
            'default' => '',
            'label' => '经营范围',
            'in_list' => false,
            'comment' => '经营范围',
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
        
        
        'uid' => array(
            'type' => 'number',
            'required' => true,
            'default' => 0,
            'label' => '用户ID',
            'comment' => '用户ID',
        ),
    ),
    'version' => '$Rev$',
    'comment' => '公司表',
);
