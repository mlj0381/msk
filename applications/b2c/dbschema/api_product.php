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


$db['api_product'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => ('商品id'),
            'comment' => ('商品id'),
            'in_list' => false,
            'default_in_list' => false,
        ),
        'bn' => array(
            'type' => 'char(9)',
            'request' => 'true',
            'label' => '货品id',
            'comment' => '货品id',
        ),
        'name' => array(
            'type' => 'varchar(50)',
            'request' => 'true',
            'label' => '货品名称',
            'comment' => '货品名称',
        ),
        'cat_1' => array(
            'type' => 'char(2)',
            'request' => 'true',
            'label' => '类别id',
            'comment' => '类别id',
        ),
        'cat_2' => array(
            'type' => 'char(1)',
            'request' => 'true',
            'label' => '二级分类id',
            'comment' => '二级分类id',
        ),
        'breed_code' => array(
            'type' => 'char(2)',
            'request' => 'true',
            'label' => '品种',
            'comment' => '品种',
        ),
        'feature' => array(
            'type' => 'char(2)',
            'request' => 'true',
            'label' => '特征',
            'comment' => '特征',
        ),
        'weight' => array(
            'type' => 'char(2)',
            'request' => 'true',
            'label' => '净重',
            'comment' => '净重',
        ),
        'pkg_spec' => array(
            'type' => 'varchar(20)',
            'request' => 'true',
            'label' => '包装名称',
            'comment' => '包装名称',
        ),
        'pack' => array(
            'type' => 'char(3)',
            'request' => 'true',
            'label' => '包装id',
            'comment' => '包装id',
        ),
        'spec' => array(
            'type' => 'varchar(20)',
            'request' => 'true',
            'label' => '产品规格(产品特征名)',
            'comment' => '产品规格(产品特征名)',
        ),
        'net_weight' => array(
            'type' => 'varchar(20)',
            'request' => 'true',
            'label' => '净重',
            'comment' => '净重',
        ),
        'createtime' => array(
            'type' => 'time',
            'request' => 'true',
            'label' => '添加时间',
            'comment' => '添加时间',
        ),
    ),
    'index' =>
        array(
            'ind_bn' =>
                array(
                    'columns' =>
                        array(
                            0 => 'bn',
                        ),
                ),

        ),
    'comment' => ('润和商品表'),
);