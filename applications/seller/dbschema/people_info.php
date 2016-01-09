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

$db['people_info'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'comment' => 'id',
            'label' => '电商团队id'
        ),
        'name' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '人员姓名',
            'comment' => '人员姓名',
        ),
        'age' => array(
            'type' => 'number',
            'required' => true,
            'label' => '人员年龄',
            'comment' => '人员年龄',
        ),
        'culture' => array(
            'label' => ('文化程度'),
            'type' => array(
                1 => ('博士'),
                2 => ('硕士'),
                3 => ('本科'),
                4 => ('专科'),
                5 => ('高中'),
                6 => ('初中'),
                7 => ('小学'),
                8 => ('其它'),
            ),
            'required' => true,
            'comment' => '文化程度',
        ),
         
        'phone' => array(
            'type' => 'number',
            'required' => true,
            'label' => '联系电话',
            'comment' => '联系电话',
        ),
        'image' => array(
            'type' => 'char(32)',
            'required' => true,
            'label' => '人员照片',
            'comment' => '人员照片',
        ),
        'info_type' => array(
            'type' => array(
                'e_business' => '电商团队信息',
                'company' => '公司人员信息',
            ),
            'label' => '信息类型',
            'comment' => '信息类型',
            'default' => 'company',
            'required' => true,
        ),
        'seller_id' => array(
            'type' => 'number',
            'required' => true,
            'default' => 0,
            'label' => '商家',
            'searchtype' => 'has',
            'in_list' => true,
            'default_in_list' => true,
            'order' => '1',
            'comment' => '商家',
        ),
    )
);
