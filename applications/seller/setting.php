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
    'avatar_max_size' => array(
        'type' => 'number',
        'default' => get_cfg_var('upload_max_filesize') ? intval(get_cfg_var('upload_max_filesize')) : '5',
        'desc' => '头像上传大小限制(单位：MB)',
        'helpinfo' => (get_cfg_var('upload_max_filesize') ? '<span class="text-danger">服务器当前限制' . get_cfg_var('upload_max_filesize') . '</span>' : '')
    ),
    'seller_entry' => array(
        'default' => array(
            'comm' => array(
                'companyType' => '',
                'pageSet' => array(
                    1 => array(
                        'label' => '企业电商团队',
                        'page' => array(
                            'ec_group_manager', 'ec_group_employees')
                    ),
//                    2 =>array('label' => '生产商企业产品品牌',
//                        'page' => array(
//                            'brand_lesstion', 'packing', 'brand_touted'
//                        )
//                    ),
                    2 => array(
                        'label' => '店铺及产品信息',
                        'page' => array(
                            'store_info', 'store_principal', 'goods_info')
                    ),
                ),
            ),
            1 => array(
                'companyType' => '卖家',
                'pageSet' => array(
                    1 => array(
                        'label' => '生产商企业基本资质',
                        'page' => array(
                            'three_lesstion', 'business_licence', 'tax_licence', 'organization_licence', 'bank_lesstion',)
                    ),
                    2 => array(
                        'label' => '生产商企业基本生产能力',
                        'page' => array(
                            'company_touted', 'factory',)
                    ),
                    3 => array(
                        'label' => '生产商企业生产车间、设备、产品工艺流程',
                        'page' => array(
                            'workshop', 'storage',)
                    ),
                    4 => array(
                        'label' => '生产商企业实验室、检测设备及产品质量控制系统',
                        'page' => array(
                            'laboratory', 'equipment', 'qa_department', 'q_c_department')
                    ),
                    5 => array(
                        'label' => '生产商企业管理团队',
                        'page' => array(
                            'president', 'general_manager', 'vice_general_manager', 'sale_manager', 'qa_manager', 'finance_manager')
                    ),
                ),
            ),
            2 => array(
                'companyType' => '代理',
                'pageSet' => array(
                    1 => array(
                        'label' => '卖家企业基本资质',
                        'page' => array(
                            'three_lesstion', 'business_licence', 'tax_licence', 'organization_licence', 'bank_lesstion',
                            'food_flow_licence', 'agent_auth_lesstion', 'company_type')
                    ),
                    /*
                    2 => array(
                        'label' => '生产商企业基本资质',
                        'page' => array(
                            'three_lesstion', 'business_licence', 'tax_licence', 'organization_licence'
                            )
                    ),
                    3 => array(
                        'label' => '生产商企业基本生产能力',
                        'page' => array(
                            'company_touted', 'factory',)
                    ),
                    4 => array(
                        'label' => '生产商企业生产车间、设备、产品工艺流程',
                        'page' => array(
                            'workshop', 'storage',)
                    ),
                    5 => array(
                        'label' => '生产商企业实验室、检测设备及产品质量控制系统',
                        'page' => array(
                            'laboratory', 'equipment', 'qa_department', 'q_c_department')
                    ),
                    */
                    2 => array(
                        'label' => '卖家企业管理团队',
                        'page' => array(
                            'president', 'general_manager', 'vice_general_manager', 'sale_manager', 'qa_manager', 'finance_manager')
                    ),
                ),
            ),
            4 => array(
                'companyType' => 'OEM',
                'pageSet' => array(

                    1 => array(
                        'label' => 'OEM企业基本资质',
                        'page' => array(
                            'three_lesstion', 'business_licence', 'tax_licence', 'organization_licence', 'bank_lesstion',
                            'food_flow_licence', 'oem_auth_lesstion', 'company_type')
                    ),
                    /*1 => array(
                        'label' => 'OEM企业基本资质',
                        'page' => array(
                            'three_lesstion', 'business_licence', 'tax_licence', 'organization_licence'),
                    ),
//                    2 => array(
//                        'label' => '生产商企业专业资质',
//                        'page' => array(
//                            'animal_certificate', 'slaughter_lesstion', 'f_p_lesstion', 'n_p_lesstion', 'entry_lesstion', 'iso9001_lesstion',
//                            'iso22000_lesstion', 'iso14001_lesstion', 'food_mosque_lesstion',)
//                    ),*/
//                    2 => array(
//                        'label' => 'OEM企业基本生产能力',
//                        'page' => array(
//                            'company_touted', 'factory',)
//                    ),
//                    3 => array(
//                        'label' => 'OEM企业生产车间、设备、产品工艺流程',
//                        'page' => array(
//                            'workshop', 'storage',)
//                    ),
//                    4 => array(
//                        'label' => 'OEM企业实验室、检测设备及产品质量控制系统',
//                        'page' => array(
//                            'laboratory', 'equipment', 'qa_department', 'q_c_department')
//                    ),
                    2 => array(
                        'label' => 'OEM企业管理团队',
                        'page' => array(
                            'president', 'general_manager', 'vice_general_manager', 'sale_manager', 'qa_manager', 'finance_manager')
                    ),
                ),
            ),
            'array_info' => array('equipment', 'ec_group_employees', 'company_touted', 'workshop'),
        ),
    ),
    'seller_group' => array(
        'default' => array(
            array(
                'title' => '公司资质审批',
                'setting' => array(
                    'label' => array('卖家资质审批'),//, '被代理生产商资质审批', 'OEM生产商资质审批'
                    'type' => array('1', '2', '4'),
                    'page' => array('1'),
                ),
            ),
            array(
                'title' => '公司基本信息提交',
                'setting' => array(
                    'label' => array('卖家基本信息提交'),//, '被代理生产商基本信息提交', 'OEM生产商基本信息提交'
                    'type' => array('1', '2', '4'),
                    'page' => array('2', '3', '4')
                ),
            ),
            array(
                'title' => '公司管理团队信息',
                'setting' => array(
                    'label' => array('卖家管理团队信息'),//, '被代理生产商管理团队信息', 'OEM生产商管理团队信息'
                    'type' => array('1', '2', '4'),
                    'page' => array('5'),
                ),
            ),
            array(
                'title' => '公司电商团队信息',
                'setting' => array(
                    'label' => array('电商团队信息'),
                    'type' => array('comm'),
                    'page' => array('1'),
                ),
            ),
        ),
    ),
    'goods_setting' => array(
        'default' => array(
            'showcase' => array(
                array(
                    'id' => 1,
                    'name' => '主力产品',
                ),
                array(
                    'id' => 2,
                    'name' => '本月新品',
                ),
                array(
                    'id' => 3,
                    'name' => '特价专区',
                ),
                array(
                    'id' => 4,
                    'name' => '销售专区',
                ),
            ),
        ),
    ),
    'store_type' => array(
        'default' => array(
            1 => array(
                'id' => '1',
                'label' => '工厂店铺',
            ),
            2 => array(
                'id' => '2',
                'label' => '代理店铺',
            ),
            3 => array(
                'id' => '3',
                'label' => 'OEM店铺',
            ),
        ),
    ),
    'company_type' => array(
        'default' => array(
            1 => array('id' => '1', 'label' => '国营'),
            2 => array('id' => '2', 'label' => '私营'),
            3 => array('id' => '3', 'label' => '中外合资'),
            4 => array('id' => '4', 'label' => '外资'),
            5 => array('id' => '5', 'label' => '政府机关/事业单位'),
            6 => array('id' => '6', 'label' => '其他'),
        ),
    ),
    'education' => array(
        'default' => array(
            '1' => '博士',
            '2' => '硕士',
            '3' => '本科',
            '4' => '大专',
            '5' => '高中',
            '6' => '小学',
            '7' => '其他',
        ),
    ),
    'aptitudes' => array(
        'default' => array(
            'creature' => array( //动物防疫证
                'id' => 1,
                'label' => '动物条件合格证',
                'item' => array(
                    1 => '代码编号',
                    2 => '年检日期',
                ),
            ),
            'muslim' => array( //清真证
                'id' => 2,
                'label' => '清真食品生产经营许可证',
                'item' => array(
                    1 => '证书编号',
                    2 => '发证日期及有效期',
                    3 => '签发机构',
                ),
            ),

            'food' => array( //食品生产许可证
                'id' => 3,
                'label' => '食品生产许可证(副本)(全国工业产品生产许可证)',
                'item' => array(
                    1 => '证书编号',
                    2 => '有效期',
                ),
            ),
            'butcher' => array( //屠宰证
                'id' => 4,
                'label' => '生猪定点屠宰许可证',
                'item' => array(
                    1 => '定点屠宰代码',
                    2 => '批准号',
                ),
            ),
            'shanghai' => array( //进泸证
                'id' => 5,
                'label' => '进沪证',
                'item' => array(
                    1 => '单位名称',
                    2 => '品种',
                    3 => '登记日期',
                ),
            ),
            'iso14001' => array(  //iso14001
                'id' => 6,
                'label' => 'ISO4001环境管理体系领证证书',
                'item' => array(
                    1 => '注册号',
                    2 => '认证标准',
                    3 => '认证范围',
                    4 => '发证日期及有效期',
                    5 => '认证机构',
                ),
            ),
            'iso22000' => array( //iso22000
                'id' => 7,
                'label' => 'ISO22000食品安全管理体系认证证书',
                'item' => array(
                    1 => '证书编号',
                    2 => '认证标准',
                    3 => '认证范围',
                    4 => '发证日期及有效期',
                    5 => '认证机构',
                ),
            ),
            'iso9001' => array( //iso9001
                'id' => 8,
                'label' => 'ISO9001质量管理体系认证证书',
                'item' => array(
                    1 => '证书编号',
                    2 => '认证标准',
                    3 => '认证范围',
                    4 => '发证日期及有效期',
                    5 => '认证机构',
                ),
            ),
        ),
    )
);
