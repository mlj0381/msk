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
			'default' => 0,
            'in_list' => true,
            'default_in_list' => false,
            'comment' => '公司类型',
        ),
		'address' => array(
            'type' => 'varchar(200)',
            'required' => true,
			'default' => '',
            'label' => '公司地址',
            'in_list' => false,
            'comment' => '公司地址',
        ),
		'registered_capital ' => array(
            'type' => 'number',
            'required' => true,
			'default' => 0,
            'label' => '注册资本',
            'in_list' => false,
            'comment' => '注册资本',
        ),
		'establishment_date ' => array(
            'type' => 'date',
            'required' => true,
			'default' => '0000-00-00',
            'label' => '成立日期',
            'in_list' => false,
            'comment' => '成立日期',
        ),
		'business_scope' => array(
            'type' => 'varchar(200)',
            'required' => true,
			'default' => '',
            'label' => '营业期限',
            'in_list' => false,
            'comment' => '营业期限',
        ),
		'operating_period' => array(
            'type' => 'varchar(100)',
            'required' => true,
			'default' => '',
            'label' => '经营范围',
            'in_list' => false,
            'comment' => '经营范围',
        ),	
		'seller_id' => array(
            'type' => 'number',
            'required' => true,
            'default' => 0,
            'label' => '商家ID',           
            'in_list' => true,
            'default_in_list' => true,           
            'comment' => '商家ID',
        ),       
    ),
    'index' => array(
        'ind_name' => array(
            'columns' => array(
                0 => 'company_name',
            ),
            'prefix' => 'unique',
        ),
    ),
    'version' => '$Rev$',
    'comment' => '公司表',
);