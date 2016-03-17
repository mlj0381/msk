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

/**
 * 接口请求基类
 */
class apicenter_api
{
    private $HOST = 'http://121.40.103.229:8080/';
    private $request;

    public function __construct()
    {
        header("Content-type:application/json;charset=utf-8");
        $this->request = vmc::singleton('base_httpclient');
    }

/**
 * 会员注册
 *
 * @param url string 接口地址
 * @param post_data array 请求参数
 * @return false | array
 */
    public function api_post($url,$post_data=array()){
        $post_url = $this->HOST.$url;
        $res = $this->request->post($post_url,$post_data);
        if($res){
            return json_decode($res,1);
        }else{
            return false;
        }
    }
}