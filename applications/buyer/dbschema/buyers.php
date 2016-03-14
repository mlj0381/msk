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

/*
 * 买手店信息表
 */
$db['buyers'] = array(
    'columns' => array(
        'buyer_id' => array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'comment' => '买手店ID',

        ),
        'local' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'default' => '',
            'comment' => '用户名',
        ),
        //'avatar' => array(),
        'mobile' => array(
            'type' => 'bigint unsigned',
            'required' => true,
            'default' => 0,
            'comment' => '买手店手机号',
        ),
        'email' => array(
            'type' => 'varchar(100)',
            'required' => true,
            'default' => '',
            'comment' => 'Email',
        ),
        'name' => array(
            'type' => 'varchar(50)',
            'required'	=> true,
            'default'	=> '',
            'comment'	=> '姓名',
        ),
        'sex' => array(
            'type' => array(
                0 => ('女') ,
                1 => ('男') ,
            ) ,
            'required'	=> true,
            'default'	=> 1,
            'comment'	=> '性别',
        ),
        'card_id' => array(
            'type' => 'char(18)',
            'required' => true,
            'default' => '',
            'comment' => '身份证ID',
        ),
        'buyer_type' => array(
            'type' => array(
                1 => ('自主创业型'),
                2 => ('批发型'),
                3 => ('有固定销售渠道型'),
                4 => ('配送型'),
            ) ,
            'required' => true,
            'default' => 1,
            'comment' => '买手类型',
        ),
        'area' => array(
            'type' => 'region',
            'required' => true,
            'default' => '',
            'comment' => '地区',
        ) ,
        'addr' => array(
            'type' => 'varchar(255)',
            'required' => true,
            'default' => '',
            'comment' => '详细地址',
        ),
        'photo' => array(
            'type' => 'char(32)',
            'required' => true,
            'default' => '',
            'comment' => '个人一寸照片',
        ),
        'wechat' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'default' => '',
            'comment' => '微信',
        ),
        'qq' => array(
            'type' => 'bigint unsigned',
            'required' => true,
            'default' => 0,
            'comment' => 'qq',
        ),
        'buyer_code' => array(
            'type' => 'char(16)',
            'required' => true,
            'default' => '',
            'comment' => '买手店编码',
        ),
        'store_name' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'default' => '',
            'comment' => '店铺名称',
        ),
        'store_logo' => array(
            'type' => 'char(32)',
            'required' => true,
            'default' => '',
            'comment' => '店铺logo',
        ),
        'operate_area' => array(
            'type' => 'region',
            'required' => true,
            'default' => '',
            'comment' => '经营区域',
        ),
        'operate_feature' => array(
            'type' => 'varchar(100)',
            'required' => true,
            'default' => '',
            'comment' => '经营特色',
        ),

        //姓名
        //性别
        //身份证号
        //买手类型
        //area_id
        //多少路多少号多少弄等等
        //照片image
        //微信账号
        //qq号
        //买手编码生成
//         店铺名称
//         店铺Logo
//         经营区域operate
//         经营特色feature
//         买手店编码(系统自动生成)

//         'addr' => array(
//             'type' => 'varchar(255)',
//             'label' => '地址',
//             'in_list' => true,
//             'default_in_list' => false,
//             'comment' => '地址',
//         ),

        'schedule' => array(
            'type' => array(
                1 => ('第一步注册完成'),
                2 => ('注册成功'),
            ) ,
            'required' => true,
            'default' => 1,
            'comment' => '注册进度',

        ),
        'reg_ip' => array(
            'type' => 'varchar(16)',
            'required' => true,
            'default' => 0,
            'comment' => '注册时IP地址',
        ),
        'regtime' => array(
            'type' => 'time',
            'required' => true,
            'default' => 0,
            'comment' => '注册时间',
        ),
        'login_count' => array(
            'type' => 'int(11)',
            'required' => true,
            'default' => 0,
            'comment' => '登录次数',
        ),
        'updatetime' => array(
            'type' => 'time',
            'required' => true,
            'default' => 0,
            'comment' => '修改时间',
        ),
        'checkin' => array(
            'type' => array(
                0 => ('待核'),
                1 => ('正常'),
                -1 => ('未通过'),
            ),
            'default' => 1,
        ),
        'disabled' => array(
            'type' => 'bool',
            'default' => 'false',
        ),
    ),
    'index' => array(
        'uni_mobile' => array(
            'columns' => array(
                0 => 'mobile',
            ),
            'prefix' => 'UNIQUE',
        ),
        'ind_local' => array(
            'columns' => array(
                0 => 'local',
            ),
        ),
        'ind_email' => array(
            'columns' => array(
                0 => 'email',
            ),
        ),
        'ind_card_id' => array(
            'columns' => array(
                0 => 'card_id',
            ),
        ),
    ),
    'comment' => '买手店表',
);
