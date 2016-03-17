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


$db['interval'] = array(
    'columns' =>
        array(
            'id' =>
                array(
                    'type' => 'number',
                    'required' => true,
                    'pkey' => true,
                    'extra' => 'auto_increment',
                    'label' => ('价盘id'),
                    'comment' => ('品牌id'),
                    'in_list' => false,
                    'default_in_list' => false,
                ),
            'product_id' =>
                array(
                    'type' => 'number',
                    'label' => ('货品id'),
                    'is_title' => true,
                    'required' => true,
                    'default' => 0,
                    'comment' => ('货品id'),
                ),
            'num_dn' =>
                array(
                    'type' => 'number',
                    'label' => ('数量下限'),
                    'comment' => ('数量下限'),
                    'required' => true,
                    'default' => 0,
                ),
            'num_up' =>
                array(
                    'type' => 'number',
                    'label' => ('数量上限'),
                    'comment' => ('数量上限'),
                    'required' => true,
                    'default' => 0,
                ),
            'price' => array(
                'type' => 'money',
                'default' => '0',
                'required' => true,
                'label' => ('价格'),
                'in_list' => true,
            ) ,
            'discount' =>
                array(
                    'type' => 'tinyint(2)',
                    'label' => ('折扣率'),
                    'comment' => ('折扣率'),
                    'default' => 100,
                ),
            'createtime' =>
                array(
                    'type' => 'time',
                    'label' => ('创建时间'),
                    'comment' => ('创建时间'),
                ),
            'last_modify' =>
                array(
                    'type' => 'last_modify',
                    'label' => ('更新时间'),
                    'width' => 110,
                    'in_list' => true,
                    'orderby' => true,
                ),
        ),
    'index' =>
        array(
            'ind_product_id' =>
                array(
                    'columns' =>
                        array(
                            0 => 'product_id',
                        ),
                ),
        ),
    'comment' => ('货品价盘表'),
);