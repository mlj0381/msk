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


$db['member_survey'] = array(
    'columns' => array(
        'survey_id' => array(
            'type' => 'number',
            'extra' => 'auto_increment',
            'pkey' => true,
            'required' => true,
            'label' => '会员调研ID',
            'comment' => '会员调研ID',
        ),
        'manage_area' => array(
            'type' => 'number',
            'required' => true,
            'label' => '经营地面积',
            'comment' => '经营地面积',
        ),
        'staff_num' => array(
            'type' => 'number',
            'required' => true,
            'label' => '员工人数',
            'comment' => '员工人数',
        ),
        'store_mode' => array(
            'type' => 'serialize',
            'required' => true,
            'label' => '存放方式',
            'comment' => '存放方式',
        ),
        'store_capacity' => array(
            'type' => 'number',
            'required' => true,
            'label' => '存放能力',
            'comment' => '存放能力',
        ),
        'big_demand' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '需求量大品种',
            'comment' => '需求量大品种',
        ),
        'huge_demand' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '需求量较大品种',
            'comment' => '需求量较大品种',
        ),
        'facade_image' => array(
            'type' => 'char(32)',
            'required' => true,
            'label' => '门头照',
            'comment' => '门头照',
        ),
        'good_image' => array(
            'type' => 'char(32)',
            'required' => true,
            'label' => '产品照',
            'comment' => '产品照',
        ),
        'store_image' => array(
            'type' => 'char(32)',
            'required' => true,
            'label' => '冻品存放照',
            'comment' => '冻品存放照',
        ),
        'calling_card_image' => array(
            'type' => 'char(32)',
            'label' => '名片照',
            'comment' => '名片照',
        ),
        'bought_book' => array(
            'type' => 'char(32)',
            'label' => '进货单照片',
            'comment' => '进货单照片',
        ),
    ),
);

