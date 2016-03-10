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



$db['setting'] = array(
    'columns' =>
    array(
        'id' => array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => ('id'),
            'comment' => ('id'),
        ),
        'title' => array(
            'type' => 'varchar(100)',
            'label' => ('标题'),
            'comment' => ('标题'),
            'required' => true,
            'in_list' => true,
            'default_in_list' => true,
        ),
        'url' => array(
            'type' => 'varchar(100)',
            'label' => ('链接'),
            'comment' => ('链接'),
            'required' => true,
            'in_list' => true,
            'default_in_list' => true,
        ),
        'status' => array(
            'type' => 'bool',
            'label' => ('是否启用'),
            'comment' => ('是否启用'),
            'default' => 'true',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'ordernum' => array(
            'type' => 'number',
            'label' => ('排序'),
            'comment' => ('排序'),
            'default' => '0',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'setting_type' => array(
            'type' => array(
                '0' => ('热门关键词'),
                '1' => ('导航管理'),
            ),
            'label' => ('类型'),
            'comment' => ('类型'),
            'required' => true,
            'default' => '0',
            'in_list' => true,
            'default_in_list' => true,
        ),
        'createtime' => array(
            'type' => 'time',
            'label' => ('添加时间'),
            'comment' => ('添加时间'),
            'required' => true,
            'in_list' => true,
            'default_in_list' => true,
        ),
        'last_modify' => array(
            'type' => 'last_modify',
            'label' => ('更新时间') ,
            'filtertype' => 'yes',
            'in_list' => true,
            'orderby' => true,
        ) ,
    ),
    'comment' => ('商城设置表'),
);
