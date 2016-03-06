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



$db['warehouse'] = array(
    'columns' =>
    array(
        'id' =>
        array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => ('id'),
            'comment' => ('id'),
            'in_list' => false,
            'default_in_list' => false,
        ),
        'dlyplace_id' => array(
            'type' => 'table:dlyplace@b2c',
            'default' => 0,
            'commit' => '所属仓库id',
            'label' => '所属仓库id',
        ),
        'addr_id' => array(
            'type' => 'number',
            'default' => 0,
            'commit' => '覆盖地区ID',
            'label' => '覆盖地区ID',
        ),
        'addr' => array(
            'type' => 'varchar(30)',
            'default' => 0,
            'commit' => '覆盖地区',
            'label' => '覆盖地区',
        ),
		'title' => array(
            'type' => 'varchar(30)',
            'default' => '',
            'commit' => '覆盖地区名称',
            'label' => '覆盖地区名称',
        ),
        'disabled' =>
        array(
            'type' => 'bool',
            'default' => 'false',
            'comment' => ('失效'),
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
    'comment' => ('仓库地区覆盖表'),
);