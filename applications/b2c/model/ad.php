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
    
    public function ad_shop($params){
        return $this->getRow('*', array('page_id' => '楼层广告'));
    }
    
    public function option_ad($params){
        return $this->getRow('*', array('page_id' => $params['page'], 'ad_type' => $params['type'], 'position_id' => $params['position']));
    }
}

