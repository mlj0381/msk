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
                1 => array(
                    'label' => '生产商企业基本资质',
                    'page' => array(
                        'three_lesstion', 'business_licence', 'tax_licence', 'organization_licence', 'bank_lesstion',)
                ),
                2 => array(
                    'label' => '生产商企业专业资质',
                    'page' => array(
                        'animal_certificate', 'slaughter_lesstion', 'f_p_lesstion', 'n_p_lesstion', 'entry_lesstion', 'iso9001_lesstion',
                        'iso22000_lesstion', 'iso14001_lesstion', 'food_mosque_lesstion',)
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
                6 => array(
                    'label' => '生产商企业管理团队',
                    'page' => array(
                        'president', 'general_manager', 'vice_general_manager', 'sale_manager', 'qa_manager', 'finance_manager')
                ),
                7 => array(
                    'label' => '生产商企业电商团队',
                    'page' => array(
                        'ec_group_manager', 'ec_group_employees')
                ),
                8 => array(
                    'label' => '生产商企业产品品牌',
                    'page' => array(
                        'brand_lesstion', 'packing', 'brand_touted')
                ),
                9 => array(
                    'label' => '店铺及产品信息',
                    'page' => array(
                        'store_info', 'store_principal', 'goods_info')
                ),
            ),
            1 => array(),
            2 => array(
                1 => array(
                    'food_business_licence', 'food_flow_licence', 'agent_auth_lesstion'
                ),
            ),
            4 => array(
                1 => array(
                    'food_business_licence', 'food_flow_licence', 'oem_auth_lesstion'
                ),
            ),
            'array_info' => array('equipment', 'ec_group_employees'),
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
