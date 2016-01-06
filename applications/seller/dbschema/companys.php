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
$db['companys'] = array(
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
        /*代理型、OEM型共有字段 begin*/
        'food_permission' => array(
            'type' => 'char(32)',
            'default' => '',
            'label' => '食品流通许可证',
            'comment' => '食品流通许可证',
        ),
        'food_time' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '食品流通许可证有效期',
            'comment' => '食品流通许可证有效期',
        ),
        'food_image' => array(
            'type' => 'char(32)',
            'default' => '',
            'label' => '食品流通许可证图片',
            'comment' => '食品流通许可证图片',
        ),
        /* 代理型、OEM型共有字段 end*/
        /* 代理型特有字段 begin*/
        'agent_delegate' => array(
            'type' => 'varchar(100)',
            'default' => '',
            'label' => '代理授权单位',
            'comment' => '代理授权单位',
        ),
        'agent_time' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '代理授权期限',
            'comment' => '代理授权期限',
        ),
        'agent_image' => array(
            'type' => 'char(32)',
            'default' => '',
            'label' => '代理授权图片',
            'comment' => '代理授权图片',
        ),
        /* 代理型特有字段 end*/
        
        /* OME型特有字段 begin*/
        'ome_delegate' => array(
            'type' => 'varchar(100)',
            'default' => '',
            'label' => 'OME授权单位',
            'comment' => 'OME授权单位',
        ),
         'ome_callback' => array(
            'type' => 'varchar(100)',
            'default' => '',
            'label' => 'OME被授权单位',
            'comment' => 'OME被授权单位',
        ),
        'ome_image' => array(
            'type' => 'char(32)',
            'default' => '',
            'label' => 'OME授权图片',
            'comment' => 'OME授权图片',
        ),
        /* OME型特有字段 end*/
        
        /*以下为三种卖家身份共有字段*/
        'seller_id' => array(
            'type' => 'table:sellers',
            'required' => true,
            'label' => '所属商家',
            'comment' => '所属商家'
        ),
        'checkin' => array(
            'type' => array(
                '0' => '审核中',
                '1' => '通过',
                '-1' => '拒绝'
            ),
            'default' => '0',
            'required' => true,
            'label' => '审核状态',
            'comment' => '审核状态'
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
        /*共有字段 begin */
        'quarantine_pass_num' => array(
            'type' => 'varchar(30)',
            'required' => true,
            'label' => '动物防疫合格证代码',
            'comment' => '动物防疫合格证代码',
        ),
        'quarantine_time' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '动物防疫日期',
            'comment' => '动物防疫日期',
        ),
        'quarantine_image' => array(
            'type' => 'char(32)',
            'required' => true,
            'label' => '动物防疫照片',
            'comment' => '动物防疫照片',
        ),
        
        'butcher_num' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '定点屠宰证代码',
            'comment' => '定点屠宰证代码',
        ),
        'permission_num' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '定点屠宰批准号',
            'comment' => '定点屠宰批准号',
        ),
        'butcher_image' => array(
            'type' => 'char(32)',
            'default' => '',
            'label' => '定点屠宰证图片',
            'comment' => '定点屠宰证图片',
        ),
        
        'qs_num' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'QS编号',
            'comment' => 'QS编号',
        ),
        'qs_time' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => 'QS有效期',
            'comment' => 'QS有效期',
        ),
        'qs_image' => array(
            'type' => 'char(32)',
            'default' => '',
            'label' => 'QS图片',
            'comment' => 'QS图片',
        ),
        
        'shanghai_unit' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '单位名称',
            'comment' => '单位名称',
        ),
        'shanghai_variety' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '品种',
            'comment' => '品种',
        ),
        'shanghai_time' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '品种',
            'comment' => '品种',
        ),
        'shanghai_image' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '进沪证图片',
            'comment' => '进沪证图片',
        ),
        
        'iso9001_num' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO9001证书编号',
            'comment' => 'ISO9001证书编号',
        ),
        'iso9001_norm' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO9001认证标准',
            'comment' => 'ISO9001认证标准',
        ),
        'iso9001_range' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO9001认证范围',
            'comment' => 'ISO9001认证范围',
        ),
        'iso9001_start' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO9001发证日期',
            'comment' => 'ISO9001发证日期',
        ),
        'iso9001_time' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => 'ISO9001有效期',
            'comment' => 'ISO9001有效期',
        ),
        'iso9001_perimission' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO9001认证机构',
            'comment' => 'ISO9001认证机构',
        ),
        'iso9001_image' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO9001认证图片',
            'comment' => 'ISO9001认证图片',
        ),
        
        'iso22000_num' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO22000证书编号',
            'comment' => 'ISO22000证书编号',
        ),
        'iso22000_norm' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO22000认证标准',
            'comment' => 'ISO22000认证标准',
        ),
        'iso22000_range' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO22000认证范围',
            'comment' => 'ISO22000认证范围',
        ),
        'iso22000_start' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO22000发证日期',
            'comment' => 'ISO22000发证日期',
        ),
        'iso22000_time' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => 'ISO22000有效期',
            'comment' => 'ISO22000有效期',
        ),
        'iso22000_perimission' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO22000认证机构',
            'comment' => 'ISO22000认证机构',
        ),
        'iso22000_image' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO22000认证图片',
            'comment' => 'ISO22000认证图片',
        ),
        
        'iso14001_num' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO14001证书编号',
            'comment' => 'ISO14001证书编号',
        ),
        'iso14001_norm' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO14001认证标准',
            'comment' => 'ISO14001认证标准',
        ),
        'iso14001_range' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO14001认证范围',
            'comment' => 'ISO14001认证范围',
        ),
        'iso14001_start' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO14001发证日期',
            'comment' => 'ISO14001发证日期',
        ),
        'iso14001_time' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => 'ISO14001有效期',
            'comment' => 'ISO14001有效期',
        ),
        'iso14001_perimission' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO14001认证机构',
            'comment' => 'ISO14001认证机构',
        ),
        'iso14001_image' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => 'ISO14001认证图片',
            'comment' => 'ISO14001认证图片',
        ),
        
        'halal_food_num' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '清真食品生产经营许可证编号',
            'comment' => '清真食品生产经营许可证编号',
        ),
        'halal_food_sn' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '清真许可商检证书号',
            'comment' => '清真许可商检证书号',
        ),
        'halal_food_time_begin' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '清真许可证签发日期',
            'comment' => '清真许可证签发日期',
        ),
        'halal_food_time_end' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '清真许可证截止日期',
            'comment' => '清真许可证截止日期',
        ),
        'halal_food_issue' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '清真许可证签发机构',
            'comment' => '清真许可证签发机构',
        ),
        'halal_food_image' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '清真许可证图片',
            'comment' => '清真许可证图片',
        ),
        
        'company_honor_time' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '企业荣誉发证日期',
            'comment' => '企业荣誉发证日期',
        ),
        'company_honor_image' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '企业荣誉图片',
            'comment' => '企业荣誉图片',
        ),
        
        'plant_money' => array(
            'type' => 'number',
            'required' => true,
            'label' => '厂区总资产',
            'comment' => '厂区总资产',
        ),
        'plant_floor_area' => array(
            'type' => 'number',
            'required' => true,
            'label' => '占地面积',
            'comment' => '占地面积',
        ),
        'plant_area' => array(
            'type' => 'number',
            'required' => true,
            'label' => '厂房面积',
            'comment' => '厂房面积',
        ),
        'plant_main_facility' => array(
            'type' => 'text',
            'required' => true,
            'label' => '主要设备',
            'comment' => '主要设备',
        ),
        'plant_design_produ' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '设计产能',
            'comment' => '设计产能',
        ),
        'plant_actual_produ' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '实际产能',
            'comment' => '实际产能',
        ),
        'plant_foreign_trade' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '外贸销售占比',
            'comment' => '外贸销售占比',
        ),
        'plant_foreign_selling' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'label' => '外贸销售占比',
            'comment' => '外贸销售占比',
        ),
        'plant_direct_selling' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '直销占比',
            'comment' => '直销占比',
        ),
        'plant_agent_selling' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '代理销售占比',
            'comment' => '代理销售占比',
        ),
        'plant_image' => array(
            'type' => 'char(32)',
            'required' => true,
            'label' => '厂区图片',
            'comment' => '厂区图片',
        ),
        
        'job_shop_name' => array(
            'type' => 'serialize',
            'required' => true,
            'label' => '车间名称',
            'comment' => '车间名称',
        ),
        'job_shop_produ' => array(
            'type' => 'serialize',
            'required' => true,
            'label' => '车间产品',
            'comment' => '车间产品',
        ),
        'job_shop_craft' => array(
            'type' => 'serialize',
            'required' => true,
            'label' => '车间工艺',
            'comment' => '车间工艺',
        ),
        'job_shop_image' => array(
            'type' => 'serialize',
            'required' => true,
            'label' => '车间照片',
            'comment' => '车间照片',
        ),
        
        'material_stock' => array(
            'type' => 'varchar(30)',
            'default' => '',
            'label' => '原料库存',
            'comment' => '原料库存',
        ),
        'made_up_stock' => array(
            'type' => 'varchar(30)',
            'required' => true,
            'label' => '成品库存',
            'comment' => '成品库存',
        ),
        'stock_image' => array(
            'type' => 'char(32)',
            'required' => true,
            'label' => '仓库照片',
            'comment' => '仓库照片',
        ),
        
        'lad_area' => array(
            'type' => 'number',
            'required' => true,
            'label' => '实验室面积',
            'comment' => '实验室面积',
        ),
        'lad_func' => array(
            'type' => 'text',
            'required' => true,
            'label' => '实验室功能',
            'comment' => '实验室功能',
        ),
        'lad_invest' => array(
            'type' => 'number',
            'required' => true,
            'label' => '实验室投资',
            'comment' => '实验室投资',
        ),
        'lad_people' => array(
            'type' => 'number',
            'required' => true,
            'label' => '实验室人员数量',
            'comment' => '实验室人员数量',
        ),
        'lad_image' => array(
            'type' => 'char(32)',
            'required' => true,
            'label' => '实验室图片',
            'comment' => '实验室图片',
        ),
        
        'test_facility' => array(
            'type' => 'serialize',
            'required' => true,
            'label' => '主要检测设备',
            'comment' => '主要检测设备',
        ),
        'test_purpose' => array(
            'type' => 'serialize',
            'required' => true,
            'label' => '检测设备主要用途',
            'comment' => '检测设备主要用途',
        ),
        'test_purpose' => array(
            'type' => 'serialize',
            'required' => true,
            'label' => '检测设备图片',
            'comment' => '检测设备图片',
        ),
        
        'qc_image' => array(
            'type' => 'char(32)',
            'required' => true,
            'label' => '品控组织架构图',
            'comment' => '品控组织架构图',
        ),
        'qa_image' => array(
            'type' => 'char(32)',
            'required' => true,
            'label' => '质量控制系统图',
            'comment' => '质量控制系统图',
        ),
        
        'company_people' => array(
            'type' => 'serialize',
            'required' => true,
            'label' => '公司组织架构信息',
            'comment' => '公司组织架构信息',
        ),
        
        'e_business_people' => array(
            'type' => 'serialize',
            'required' => true,
            'label' => '电商团队人员信息',
            'comment' => '电商团队人员信息',
        ),
        
        'brand_name' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '品牌名称',
            'comment' => '品牌名称',
        ),
        'brand_register_image' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '品牌图片',
            'comment' => '品牌图片',
        ),
        'brand_honor_num' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '品牌荣誉编号',
            'comment' => '品牌荣誉编号',
        ),
        'brand_honor_time' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '品牌荣誉发证日期',
            'comment' => '品牌荣誉发证日期',
        ),
        'brand_honor_unit' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '品牌荣誉发证机构',
            'comment' => '品牌荣誉发证机构',
        ),
        'brand_honor_image' => array(
            'type' => 'char(32)',
            'required' => true,
            'label' => '品牌荣誉图片',
            'comment' => '品牌荣誉图片',
        ),
        'pack_image' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '包装图片',
            'comment' => '包装图片',
        ),
        'no_pass' => array(
            'type' => 'text',
            'default' => '',
            'label' => '未通过原因',
            'comment' => '未通过原因'
        ),
        'createtime' => array(
            'type' => 'time',
            'required' => true,
            'label' => '创建时间',
            'comment' => '创建时间'
        ),
        /*共有字段 end */           
    ),
    'index' => array(
        'ind_seller' => array(
            'columns' => array(
                0 => 'seller_id',
            ),
            'prefix' => 'unique',
        ),
        'ind_createtime' => array(
            'columns' => array(
                0 => 'createtime',
            ),
        ),
        'ind_checkin' => array(
            'columns' => array(
                0 => 'checkin',
            ),
        ),
    ),
    'engine' => 'innodb',
    'comment' => '卖家入驻申请信息表',
);
