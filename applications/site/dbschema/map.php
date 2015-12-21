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



$db['map'] = array(
    'columns' =>
    array(
        'id' => array(
            'type' => 'number',
            'label' => '地图id',
            'comment' => '地图id',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'title' => array(
            'type' => 'varchar(50)',
            'in_list' => true,
            'default_in_list' => true,
            'label' => '标题',
            'comment' => '标题',
        ),
        'url' => array(
            'type' => 'varchar(50)',
            'in_list' => true,
            'default_in_list' => true,
            'label' => '链接',
            'comment' => '链接',
        ),
        'status' => array(
            'type' => ('bool'),
            'required' => true,
            'default' => true,
            'in_list' => true,
            'default_in_list' => true,
            'label' => '是否启用',
            'comment' => '是否启用',
        ),
        'createtime' => array(
            'type' => 'time',
            'comment' => '更新时间',
        ),
    ),
    'comment' => ('站点地图表'),
);
