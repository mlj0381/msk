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
        'dobusiness_phone' => array(
            'type' => 'varchar(100)',
            'label' => '营业电话',
            'default' => '',
            'in_list' => true,
            'comment' => '营业电话',
        ),
        'company_contacts' => array(
            'type' => 'varchar(100)',
            'label' => '联系人',
            'default' => '',
            'in_list' => true,
            'comment' => '联系人',
        ),
        'contacts_phone' => array(
            'type' => 'varchar(100)',
            'label' => '联系人电话',
            'default' => '',
            'in_list' => true,
            'comment' => '联系人电话',
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
        // 法人
        'legal_person' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '法人',
            'comment' => '法人',
        ),
        'legal_mobile' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '手机',
            'comment' => ('手机'),
        ),
        'boss_name' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '老板姓名',
            'comment' => '老板姓名',
        ),
        'boss_mobile' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '老板手机',
            'comment' => ('老板手机'),
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
        
        
        'legal_idcard' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '身份证',
            'comment' => ('身份证'),
        ),
        
        
        'legal_idcard_image' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '身份证',
            'comment' => ('身份证'),
        ),
        'company_web' => array(
            'type' => 'varchar(100)',
            'label' => '公司网址',
            'in_list' => true,
            'default' => '',
            'default_in_list' => true,
            'comment' => '公司网址',
        ),
        'company_name' => array(
            'type' => 'varchar(100)',
            'required' => true,
            'label' => '公司名称',
            'in_list' => true,
            'default_in_list' => true,
            'comment' => '公司名称',
        ),
        'company_addr' => array(
            'type' => 'varchar(200)',
            'required' => true,
            'label' => '公司地址',
            'in_list' => false,
            'comment' => '公司地址',
        ),
        'company_area' => array(
            'label' => ('地区'),
            'type' => 'region',
            'filtertype' => 'yes',
            'filterdefault' => true,
            'in_list' => true,
            'default' => '',
            'default_in_list' => true,
        ),
        'company_product' => array(
            'label' => ('经营产品'),
            'type' => array(
                1 => ('鸡肉类'),
                2 => ('猪肉类'),
                3 => ('牛肉类'),
                4 => ('其他'),
            ),
            'filtertype' => 'yes',
            'filterdefault' => 'true',
            'in_list' => false,
            'default_in_list' => false,
            'comment' => '经营产品',
        ),
        'company_prototype' => array(
            'label' => ('公司性质'),
            'type' => array(
                1 => ('政府机关/事业单位'),
                2 => ('国营'),
                3 => ('私营'),
                4 => ('中外合资'),
                5 => ('外资'),
                6 => ('其他'),
            ),
            'filtertype' => 'yes',
            'filterdefault' => 'true',
            'in_list' => true,
            'default_in_list' => false,
            'comment' => '公司性质',
        ),
        'register_money' => array(
            'type' => 'number',
            'default' => 0,
            'label' => '注册资本',
            'comment' => '注册资本',
        ),
        'reality_money' => array(
            'type' => 'number',
            'default' => 0,
            'label' => '实收资本',
            'comment' => '实收资本',
        ),
        'run_range' => array(
            'type' => 'varchar(200)',
            'default' => '',
            'label' => '经营范围',
            'comment' => '经营范围',
        ),
        'run_deadline' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '经营期限',
            'comment' => '经营期限',
        ),
        'establish_time' => array(
            'type' => 'varchar(200)',
            'default' => '',
            'label' => '成立日期',
            'comment' => '成立日期',
        ),
        // 营业执照
        'business_license_number' => array(
            'type' => 'varchar(200)',
            'default' => '',
            'label' => '营业执照注册号',
            'comment' => '营业执照注册号',
        ),
        'business_license_area' => array(
            'type' => 'region',
            'sdfpath' => 'contact/area',
            'default' => '',
            'label' => '营业注册地',
            'comment' => '营业注册地',
        ),
        'business_license_addr' => array(
            'type' => 'varchar(200)',
            'default' => '',
            'label' => '营业注册地址',
            'comment' => '营业注册地址',
        ),
        'business_license_image' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '营业执照图片',
            'comment' => ('营业执照图片'),
        ),
        // 组织机构
        'organization_number' => array(
            'type' => 'varchar(200)',
            'default' => '',
            'label' => '组织机构代码',
            'comment' => '组织机构代码',
        ),
        'organization_outtime' => array(
            'type' => 'time',
            'default' => 0,
            'comment' => ('代码有效期'),
            'label' => ('代码有效期'),
        ),
        'organization_image' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '代码证图片',
            'comment' => '代码证图片',
        ),
        // 税务登记信息
        'tax_payer_number' => array(
            'type' => 'varchar(200)',
            'default' => '',
            'label' => '纳税人识别号',
            'comment' => '纳税人识别号',
        ),
        'tax_number' => array(
            'type' => 'varchar(200)',
            'default' => '',
            'label' => '税务登记证号',
            'comment' => '税务登记证号',
        ),
        'tax_image' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '代码证图片',
            'comment' => '代码证图片',
        ),
        // 银行账户
        'bank_account_name' => array(
            'type' => 'varchar(200)',
            'default' => '',
            'label' => '银行开户名',
            'comment' => '银行开户名',
        ),
        'bank_account_number' => array(
            'type' => 'varchar(200)',
            'default' => '',
            'label' => '银行开户账号',
            'comment' => '银行开户账号',
        ),
        'bank_name' => array(
            'type' => 'varchar(200)',
            'default' => '',
            'label' => '开户行名称',
            'comment' => '开户行名称',
        ),
        'bank_area' => array(
            'type' => 'region',
            'default' => '',
            'sdfpath' => 'contact/area',
            'label' => '开户银行所在地',
            'comment' => '开户银行所在地',
        ),
        'bank_branch_number' => array(
            'type' => 'text',
            'default' => '',
            'label' => '开户银行支行联行号：',
            'comment' => '开户银行支行联行号：',
        ),
        'extra' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '资质信息',
            'comment' => '资质信息',
        ),
        'uid' => array(
            'type' => 'number',
            'required' => true,
            'default' => 0,
            'label' => '商家',
            'searchtype' => 'has',
            'in_list' => true,
            'default_in_list' => true,
            'order' => '1',
            'comment' => '商家',
        ),
        'identity' => array(
            'type' => array(
                'member' => '会员',
                'seller' => '商家'
            ),
            'label' => '企业注册类型',
            'comment' => '企业注册类型',
        ),
        'status' => array(
            'type' => array(
                '0' => '待核',
                '1' => '已通过',
                '-1' => '已拒绝'
            ),
            'default' => '0',
            'label' => ('审核状态'),
            'commit' => ('审核状态'),
            'in_list' => true,
            'default_in_list' => true,
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
