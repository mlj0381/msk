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
        'productCode' => array(
            'type' => 'char(9)',
            'request' => 'true',
            'label' => '货品id',
            'comment' => '货品id',
        ),
        'productName' => array(
            'type' => 'varchar(50)',
            'request' => 'true',
            'label' => '货品名称',
            'comment' => '货品名称',
        ),
        'classesCode' => array(
            'type' => 'char(2)',
            'request' => 'true',
            'label' => '类别id',
            'comment' => '类别id',
        ),
        'machiningCode' => array(
            'type' => 'char(1)',
            'request' => 'true',
            'label' => '二级分类id',
            'comment' => '二级分类id',
        ),
        'breedCode' => array(
            'type' => 'char(2)',
            'request' => 'true',
            'label' => '品种',
            'comment' => '品种',
        ),
        'featureCode' => array(
            'type' => 'char(2)',
            'request' => 'true',
            'label' => '特征',
            'comment' => '特征',
        ),
        'weightCode' => array(
            'type' => 'char(2)',
            'request' => 'true',
            'label' => '净重',
            'comment' => '净重',
        ),
        'pkgSpec' => array(
            'type' => 'varchar(20)',
            'request' => 'true',
            'label' => '包装名称',
            'comment' => '包装名称',
        ),
        'pkgCode' => array(
            'type' => 'char(3)',
            'request' => 'true',
            'label' => '包装id',
            'comment' => '包装id',
        ),
        'productSpec' => array(
            'type' => 'varchar(20)',
            'request' => 'true',
            'label' => '产品规格(产品特征名)',
            'comment' => '产品规格(产品特征名)',
        ),
        'netWeight' => array(
            'type' => 'varchar(20)',
            'request' => 'true',
            'label' => '净重',
            'comment' => '净重',
        ),
    ),
    'index' =>
        array(
            'ind_productCode' =>
                array(
                    'columns' =>
                        array(
                            0 => 'productCode',
                        ),
                ),

        ),
    'comment' => ('润和商品表'),
);