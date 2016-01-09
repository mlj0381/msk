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

/**
 *  getConf 默认值.
 */
$setting = array(
<<<<<<< HEAD
	'avatar_max_size' => array(
		'type' => 'number',
		'default' => get_cfg_var('upload_max_filesize') ? intval(get_cfg_var('upload_max_filesize')) : '5',
		'desc' => '头像上传大小限制(单位：MB)',
		'helpinfo'=>(get_cfg_var('upload_max_filesize') ? '<span class="text-danger">服务器当前限制'.get_cfg_var('upload_max_filesize').'</span>' : '')
	),
	// 店铺模板设置
	'store_template' => array(
		'default' => array(
			'index' => array(
				'label' => '首页',
				'modules' => array(
					0 => array(
						'label' => '幻灯',
						'type' => 'slider',
						'size' => '1920,600',
						'limit'=> 4,
						'items' => array(),
					),
					1 => array(
						'label' => '新品推荐',
						'type' => 'goods',
						'size' => '1920,600',
						'limit'=> 8,
						'items' => array(),
					),
					2 => array(
						'label' => 'banner1',
						'type' => 'image',
						'size' => '1920,600',
						'limit'=> 1,
						'items' => array(),
					),
					3 => array(
						'label' => '热门推荐',
						'type' => 'goods',
						'size' => '1920,600',
						'limit'=> 8,
						'items' => array(),
					),
					4 => array(
						'label' => 'banner2',
						'type' => 'image',
						'size' => '1920,600',
						'limit'=> 1,
						'items' => array(),
					),
					5 => array(
						'label' => '店铺推荐',
						'type' => 'goods',
						'size' => '1920,600',
						'limit'=> 8,
						'items' => array(),
					),
				),
			),
			'list' => array(
				'label' => '列表页',
				'modules' => array(
					0 => array(
						'label' => '横幅',
						'type' => 'image',
						'size' => '1920,600',
						'limit'=> 4,
						'items' => array(),
					),
					1 => array(
						'label' => '新品推荐',
						'type' => 'goods',
						'size' => '1920,600',
						'limit'=> 8,
						'items' => array(),
					),
				),
			),
		),
	),


	'entered_column' => array(
		'default' => array(
			'business_licence' => '营业执照',	// 号、附件
			'organization_licence' => '组织机构代码证', // 号、附件
			'tax_licence' => '税务登记证',	// 号、附件
			'three_lesstion' => '三证合一',	// 号、附件
			'bank_lesstion' => '银行开户许可证', // 法人代表、开户行、对公账号、附件
			
			// 代理
			'food_business_licence' => '食品经营许可证',	// 号、有效期、附件
			'food_flow_licence' => '食品流通许可证', // 编号,有效期,附件
			'agent_auth_lesstion' => '代理及分销授权书', // 授权单位,授权期限,附件
			
			'oem_auth_lesstion' => 'OEM委托授权书', // 委托单位,被委托单位,附件
			
			// 生产类
			'animal_certificate' => '动物防疫条件合格证',// 编号,年检日期,附件
			'slaughter_lesstion' => '生猪定点屠宰许可证', // 代码,批准号,附件
			'food_produce_lesstion' => '食品生产许可证', // 证书编号 有效期,附件
			'national_produce_lesstion' => '全国工业产品生产许可证', // 证书编号 有效期,附件,
			'entry_lesstion' => '进沪证',// 单位,品种,登记日期,附件

			// iso
			'iso9001_lesstion' => 'ISO9001质量管理体系认证证书', // 编号,认证标准,认证范围,日期,有效期,认证机构,附件
			'iso22000_lesstion' => 'ISO22000食品安全管理体系认证证书', // 编号,认证标准,认证范围,日期,有效期,认证机构,附件
			'iso14001_lesstion' => 'ISO14001环境管理体系认证证书', // 编号,认证标准,认证范围,日期,有效期,认证机构,附件,
			'food_mosque_lesstion' => '清真食品生产经营许可证', // 编号,证书号码,日期,机构

			//电商团队
			'ec_group_manager'	=> '电商团队负责人', // 姓名、年龄、文化程度、联系方式
			'ec_group_employees'=> '电商团队成员', // 姓名、年龄、文化程度、联系方式

			'company_touted' => '企业荣誉', // 发证日期,附近
			'factory' => '厂区平面', // 总资产,占地面积,主要设备,设计产能,实际产能,外贸销售占比,代理销售占比

			'workshop' => '车间',// 车间名称,生产产品,工艺流程
			'storage' => '库容概括', // 原料库容,成品库容
			'laboratory' => '实验室', // 面积,功能,投资,人员
			'equipment ' => '检测设备', // 用途
			'qa_department' => '品控组织架构', // 附件
			'quality_control_department' => '质量控制系统', // 附件
			
			//
			'president' => '公司董事长', // 姓名,年龄,文化程度,联系方式
			'general_manager' => '公司总经理', // 姓名,年龄,文化程度,联系方式
			'vice_general_manager' => '公司副总经理', // 姓名,年龄,文化程度,联系方式
			'sale_manager' => '销售部经理', // 姓名,年龄,文化程度,联系方式
			'qa_manager' => '品控部经理', // 姓名,年龄,文化程度,联系方式
			'finance_manager' => '财务部经理', // 姓名,年龄,文化程度,联系方式

			'brand_lesstion' => '品牌证书', // 品牌名称 商标注册证,附件
			'packing' => '包装照片', // 附件
			'brand_touted' => '品牌荣誉', // 证书编号,发证日期,发证单位
		),
	),
=======
    'avatar_max_size' => array(
        'type' => 'number',
        'default' => get_cfg_var('upload_max_filesize') ? intval(get_cfg_var('upload_max_filesize')) : '5',
        'desc' => '头像上传大小限制(单位：MB)',
        'helpinfo' => (get_cfg_var('upload_max_filesize') ? '<span class="text-danger">服务器当前限制' . get_cfg_var('upload_max_filesize') . '</span>' : '')
    ),
    'seller_entry' => array(
        'default' => array(
            'comm' => array(
                1 => array(
                    'three_lesstion', 'business_licence', 'tax_licence', 'organization_licence', 'bank_lesstion',
                ),
                2 => array('animal_certificate', 'slaughter_lesstion', 'food_produce_lesstion', 'national_produce_lesstion', 'entry_lesstion', 'iso9001_lesstion', 'iso22000_lesstion', 'iso14001_lesstion', 'food_mosque_lesstion',
                ),
                3 => array(
                    'company_touted', 'factory',
                ),
                4 => array(
                    'workshop', 'storage',
                ),
                5 => array(
                    'laboratory', 'equipment', 'qa_department', 'quality_control_department'
                ),
                6 => array(
                    'president', 'general_manager', 'vice_general_manager', 'sale_manager', 'qa_manager', 'finance_manager'
                ),
                7 => array(
                    'ec_group_manager', 'ec_group_employees'
                ),
                8 => array(
                    'brand_lesstion', 'packing', 'brand_touted'
                ),
            ),
            1 => array(
                1 => array(),
            ),
            2 => array(
                1 => array(
                    'food_business_licence', 'food_flow_licence', 'agent_auth_lesstion'
                ),
            ),
            4 => array(
                2 => array(
                    'food_business_licence', 'food_flow_licence', 'oem_auth_lesstion'
                ),
            ),
        ),
    ),
>>>>>>> 42cf6fac974adf37ee65c30556888a7875d0c18a
);
