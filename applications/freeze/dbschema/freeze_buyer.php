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


$db['freeze_buyer'] = array(
    'columns' => array(
        'freeze_id' => array(
            'type' => 'number',
            'pkey' => true,
            'label' => '冻结商家ID',
        ),
        'buyer_id' => array(
            'type' => 'number',
            'label' => ('买手账号id') ,
        ) ,
        'time' => array(
            'type' => time(),
            'label' => '时间',
        )

    ),
    'engine' => 'innodb',
    'comment' => '买手和冻结管家关联表',
);
