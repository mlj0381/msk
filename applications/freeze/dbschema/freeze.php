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


$db['freeze'] = array(
    'columns' => array(
        'freeze_id' => array(
            'type' => 'number',
            'extra' => 'auto_increment',
            'pkey' => true,
            'comment' => '冻结商家ID',
        ),
        'buyer_id' => array(
            'type' => 'number',
            'label' => ('买手账号id') ,
        ) ,
        'code' => array(
            'type' => 'varchar(255)',
            'label' => ('润和返回的管家编码') ,
        ) ,
        'account' => array(
            'type' => 'varchar(255)',
            'label' => ('润和返回的管家账号') ,
        ) ,
        'head_image' => array(
            'type' => 'varchar(32)',
            'label' => ('头像'),
        ),
        'mobile' => array(
            'type' => 'varchar(50)',
            'label' => ('手机号码') ,

            'in_list' => true,
            'default_in_list' => true,
        ) ,
        'email' => array(
            'type' => 'varchar(50)',
            'label' => ('邮箱') ,

            'in_list' => true,
            'default_in_list' => true,
        ) ,
        'name' => array(
            'type' => 'varchar(50)',
            'label' => ('姓名') ,

            'searchtype' => 'has',
            'editable' => true,
            'filtertype' => 'normal',
            'filterdefault' => 'true',
            'in_list' => true,
            'is_title' => true,
            'default_in_list' => false,
        ) ,

        'sex' => array(
            'type' => array(
                0 => ('女') ,
                1 => ('男') ,
                2 => '-',
            ) ,
            'default' => 2,
            'required' => true,
            'label' => ('性别') ,
            'editable' => true,
            'filtertype' => 'yes',
            'in_list' => true,
            'default_in_list' => true,
        ) ,
//        'age' => array(
//            'type' => 'int(3)',
//            'default' => 0,
//            'label' => ('年龄') ,
//
//            'in_list' => true,
//            'default_in_list' => true,
//        ) ,
//        'education' => array(
//            'type' => array(
//                1 => ('博士'),
//                2 => ('硕士'),
//                3 => ('本科'),
//                4 => ('专科'),
//                5 => ('高中'),
//                6 => ('小学'),
//                7 => ('其他'),
//            ),
//            'label' => ('学历') ,
//            'in_list' => true,
//            'default_in_list' => true,
//        ) ,
        'ID' => array(
            'type' => 'char(18)',
            'default' => null,
            'label' => ('身份证') ,
            'in_list' => true,
            'default_in_list' => true,
        ) ,
        'ID_name' => array(
            'type' => 'varchar(50)',
            'label' => ('身份证名称') ,

            'searchtype' => 'has',
            'editable' => true,
            'filtertype' => 'normal',
            'filterdefault' => 'true',
            'in_list' => true,
            'is_title' => true,
            'default_in_list' => false,
        ) ,
        'ID_image' => array(
            'type' => 'char(32)',
            'default' => null,
            'label' => ('身份证图片') ,
            'in_list' => true,
        ) ,
        'area' => array(
            'label' => ('虚拟经营地址') ,
            'default' => null,
            'type' => 'region',
            'filtertype' => 'yes',
            'filterdefault' => 'true',
            'in_list' => true,
            'default_in_list' => false,
        ) ,
        'address' => array(
            'label' => ('虚拟经营地址详细地址') ,
            'default' => null,
            'type' => 'varchar(255)',
            'filtertype' => 'yes',
            'filterdefault' => 'true',
            'in_list' => true,
            'default_in_list' => false,
        ),
        'manage_area' => array(
            'label' => ('管理地区') ,
            'default' => null,
            'type' => 'region',
            'filtertype' => 'yes',
            'filterdefault' => 'true',
            'in_list' => true,
            'default_in_list' => false,
        ) ,
        'manage_address' => array(
            'label' => ('管理详细地址') ,
            'default' => null,
            'type' => 'varchar(255)',
            'filtertype' => 'yes',
            'filterdefault' => 'true',
            'in_list' => true,
            'default_in_list' => false,
        ),
        'QQ' => array(
            'label' => ('QQ') ,
            'default' => null,
            'type' => 'varchar(255)',
            'filtertype' => 'yes',
            'filterdefault' => 'true',
            'in_list' => true,
            'default_in_list' => false,
        ),
        'WeChat' => array(
            'label' => ('微信号') ,
            'default' => null,
            'type' => 'varchar(255)',
            'filtertype' => 'yes',
            'filterdefault' => 'true',
            'in_list' => true,
            'default_in_list' => false,
        ),
        'self_image' => array(
            'label' => ('一寸免冠照片') ,
            'default' => null,
            'type' => 'char(32)',
        ),
//        'service' => array(
//            'label' => ('服务承诺') ,
//            'type' => 'varchar(255)',
//            'filtertype' => 'yes',
//            'filterdefault' => 'true',
//            'in_list' => true,
//            'default_in_list' => false,
//        ) ,
//        'experience' => array(
//            'label' => ('工作经验') ,
//
//            'type' => array(
//                '1' => '1年以下',
//                '2' => '1~3年',
//                '3' => '5年以上'
//            ),
//            'filtertype' => 'yes',
//            'filterdefault' => 'true',
//            'in_list' => true,
//            'default_in_list' => false,
//        ) ,
//        'commitment' => array(
//            'label' => ('个人工作经历') ,
//
//            'type' => 'varchar(255)',
//            'filtertype' => 'yes',
//            'filterdefault' => 'true',
//            'in_list' => true,
//            'default_in_list' => false,
//        ) ,
//        'capacity' => array(
//            'label' => ('工作能力及特长') ,
//
//            'type' => 'varchar(255)',
//            'filtertype' => 'yes',
//            'filterdefault' => 'true',
//            'in_list' => true,
//            'default_in_list' => false,
//        ) ,
//        'certificate' => array(
//            'label' => ('工作证明') ,
//            'default' => null,
//            'type' => 'char(32)',
//            'filtertype' => 'yes',
//            'filterdefault' => 'true',
//            'in_list' => true,
//            'default_in_list' => false,
//        ) ,
        'updatetime' => array(
            'type' => 'time',
            'comment' => '最后更新时间',
        ),
    ),
    'engine' => 'innodb',
    'comment' => '冻结管家信息表',
);
