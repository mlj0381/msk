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

class apicenter_entrance_buyer
{
    public function __construct(&$app)
    {
        header("Content-type:text/html;charset=utf-8");
    }

    public function a(){
        $url = 'msk-web/api/v1/pd/pdBidType';
        $data = array();
        $request = vmc::singleton('apicenter_api')->api_post($url,$data);
        $this->success($request);
    }
}