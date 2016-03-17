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
        'age' => array(
            'type' => 'int(3)',
            'default' => 0,
            'label' => ('年龄') ,

            'in_list' => true,
            'default_in_list' => true,
        ) ,
        'education' => array(
            'type' => 'varchar(10)',
            
            'label' => ('学历') ,
            'in_list' => true,
            'default_in_list' => true,
        ) ,
        'ID' => array(
            'type' => 'char(18)',
            'default' => null,
            'label' => ('身份证') ,
            'in_list' => true,
            'default_in_list' => true,
        ) ,
        'ID_image' => array(
            'type' => 'char(32)',
            'default' => null,
            'label' => ('身份证图片') ,
            'in_list' => true,
        ) ,
        'area' => array(
            'label' => ('地区') ,
            'default' => null,
            'type' => 'region',
            'filtertype' => 'yes',
            'filterdefault' => 'true',
            'in_list' => true,
            'default_in_list' => false,
        ) ,
        'service' => array(
            'label' => ('服务承诺') ,
            'type' => 'varchar(255)',
            'filtertype' => 'yes',
            'filterdefault' => 'true',
            'in_list' => true,
            'default_in_list' => false,
        ) ,
        'experience' => array(
            'label' => ('工作经验') ,

            'type' => 'varchar(255)',
            'filtertype' => 'yes',
            'filterdefault' => 'true',
            'in_list' => true,
            'default_in_list' => false,
        ) ,
        'commitment' => array(
            'label' => ('个人工作经历') ,

            'type' => 'varchar(255)',
            'filtertype' => 'yes',
            'filterdefault' => 'true',
            'in_list' => true,
            'default_in_list' => false,
        ) ,
        'capacity' => array(
            'label' => ('工作能力及特长') ,

            'type' => 'varchar(255)',
            'filtertype' => 'yes',
            'filterdefault' => 'true',
            'in_list' => true,
            'default_in_list' => false,
        ) ,
        'certificate' => array(
            'label' => ('工作证明') ,
            'default' => null,
            'type' => 'char(32)',
            'filtertype' => 'yes',
            'filterdefault' => 'true',
            'in_list' => true,
            'default_in_list' => false,
        ) ,
        'updatetime' => array(
            'type' => 'time',
            'comment' => '最后更新时间',
        ),
    ),
    'engine' => 'innodb',
    'comment' => '冻结管家信息表',
);