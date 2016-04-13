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
            'api_brand_id' =>
                array(
                    'type' => 'varchar(50)',
                    'default' => '',
                    'label' => ('润和品牌id'),
                    'comment' => ('润和品牌id'),
                    'in_list' => false,
                    'default_in_list' => false,
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
            'type' =>
                array(
                    'type' => 'number',
                    'label' => ('品牌类型'),
                    'default' => 0,
                    'comment' => ('品牌类型'),
                    'in_list' => true,
                    'default_in_list' => true,
                ),
            'company_id' =>
                array(
                    'type' => 'table:base@company',
                    'label' => ('所属公司'),
                    'default' => 0,
                    'comment' => ('所属公司'),
                    'in_list' => true,
                    'default_in_list' => true,
                ),
            'accredit' =>
                array(
                    'type' => 'char(32)',
                    'default' => '',
                    'comment' => ('品牌授权书'),
                    'label' => ('品牌授权书'),
                ),
            'brand_class' =>
                array(
                    'type' => 'number',
                    'default' => 1,
                    'comment' => ('品牌分类'),
                    'label' => ('品牌分类'), // 1 企业品牌  2 店铺品牌
                ),
            'agent_code' => array(
                'type' => 'char(32)',
                'default' => '',
                'comment' => ('rpc品牌授权码'),
                'label' => ('品牌授权码'),
            ),
            'agent_start' => array(
                'type' => 'char(32)',
                'default' => '',
                'comment' => ('rpc品牌授权开始时间'),
                'label' => ('品牌授权开始时间'),
            ),
            'agent_end' => array(
                'type' => 'char(32)',
                'default' => '',
                'comment' => ('rpc品牌授权结束时间'),
                'label' => ('品牌授权结束时间'),
            ),
            'type' =>
                array(
                    'type' => 'number',
                    'default' => 0,
                    'comment' => ('品牌类型'),
                    'label' => ('品牌类型'), // 1 自有  2 代理  4 OEM
                ),
            'company_id' =>
                array(
                    'type' => 'number',
                    'default' => 0,
                    'comment' => ('所属公司'),
                    'label' => ('所属公司'),
                ),
            'api_company_id' =>
                array(
                    'type' => 'number',
                    'default' => 0,
                    'comment' => ('润和公司id'),
                    'label' => ('润和公司id'),
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
            'ind_seller_id' =>
                array(
                    'columns' =>
                        array(
                            0 => 'seller_id',
                        ),
                ),
            'ind_brand_initial' =>
                array(
                    'columns' =>
                        array(
                            0 => 'seller_id',
                        ),
                ),
            'ind_company_id' =>
                array(
                    'columns' =>
                        array(
                            0 => 'seller_id',
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