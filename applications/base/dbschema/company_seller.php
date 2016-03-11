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



$db['company_seller'] = array(
    'columns' => array(
        'cs_id' => array(
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
        //2016 2 29 11:23
        'identity' => array(
            'type' => 'number',
            'default' => 0,
            'comment' => '身份类型', //1 工厂 2 代理 4 OEM
            'label' => '身份类型',
        ),
        'company_id' => array(
            'type' => 'number',
            'default' => 0,
            'comment' => '所属公司',
            'label' => '所属公司',
        ),
        'company_name' => array(
            'type' => 'varchar(50)',
            'default' => '',
            'comment' => '公司名称',
            'label' => '公司名称',
        ),
        'createtime' => array(
            'type' => 'time',
            'label' => '创建时间',
            'comment' => '创建时间',
        ),
        'last_modify' => array(
            'type' => 'last_modify',
            'label' => '更新时间',
            'in_list' => true,
            'default_in_list' => true,
            'orderby' => true,
        ),
        //>>
    ),
    'index' => array(
        'idn_uid' => array(
            'columns' => array(
                0 => 'uid'
            ),
        ),
    ),
    'comment' => '商家公司表'
);
