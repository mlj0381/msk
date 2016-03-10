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



$db['brand'] = array(
    'columns' =>
    array(
        'brand_id' =>
        array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => ('品牌id'),
            'comment' => ('品牌id'),
            'in_list' => false,
            'default_in_list' => false,
        ),
        'brand_name' =>
        array(
            'type' => 'varchar(50)',
            'label' => ('品牌名称'),
            'is_title' => true,
            'required' => true,
            'comment' => ('品牌名称'),
            'searchtype' => 'has',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'brand_initial' =>
        array(
            'type' => 'varchar(1)',
            'label' => ('拼音首字母'),
            'comment' => ('拼音首字母'),
            'default' => '',
            'searchtype' => 'has',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'brand_url' =>
        array(
            'type' => 'varchar(255)',
            'label' => ('品牌网址'),
            'default' => '',
            'comment' => ('品牌网址'),
            'in_list' => true,
            'default_in_list' => true,
        ),
        'brand_desc' =>
        array(
            'type' => 'longtext',
            'default' => '',
            'comment' => ('品牌介绍'),
            'label' => ('品牌介绍'),
        ),
        'accredit' =>
        array(
            'type' => 'char(32)',
            'default' => '',
            'comment' => ('品牌授权书'),
            'label' => ('品牌授权书'),
        ),
        'brand_logo' =>
        array(
            'type' => 'varchar(255)',
            'default' => '',
            'comment' => ('品牌图片标识'),
            'label' => ('品牌图片标识'),
        ),
        'brand_country' => array(
            'type' => 'table:country@ectools',
            'label' => ('品牌国家'),
            'in_list' => true,
        ),
        'brand_setting' =>
        array(
            'type' => 'serialize',
            'default' => '',
            'label' => ('品牌设置'),
            'deny_export' => true,
        ),
        'seller_id' => array(
            'type' => 'number',
            'required' => false,
            'default' => 0,
            'label' => '商家',
            'searchtype' => 'has',
            'in_list' => true,
            'default_in_list' => true,
            'order' => '1',
            'comment' => '商家',
        ),
        'disabled' =>
        array(
            'type' => 'bool',
            'default' => 'false',
            'comment' => ('失效'),
        ),
        'ordernum' =>
        array(
            'type' => 'number',
            'default' => 30,
            'label' => ('排名'),
            'comment' => ('排名'),
            'in_list' => true,
            'default_in_list' => true,
        ),
        'last_modify' =>
        array(
            'type' => 'last_modify',
            'label' => ('更新时间'),
            'width' => 110,
            'in_list' => true,
            'orderby' => true,
        ),
    ),
    'index' =>
    array(
        'ind_disabled' =>
        array(
            'columns' =>
            array(
                0 => 'disabled',
            ),
        ),
        'ind_ordernum' =>
        array(
            'columns' =>
            array(
                0 => 'ordernum',
            ),
        ),
    ),
    'comment' => ('品牌表'),
);