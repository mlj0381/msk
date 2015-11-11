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
$db['aptitudes'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'number',
            'extra' => 'auto_increment',
            'pkey' => true,
            'label' => ('资质id'),
            'commit' => ('资质id'),
            'required' => true,
        ),
        'industry_licence_image' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => ('全国工业生产许可证'),
            'commit' => ('全国工业生产许可证'),
            'in_list' => true,
            'default_in_list' => true,
        ),
        'licence_region' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => ('生产许可证范围'),
            'commit' => ('生产许可证范围'),
            'in_list' => true,
            'default_in_list' => true,
        ),
        'test_report_image' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => ('第三方检测报告'),
            'commit' => ('第三方检测报告'),
            'in_list' => true,
            'default_in_list' => true,
        ),
        'butcher_report_image' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => ('屠宰许可证'),
            'commit' => ('屠宰许可证'),
            'in_list' => true,
            'default_in_list' => true,
        ),
        'beijing_image' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => ('进京许可证'),
            'commit' => ('进京许可证'),
            'in_list' => true,
            'default_in_list' => true,
        ),
        'shanghai_image' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => ('进沪许可证'),
            'commit' => ('进沪许可证'),
            'in_list' => true,
            'default_in_list' => true,
        ),
        'other_image' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => ('其它证件'),
            'commit' => ('其它证件'),
            'in_list' => true,
            'default_in_list' => true,
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
        'seller_id' => array(
            'type' => 'table:sellers',
            'extar' => 'auto_increment',
            'pkey' => true,
            'label' => ('商家id'),
            'commit' => ('商家id'),
            'required' => true,
        ),
    ),
    'engine' => 'innodb',
    'comment' => '资质证明表',
);
