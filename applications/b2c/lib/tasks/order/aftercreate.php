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


class b2c_tasks_order_aftercreate extends base_task_abstract implements base_interface_task
{
    //订单创建成功时，相关处理业务
    public function exec($params = null)
    {
        $order_sdf = $params;
        $mdl_orders = app::get('b2c')->model('orders');
        $order_num = $mdl_orders->count(array(
            'member_id' => $order_sdf['member_id'],
        ));
        $mdl_members = app::get('b2c')->model('members');
        //更新会员订单数
        $mdl_members->update(array(
            'order_num' => $order_num,
        ), array(
            'member_id' => $order_sdf['member_id'],
        ));

        

        return true;
    }
}
