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


$db['company_extra'] = array(
    'columns' => array(
        'extra_id' => array(
            'type' => 'number',
            'required' => true,
            'label' => '公司ID',
            'pkey' => true,
            'extra' => 'auto_increment',
            'in_list' => true,
            'comment' => '公司ID',
        ),
		'column' => array(
            'type' => 'varchar(100)',
            'required' => true,
            'label' => '字段名',
			'default' => '',
            'in_list' => true,
            'default_in_list' => true,
            'comment' => '字段名',
        ),
		'alias' => array(
            'label' => ('字段名'),
            'type' => 'varchar(50)',
			'required' => '',
			'default' => 0,            
            'comment' => '字段名',
        ),
		'value' => array(
            'type' => 'serialize',
            'required' => true,
			'default' => '',
            'label' => '值',           
            'comment' => '值',
        ),
		'attach'=> array(
            'type' => 'serialize',
            'required' => true,
			'default' => '',
            'label' => '附件',           
            'comment' => '附件',
        ),
		'company_id' => array(
            'type' => 'number',
            'required' => true,
            'default' => 0,
            'label' => '公司ID',           
            'in_list' => true,
            'default_in_list' => true,           
            'comment' => '公司ID',
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
    'version' => '$Rev$',
    'comment' => '公司扩展表',
);