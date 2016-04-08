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


$db['cat_aptitudes'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'number',
            'pkey' => true,
            'required' => true,
            'extra' => 'auto_increment',
            'label' => ('id'),
            'in_list' => true,
            'default_in_list' => true,
            'is_title' => true,
        ),
        'cat_id' => array(
            'type' => 'number',
            'required' => true,
            'label' => ('分类id'),
            'comment' => ('分类id'),
        ),
        'creature' => array(
            'type' => 'bool',
            'default' => 'false',
            'required' => true,
            'label' => ('动物防疫证'),
            'comment' => ('动物防疫证'),
        ),
        'food' => array(
            'type' => 'bool',
            'default' => 'false',
            'required' => true,
            'label' => ('食品生产许可证'),
            'comment' => ('食品生产许可证'),
        ),
        'butcher' => array(
            'type' => 'bool',
            'default' => 'false',
            'required' => true,
            'label' => ('屠宰证'),
            'comment' => ('屠宰证'),
        ),
        'muslim' => array(
            'type' => 'bool',
            'default' => 'false',
            'required' => true,
            'label' => ('清真证'),
            'comment' => ('清真证'),
        ),
        'shanghai' => array(
            'type' => 'bool',
            'default' => 'false',
            'required' => true,
            'label' => ('进泸证'),
            'comment' => ('进泸证'),
        ),
        'iso14001' => array(
            'type' => 'bool',
            'default' => 'false',
            'required' => true,
            'label' => ('iso14001'),
            'comment' => ('iso14001'),
        ),
        'iso22000' => array(
            'type' => 'bool',
            'default' => 'false',
            'required' => true,
            'label' => ('iso22000'),
            'comment' => ('iso22000'),
        ),
        'iso9001' => array(
            'type' => 'bool',
            'default' => 'false',
            'required' => true,
            'label' => ('iso9001'),
            'comment' => ('iso9001'),
        ),
        'time' => array(
            'type' => 'time',
            'label' => ('时间'),
        ),
    ),
    'index' => array(
        'ind_cat_id' => array(
            'columns' => array(
                0 => 'cat_id',
            ),
            'prefix' => 'UNIQUE',
        ),
    ),
    'engine' => 'innodb',
    'comment' => ('分类所需资质表'),
);
