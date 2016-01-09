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
        'identity' => array(
            'type' => array(
                'member' => ('会员'),
                'member' => ('商家'),
            ),
            'label' => '所属类型',
            'required' => true,
            'comment' => '所属类型',
        ),
        'key' => array(
            'type' => 'varchar(20)',
            'required' => true,
            'label' => '字段名',
            'comment' => '字段名',
        ),
        'value' => array(
            'type' => 'serialize',
            'required' => true,
            'label' => '属性值',
            'comment' => '属性值',
        ),
        'attach' => array(
            'type' => 'char(32)',
            'default' => '',
            'label' => '图片id',
            'comment' => '图片id',
        ),
    ),
);
