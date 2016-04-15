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


class b2c_tasks_api_goods extends base_task_abstract implements base_interface_task
{
    //订单创建成功时，相关处理业务
    public function exec($params = null)
    {
        $apiProduct = app::get('b2c')->rpc('goods_info')->request(array(1));
        $mdlApiProduct = app::get('b2c')->model('api_product');
        $tmp = $mdlApiProduct->getList('bn');
        $self = Array();
        $api = Array();
        foreach($tmp as $value)
        {
            $self[] = $value['bn'];
        }
        foreach($apiProduct['result']['goods'] as $value)
        {
            $api[] = $value['bn'];
        }
        $selfProduct = array_diff($api, $self);
        foreach($apiProduct['result']['goods'] as $value)
        {
            if(in_array($value['bn'], $selfProduct)){
                $value['createtime'] = time();
                if(!$mdlApiProduct->save($value)){
                    return false;
                }
            }
        }
        return true;
    }
}
