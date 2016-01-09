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
// | 商家资质
// +----------------------------------------------------------------------
$db['license'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'number',
            'extra' => 'auto_increment',
            'pkey' => true,
            'label' => ('执照id'),
            'commit' => ('执照id'),
            'required' => true,
        ),
         // 营业执照
        'business_license_number' => array(
            'type' => 'varchar(200)',
            'label' => '营业执照注册号',
            'comment' => '营业执照注册号',
        ),
        'company_name' => array(
            'type' => 'varchar(200)',
            'label' => '公司名称',
            'comment' => '公司名称',
        ),
        'company_prototype' => array(
            'label' => ('公司类型'),
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
            'comment' => '公司类型',
        ),
        'house' => array(
            'type' => 'varchar(200)',
            'default' => '',
            'label' => '住所',
            'comment' => ('住所'),
        ),
        'legal_person' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '法人',
            'comment' => '法人',
        ),
        'register_money' => array(
            'type' => 'number',
            'default' => '',
            'label' => '注册资金',
            'comment' => '注册资金',
        ),
        'establish_time' => array(
            'type' => 'varchar(20)',
            'default' => '',
            'label' => '成立日期',
            'comment' => '成立日期',
        ),
        'open_time' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '营业期限',
            'comment' => '营业期限',
        ),
        'business_license_image' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '营业执照图片',
            'comment' => ('营业执照图片'),
        ),
        //营业执照
    /* 老版营业执照所需字段 begin*/  
        'real_price' => array(
            'type' => 'number',
            'default' => '',
            'label' => '实收资本',
            'comment' => '实收资本',
        ),
        //组织机构
        'organization_number' => array(
            'type' => 'varchar(200)',
            'default' => '',
            'label' => '组织机构代码',
            'comment' => '组织机构代码',
        ),
        'organization_image' => array(
            'type' => 'char(32)',
            'default' => '',
            'label' => '代码证图片',
            'comment' => '代码证图片',
        ),
        //组织机构
        
        //税务登记证
        'tax_number' => array(
            'type' => 'varchar(200)',
            'default' => '',
            'label' => '税务登记证号',
            'comment' => '税务登记证号',
        ),
        'tax_image' => array(
            'type' => 'char(32)',
            'default' => '',
            'label' => '税务登记证图片',
            'comment' => '税务登记证图片',
        ),
        'tax_bearer_num' => array(
            'type' => 'char(32)',
            'default' => '',
            'label' => '一般纳税人资格认定编号',
            'comment' => '一般纳税人资格认定编号',
        ),
        //税务登记证
        
        //银行信息
        'bank_account_number' => array(
            'type' => 'varchar(200)',
            'label' => '银行开户账号',
            'comment' => '银行开户账号',
        ),
        'bank_name' => array(
            'type' => 'varchar(200)',
            'default' => '',
            'label' => '开户行名称',
            'comment' => '开户行名称',
        ),
        'bank_permission' => array(
            'type' => 'char(32)',
            'default' => '',
            'label' => '银行开户许可证',
            'comment' => '银行开户许可证',
        ),
        //银行信息
        /* 老版营业执照所需字段 end*/  
        'seller_id' => array(
            'type' => 'table:sellers',
            'label' => ('商家id'),
            'commit' => ('商家id'),
            'required' => true,
        ),
        'license_type' => array(
            'type' => array(
                'member' => '买家营业执照',
                'seller' => '卖家营业执照',
            ),
            'default' => 'member',
            'label' => ('营业执照类型'),
            'commit' => ('营业执照类型'),
            'required' => true,
        ),
    ),
    'engine' => 'innodb',
    'comment' => '营业执照表',
);
