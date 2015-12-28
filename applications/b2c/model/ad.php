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



class b2c_mdl_ad extends dbeav_model{
    
    public function ad_shop(){
        return $this->getRow('*', array('page_id' => '楼层广告'));
    }
    
    public function option_ad($params){
        return $this->getRow('*', array('title' => $params['title'], 'position' => '顶部'));
    }
}

