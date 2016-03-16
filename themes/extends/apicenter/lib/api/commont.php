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

class apicenter_api_commont extends base_api
{
    public $req_params = array();

    public function __construct(&$app)
    {
        header("Content-type:text/html;charset=utf-8");
        $this->app = $app;
        $this->_request = vmc::singleton('base_component_request');
        $this->req_params = $this->_request->get_params(true);
    }


}