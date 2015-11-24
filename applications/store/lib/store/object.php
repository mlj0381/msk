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

class store_store_object
{
    public function __construct(&$app)
    {
        $this->app = $app;
        $this->mStore = $this->app->model('store');
    }

    public function store_info($store_id, $colunms = '*'){
        if(!is_numeric($store_id)) return null;
    
        return $this->mStore->getRow($colunms, array('store_id' => $store_id));
    }
}
