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
                1 => array(
                    'food_business_licence', 'food_flow_licence', 'oem_auth_lesstion'
                ),
            ),
        ),
    ),
);
