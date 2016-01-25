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
    'coupon_code_encrypt_len' => array(
        'default' => 5,
    ),
    'coupon_code_count_len' => array(
        'default' => 5,
    ),
    'shop_logo' => array(
        'type' => 'image',
        'desc' => '商店LOGO',
    ),
    'base_site_params_separator' => array(
        'default' => '-',
    ),
    'base_site_page_cache' => array(
        'default' => 'true',
    ),
    'base_enable_site_uri_expanded' => array(
        'default' => 'true',
    ),
    'base_site_uri_expanded_name' => array(
        'default' => 'html',
    ),
    'base_check_uri_expanded_name' => array(
        'default' => 'true',
    ),
    'site_name' => array(
        'type' => 'text',
        'default' => 'YOUR SHOP NAME',
        'required' => true,
        'desc' => '网站名称',
    ),
    'page_default_title' => array(
        'type' => 'text',
        'default' => '',
        'desc' => '默认网站标题',
    ),
    'page_default_keywords' => array(
        'type' => 'text',
        'default' => '',
        'desc' => '默认网站关键字',
    ),
    'page_default_description' => array(
        'type' => 'textarea',
        'default' => '',
        'desc' => '默认网站简介',
    ),
//    'order_invoice' => array(
//        'type' => 'select',
//        'options' => array(
//            'false' => '不启用',
//            'true' => '启用',
//        ),
//        'default' => 'true',
//        'desc' => ('是否启用发票？'),
//    ) ,
//    'order_invoice_tax' => array(
//        'type' => 'text',
//        'default' => '0',
//        'desc' => ('发票税率'),
//    ) ,
    'score_convert' => array(
        'type' => 'text',
        'default' => '1',
        'desc' => '积分换算比例',
        'helpinfo' => '消费金额 x 积分换算比例=可得积分数'
    ),
    'member_avatar_max_size' => array(
        'type' => 'number',
        'default' => get_cfg_var('upload_max_filesize') ? intval(get_cfg_var('upload_max_filesize')) : '5',
        'desc' => '会员头像上传大小限制(单位：MB)',
        'helpinfo' => (get_cfg_var('upload_max_filesize') ? '<span class="text-danger">服务器当前限制' . get_cfg_var('upload_max_filesize') . '</span>' : '')
    ),
//    'member_signup_show_attr' => array(
//        'type' => 'select',
//        'default' => 'false',
//        'options' => array(
//                'true' => '展示',
//                'false' => '隐藏',
//        ),
//        'desc' => '是否在会员注册表单展示完整注册项？',
//    ),
    'order_autocancel_time' => array(
        'type' => 'number',
        'default' => 86400,
        'desc' => '订单自动关闭时间（单位：秒）',
        'helpinfo' => '非货到付款订单,未及时进行支付操作,系统将自动定时关闭'
    ),
    'order_autofinish_day' => array(
        'type' => 'number',
        'default' => 9,
        'desc' => '订单自动完成交易时间（单位：天）',
        'helpinfo' => '已发货订单,系统将在一定时间后自动完成交易'
    ),
    'comment_image_size' => array(
        'type' => 'number',
        'desc' => '评价时晒单附件上传限制(单位:MB)',
        'default' => get_cfg_var('upload_max_filesize') ? intval(get_cfg_var('upload_max_filesize')) : 2,
        'helpinfo' => (get_cfg_var('upload_max_filesize') ? '<span class="text-danger">服务器当前限制' . get_cfg_var('upload_max_filesize') . '</span>' : '')
    ),
    'main_products' => array(
        'default' => array(
            'use' => array( //使用方向
                array('id' => '1', 'label' => '菜场（含AK）'),
                array('id' => '2', 'label' => '团膳'),
                array('id' => '3', 'label' => '火锅'),
                array('id' => '4', 'label' => '中餐'),
                array('id' => '5', 'label' => '西餐'),
                array('id' => '6', 'label' => '烧烤'),
                array('id' => '7', 'label' => '加工厂'),
            ),
            'plant' => array( //经营场所
                array('id' => 1, 'label' => '批发市场'),
                array('id' => 2, 'label' => '菜场'),
            ),
            'member_cat' => array( //买家分类
                array('id' => 1, 'label' => '分销买家'),
                array('id' => 2, 'label' => '直销买家'),
            ),
//            1 => '卤味熟食',
//            2 => '猪产品',
//            3 => '牛羊产品',
//            4 => '海产品(含冷冻河产品)',
//            5 => '丸肠水发品',
//            6 => '腌腊产品',
//            7 => '冰品(指冰鲜产品)',
//            8 => '速冻点心与速冻蔬菜',
//            9 => '方便菜',
//            10 => '粮油产品',
//            11 => '调味品',
//            12 => '干货产品',
//            13 => '小菜(指腌菜、咸菜及其加工品)',
//            14 => '儿童食品(包括饼干、膨化食品等)',
//            15 => '调理水煮包与方便菜',
//            16 => '常规鸡鸭产品',
        ),
    ),
    'pages_plat_type' => array(
        'default' => array(
            0 => '商城',
            1 => '店铺'
        )
    ),
    'pages_position_types' => array(
        'default' => array(
            '0' => ('普通'),
            '1' => ('幻灯'),
            '2' => ('商品'),
        )
    ),
    'pages_content_types' => array(
        'default' => array(
            '0' => ('普通'),
            '1' => ('幻灯'),
            '2' => ('商品'),
        )
    ),
    'member_extra_column' => array(
        'default' => array(
            1 => array(
                'company_extra',
                'business_licence',
                'organization_licence',
                'tax_licence',
                'shop',
                'food_flow_licence',
                'contact_extra',
            ),
            2 => array('manageInfo'),
            3 => array('deliveryInfo'),
        )
    ),
    'serach' => array(
        'default' => array(
            'price' => array(
                1 => array('id' => 1, 'name' => '100以下', 'params' => array(0, 100)),
                2 => array('id' => 2, 'name' => '100 - 200', 'params' => array(100, 200)),
                3 => array('id' => 3, 'name' => '200 - 300', 'params' => array(200, 300)),
                4 => array('id' => 4, 'name' => '300 - 400', 'params' => array(300, 400)),
                5 => array('id' => 5, 'name' => '400 - 500', 'params' => array(400, 500)),
                6 => array('id' => 6, 'name' => '500 - 600', 'params' => array(500, 600)),
                7 => array('id' => 7, 'name' => '600 - 700', 'params' => array(600, 700)),
                8 => array('id' => 8, 'name' => '700以上', 'params' => array(700)),
            ),
//            'norms' => array(
//                array('id' => 1, 'name' => '规格1'),
//                array('id' => 1, 'name' => '规格2'),
//                array('id' => 1, 'name' => '规格3'),
//            ),
            'ability' => array(
                array('id' => 1, 'name' => '货源充足', 'params' => array(30)),//默认单位吨
                array('id' => 1, 'name' => '货源一般', 'params' => array(20, 30)),
                array('id' => 1, 'name' => '货源不足', 'params' => array(10)),
            ),
        ),
    ),
);
