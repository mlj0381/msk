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



$db['company_extra'] = array(
    'columns' => array(
        'content_id' => array(
            'type' => 'number',
            'pkey' => true,
            'required' => true,
            'extra' => 'auto_increment',
            'label' => '序号',
            'comment' => '序号',
        ),
        'uid' => array(
            'type' => 'number',
            'label' => '所属人员',
            'required' => true,
            'comment' => '所属人员',
        ),
        'from' => array(
            'label' => ('所属'),
            'type' => array(
                0 => 'member',
                1 => 'seller'
            ),
            'default' => '0',
            'in_list' => true,
            'default_in_list' => false,
            'comment' => '所属',
        ),
        'key' => array(
            'type' => 'varchar(20)',
            'required' => true,
            'default' => '',
            'label' => '字段名',
            'comment' => '字段名',
        ),
        'value' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '属性值',
            'comment' => '属性值',
        ),
        'attach' => array(
            'type' => 'varchar(200)',
            'default' => '',
            'label' => '图片id',
            'comment' => '图片id',
        ),
    ),
);
