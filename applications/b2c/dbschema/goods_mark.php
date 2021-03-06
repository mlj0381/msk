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

$db['goods_mark'] = array(
    'columns' => array(
        'mark_id' => array(
            'type' => 'number',
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => 'markID',
        ),
        'goods_id' => array(
            'type' => 'table:goods',
            'default' => 0,
            'label' => ('相关商品'),
        ),
        'store_id' => array(
            'type' => 'table:store@store',
            'label' => ('相关店铺'),
            'default' => 0,
            'comment' => ('相关店铺'),
        ),
        'mark_type' => array(
            'pkey' => true,
            'type' => array(
                'normal' => '综合',
            ),
            'default' => 'normal',
            'comment' => '评分类型',
        ),
        'mark_star' => array(
            'type' => array(
                '1' => '好评',
                '2' => '中评',
                '3' => '差评',
            ),
            'label' => ('评分'),
        ),
        'goods_grade' => array(
            'type' => 'decimal(2,1)',
            'label' => ('商品分数'),
        ),
        'serve_grade' => array(
            'type' => 'decimal(2,1)',
            'label' => ('服务分数'),
        ),
        'logistics_grade' => array(
            'type' => 'decimal(2,1)',
            'label' => ('物流分数'),
        ),
        'comment_id' => array(
            'type' => 'table:member_comment',
            'label' => ('相关评价'),
        )
    ),
    'engine' => 'innodb',
    'comment' => ('商品评分表'),
);
