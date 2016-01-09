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
$db['credential'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'number',
            'extra' => 'auto_increment',
            'pkey' => true,
            'required' => true,
            'label' => '证书id',
            'comment' => '证书id',
        ),
        'name' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '证书名称',
            'comment' => '证书名称',
        ),
        'seller_id' => array(
            'type' => 'number',
            'required' => true,
            'label' => '所属商家',
            'comment' => '所属商家',
        ),
        'extra' => array(
            'type' => 'serialize',
            'required' => true,
            'label' => '证书信息',
            'comment' => '证书信息',
        ),
        'createtime' => array(
            'type' => 'time',
            'required' => true,
            'label' => '创建时间',
            'comment' => '创建时间',
        ),
        'last_modify' => array(
            'type' => 'last_modify',
            'label' => ('修改时间') ,
            'filtertype' => 'yes',
            'in_list' => true,
            'orderby' => true,
        ) ,
    ),
);

