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
 * 买家相关
 */
class apicenter_interaction_buyer
{
    private $URL;
    private $request;
    public function __construct()
    {
        header("Content-type:text/html;charset=utf-8");
        $this->URL = 'msk-web/api/v1/by/';
        $this->request = vmc::singleton('apicenter_api');
    }

    /**
     * 根据买家账号名，密码以及手机号，注册买家
     *
     * @return false | array
     */
    public function account_register($post_data=array()){
        $post_url = $this->URL.'account/register';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 通过买家账号和密码或者手机号和密码登录登录成功，获得买家ID
     *
     * @return false | array
     */
    public function account_login($post_data=array()){
        $post_url = $this->URL.'account/login';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 通过买家ID更新买家基本信息
     *
     * @return false | array
     */
    public function buyerInfo_update($post_data=array()){
        $post_url = $this->URL.'buyerInfo/update';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 通过买家ID更新买家经营产品类别
     *
     * @return false | array
     */
    public function pdClassification_update($post_data=array()){
        $post_url = $this->URL.'pdClassification/update';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 通过买家ID更新买家销售对象
     *
     * @return false | array
     */
    public function salesTarget_update($post_data=array()){
        $post_url = $this->URL.'salesTarget/update';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 通过买家ID更新证照信息
     *
     * @return false | array
     */
    public function licence_update($post_data=array()){
        $post_url = $this->URL.'licence/update';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 通过买家ID更新证照图片
     *
     * @return false | array
     */
    public function pictures_update($post_data=array()){
        $post_url = $this->URL.'pictures/update';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 通过买家ID更新雇员信息
     *
     * @return false | array
     */
    public function employee_update($post_data=array()){
        $post_url = $this->URL.'employee/update';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 通过买家ID更新收货地址
     *
     * @return false | array
     */
    public function receiveAddr_update($post_data=array()){
        $post_url = $this->URL.'receiveAddr/update';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 通过买家ID更新收货时间
     *
     * @return false | array
     */
    public function receiveTime_update($post_data=array()){
        $post_url = $this->URL.'receiveTime/update';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

}