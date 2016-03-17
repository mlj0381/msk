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

class apicenter_api
{
    private $host = 'http://121.40.103.229:8080/';
    private $request;

    public function __construct()
    {
        header("Content-type:application/json;charset=utf-8");
        $this->request = vmc::singleton('base_httpclient');
    }

    public function api_post($url,$post_data=array()){
        $post_url = $this->host.$url;
        $res = $this->request->post($post_url,$post_data);
        if($res){
            return json_decode($res,1);
        }else{
            return false;
        }
    }
}