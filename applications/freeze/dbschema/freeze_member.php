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


$db['freeze_member'] = array(
    'columns' => array(

        'freeze_id' => array(
            'type' => 'number',
            'pkey' => true,
            'label' => '冻结商家ID',
        ),
        'member_id' => array(
            'pkey' => true,
            'type' => 'number',
            'label' => ('买家账号id') ,
        ) ,
        'status' => array(
            'type' => array(
                '0' => '申请绑定',
                '1' => '已绑定',
                '2' => '拒绝绑定',
                '3' => '已解除绑定',
            ),
            'label' => ('绑定状态'),
        ),
        'apply_type' => array(
            'type' => array(
                '0' => '买家',
                '1' => '冻品管家',
            ),
            'label' => ('申请方'),
        ),
        'time' => array(
            'type' => 'time',
            'label' => '时间',
        ),
        'updatetime' => array(
            'type' => 'time',
            'label' => '修改时间',
        )
    ),
    'engine' => 'innodb',
    'comment' => '买手和冻结管家关联表',
);
