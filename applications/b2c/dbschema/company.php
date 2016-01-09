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


$db['company'] = array(
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
        'member_id' => array(
            'type' => 'table:members',
            'required' => true,
            'label' => ('所属会员'),
            'in_list' => true,
        ),
        /* 企业信息 begin */
        'company_name' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => ('企业名称'),
            'in_list' => true,
        ),
        'company_name' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => ('企业名称'),
            'in_list' => true,
        ),
        'area' => array(
            'type' => 'region',
            'required' => true,
            'label' => ('营业地区'),
            'in_list' => true,
        ),
        'addr' => array(
            'type' => 'varchar(100)',
            'required' => true,
            'label' => ('营业地址'),
            'in_list' => true,
        ),
        'company_phone' => array(
            'type' => 'number',
            'required' => true,
            'label' => ('营业电话'),
            'in_list' => true,
        ),
        'business_license_number' => array(
            'type' => 'varchar(200)',
            'label' => '营业执照注册号',
        ),
        'business_license_area' => array(
            'type' => 'region',
            'sdfpath' => 'contact/area',
            'default' => '',
            'label' => '营业注册地',
        ),
        'business_license_image' => array(
            'type' => 'varchar(32)',
            'default' => '',
            'label' => '营业执照图片',
        ),
        'web_url' => array(
            'type' => 'varchar(100)',
            'default' => '',
            'label' => '网站地址',
            'in_list' => true,
        ),
        'boss_name' => array(
            'type' => 'varchar(20)',
            'default' => '',
            'label' => '老板姓名',
            'in_list' => true,
        ),
        'boss_phone' => array(
            'type' => 'varchar(20)',
            'default' => '',
            'label' => '老板电话',
            'in_list' => true,
        ),
        'boss_qq' => array(
            'type' => 'varchar(20)',
            'default' => '',
            'label' => '老板QQ',
            'in_list' => true,
        ),
        'boss_wechat' => array(
            'type' => 'varchar(20)',
            'default' => '',
            'label' => '老板微信',
            'in_list' => true,
        ),
        /* 企业信息 end */
        /* 联系人信息 begin */
        'contacts_name' => array(
            'type' => 'varchar(20)',
            'required' => true,
            'label' => '紧急联系人姓名',
            'in_list' => true,
        ),
        'contacts_phone' => array(
            'type' => 'varchar(20)',
            'required' => true,
            'label' => '紧急联系人电话',
            'in_list' => true,
        ),
        'contacts_qq' => array(
            'type' => 'varchar(20)',
            'label' => '紧急联系人QQ',
            'in_list' => true,
        ),
        'contacts_wechat' => array(
            'type' => 'varchar(20)',
            'label' => '紧急联系人微信',
            'in_list' => true,
        ),
        /* 联系人信息 end */
        /* 经营信息 begin */
        'buy_cat' => array(
            'type' => array(
                'agent' => ('分销买家'),
                'market' => ('菜场买家'),
                'hot_pot' => ('火锅买家'),
                'chinese_food' => ('中餐买家'),
                'west_food' => ('西餐买家'),
                'snack' => ('小吃烧烤买家'),
                'plant' => ('加工厂买家'),
            ),
           // 'required' => true,
            'label' => ('买家分类'),
            'in_list' => true,
        ),
        'employ' => array(
            'type' => array(
                'market' => ('菜场'),
                'hot_pot' => ('火锅'),
                'chinese_food' => ('中餐'),
                'west_food' => ('西餐'),
                'snack' => ('小吃烧烤'),
                'plant' => ('加工厂'),
            ),
            //'required' => true,
            'label' => '使用方向',
            'in_list' => true,
        ),
        'main_products' => array(
            'type' => 'number',
            'label' => '主营品类',
            //'required' => true,
            'in_list' => true,
        ),
        'prop_products' => array(
            'type' => 'number',
            //'label' => '兼职品类',
            'required' => true,
            'in_list' => true,
        ),
        'saleroom' => array(
            'type' => 'number',
            'label' => ('日均营业额'),
            //'required' => true,
            'in_list' => true,
        ),
        'run_placr' => array(
            'type' => 'number',
            'label' => ('经营场所'),
            'in_list' => true,
        ),
        /* 经营信息 end */
        'checkin' => array(
            'type' => array(
                '0' => ('审核中'),
                '-1' => ('拒绝'),
                '1' => ('通过'),
            ),
            'label' => ('注册时间'),
            'in_list' => true,
        ),
        'createtime' => array(
            'type' => 'time',
            'label' => ('注册时间'),
            'in_list' => true,
        ),
    ),
    'index' => array(
        'ind_member' => array(
            'columns' => array(
                0 => 'member_id'
            ),
        ), 
        'ind_time' => array(
            'columns' => array(
                0 => 'createtime'
            ),
        ),
        'ind_check' => array(
            'columns' => array(
                0 => 'checkin'
            ),
        ),
    ),
    'engine' => 'innodb',
    'comment' => ('买家公司表'),
);

