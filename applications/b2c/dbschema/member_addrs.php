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


$db['member_addrs'] = array(
    'columns' => array(
        'addr_id' => array(
            'type' => 'int(10)',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',

            'comment' => ('会员收货地址ID') ,
        ) ,
        'member_id' => array(
            'type' => 'table:members',
            'default' => 0,
            'required' => true,
            'comment' => ('会员ID') ,
        ) ,
        'name' => array(
            'is_title' => true,
            'type' => 'varchar(50)',
            'required' => true,
            'comment' => ('收货人姓名') ,
        ) ,
        'area' => array(
            'type' => 'region',
            'required' => true,
            'comment' => ('收货人地区') ,
        ) ,
        'addr' => array(
            'type' => 'varchar(255)',
            'required' => true,
            'comment' => ('收货地址') ,
        ) ,
        'zip' => array(
            'type' => 'varchar(20)',

            'comment' => ('邮编') ,
        ) ,
        'tel' => array(
            'type' => 'varchar(50)',

            'comment' => ('电话') ,
        ) ,
        'mobile' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'comment' => ('手机') ,
        ) ,
        'email' => array(
            'type' => 'varchar(100)',

            'comment' => ('邮箱') ,
        ) ,
        
        'habit_normal_time' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '正常收货时间段',
            'comment' =>  '正常收货时间段',
        ),
        'habit_normal_first' => array(
            'type' => 'varchar(20)',
            'default' => '',
            'label' => '习惯最早收货时间',
            'comment' => '习惯最早收货时间'
        ),
        
        'habit_normal_last' => array(
            'type' => 'varchar(20)',
            'required' => true,
            'label' => '习惯最晚收货时间',
            'comment' => '习惯最晚收货时间'
        ),
        
        'cart_stop_distance' => array(
            'type' => 'varchar(20)',
            'required' => true,
            'label' => '最近停车距离',
            'comment' => '最近停车距离'
        ),
        'delivery_scale' => array(
            'type' => 'varchar(20)',
            'default' => '',
            'label' => '单次配送规模',
            'comment' => '单次配送规模'
        ),
        'day' => array(
            'type' => 'varchar(255)',
            'default' => ('任意日期') ,
            'comment' => ('上门日期') ,
        ) ,
        'time' => array(
            'type' => 'varchar(255)',
            'default' => ('任意时间段') ,
            'comment' => ('上门时间') ,
        ) ,
        'is_default' => array(
            'type' => array(
                'true' => ('是') ,
                'false' => ('否') ,
            ) ,
            'default' => 'false',
            'comment' => ('是否是默认地址') ,
        ) ,
        'updatetime'=>array(
            'type'=>'last_modify',
            'comment'=>'最后编辑时间'
        )
    ) ,
    'engine' => 'innodb',
    'comment' => ('收货地址表') ,
);
