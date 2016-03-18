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


$db['order_concern'] = array(
    'columns' =>
        array(
            'id' =>
                array(
                    'type' => 'number',
                    'required' => true,
                    'pkey' => true,
                    'extra' => 'auto_increment',
                    'label' => ('订单关联id'),
                    'comment' => ('订单关联id'),
                ),
            'order_id' => array(
                'type' => 'table:orders',
                'required' => true,
                'label' => '订单id',
                'comment' => '订单id',
            ),
            'identity_from' => array(
                'type' => array(
                    '0' => 'seller',
                    '1' => 'buyer'
                ),
                'required' => true,
                'default' => '0',
                'label' => '卖家类型' //0 商家 1 买手
            ),
            'seller_id' => array(
                'type' => 'number',
                'required' => true,
                'default' => 0,
                'label' => '卖家id',
                'comment' => '卖家id',
            ),
            'identity_to' => array(
                'type' => array(
                    '0' => 'member',
                    '1' => 'buyer'
                ),
                'required' => true,
                'default' => '0',
                'label' => '买家类型', //0 会员 1 买手
                'comment' => '买家类型' //0 会员 1 买手
            ),
            'buyer_id' => array(
                'type' => 'number',
                'required' => true,
                'default' => 0,
                'label' => '买家id',
                'comment' => '买家id',
            ),
            'createtime' => array(
                'type' => 'time',
                'required' => true,
                'label' => '创建时间',
                'comment' => '创建时间',
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
            'ind_order_id' =>
                array(
                    'columns' =>
                        array(
                            0 => 'order_id',
                        ),
                    'prefix' => 'UNIQUE'
                ),
            'ind_identity_from' =>
                array(
                    'columns' =>
                        array(
                            0 => 'identity_from',
                        ),
                ),
            'ind_seller_id' =>
                array(
                    'columns' =>
                        array(
                            0 => 'seller_id',
                        ),
                ),
            'ind_identity_to' =>
                array(
                    'columns' =>
                        array(
                            0 => 'identity_to',
                        ),
                ),
            'ind_buyer_id' =>
                array(
                    'columns' =>
                        array(
                            0 => 'buyer_id',
                        ),
                ),
            'ind_createtime' =>
                array(
                    'columns' =>
                        array(
                            0 => 'createtime',
                        ),
                ),
        ),

    'comment' => ('订单关联表'),
);