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


class b2c_mdl_setting extends dbeav_model
{
    public function get_nav(){
        $nav = $this->getList('*', array('status' => 'true', 'setting_type' => '1'));
        $tmp = array();
        foreach($nav as $value){
            $tmp[] = $value['ordernum'];
        }
        array_multisort($tmp, SORT_ASC, $nav);
        return $nav;
    }
    
}
