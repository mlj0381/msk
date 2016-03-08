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
                        'label' => '生产商企业电商团队',
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
                'companyType' => '工厂',
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
                        'label' => '生产商企业基本资质',
                        'page' => array(
                            'three_lesstion', 'business_licence', 'tax_licence', 'organization_licence', 'bank_lesstion',
                            'food_business_licence', 'food_flow_licence', 'agent_auth_lesstion')
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
            4 => array(
                'companyType' => 'OEM',
                'pageSet' => array(
                    1 => array(
                        'label' => '生产商企业基本资质',
                        'page' => array(
                            'three_lesstion', 'business_licence', 'tax_licence', 'organization_licence', 'bank_lesstion',
                            'food_business_licence', 'food_flow_licence', 'oem_auth_lesstion')
                    ),
//                    2 => array(
//                        'label' => '生产商企业专业资质',
//                        'page' => array(
//                            'animal_certificate', 'slaughter_lesstion', 'f_p_lesstion', 'n_p_lesstion', 'entry_lesstion', 'iso9001_lesstion',
//                            'iso22000_lesstion', 'iso14001_lesstion', 'food_mosque_lesstion',)
//                    ),
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
            'array_info' => array('equipment', 'ec_group_employees', 'company_touted', 'workshop'),
        ),
    ),
    'seller_group' => array(
        'default' => array(
            array(
                'title' => '公司资质审批',
                'setting' => array(
                    'label' => array('卖家资质审批', '被代理生产商资质审批', 'OEM生产商资质审批'),
                    'type' => array('1', '2', '4'),
                    'page' => array('1'),
                ),
            ),
            array(
                'title' => '公司基本信息提交',
                'setting' => array(
                    'label' => array('卖家基本信息提交', '被代理生产商基本信息提交', 'OEM生产商基本信息提交'),
                    'type' => array('1', '2', '4'),
                    'page' => array('2', '3', '4')
                ),
            ),
            array(
                'title' => '公司管理团队信息',
                'setting' => array(
                    'label' => array('卖家管理团队信息', '被代理生产商管理团队信息', 'OEM生产商管理团队信息'),
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
);
