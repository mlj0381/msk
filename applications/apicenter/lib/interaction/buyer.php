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
     * @param post_data array
     * @return false | array
     */
    public function account_register(&$post_data=array()){
        $action = array('ctl'=>'buyer','act'=>'account_register');
        $post_url = $this->URL.'account/register';
        $param = $this->request->dbdata($action,$post_data);
        if(is_array($param)){
            $data = $this->request->api_post($post_url,$post_data);
            return $data;
        }
        return false;
    }

    /**
     * 通过买家账号和密码或者手机号和密码登录登录成功，获得买家ID
     *
     * @param post_data array
     * @return false | array
     */
    public function account_login(&$post_data=array()){
        $action = array('ctl'=>'buyer','act'=>'account_login');
        $post_url = $this->URL.'account/login';
        $param = $this->request->dbdata($action,$post_data);
        if(is_array($param)){
            $data = $this->request->api_post($post_url,$post_data);
            return $data;
        }
        return false;
    }

    /**
     * 通过买家ID更新买家基本信息
     *
     * @param post_data array
     * @return false | array
     */
    public function buyerInfo_update(&$post_data=array()){
        $action = array('ctl'=>'buyer','act'=>'buyerInfo_update');
        $post_url = $this->URL.'buyerInfo/update';
        $param = $this->request->dbdata($action,$post_data);
        if(is_array($param)){
            $data = $this->request->api_post($post_url,$post_data);
            return $data;
        }
        return false;
    }

    /**
     * 通过买家ID更新买家经营产品类别
     *
     * @param post_data array
     * @return false | array
     */
    public function pdClassification_update(&$post_data=array()){
        $action = array('ctl'=>'buyer','act'=>'pdClassification_update');
        $post_url = $this->URL.'pdClassification/update';
        $param = $this->request->dbdata($action,$post_data);
        if(is_array($param)){
            $data = $this->request->api_post($post_url,$post_data);
            return $data;
        }
        return false;
    }

    /**
     * 通过买家ID更新买家销售对象
     *
     * @param post_data array
     * @return false | array
     */
    public function salesTarget_update(&$post_data=array()){
        $action = array('ctl'=>'buyer','act'=>'salesTarget_update');
        $post_url = $this->URL.'salesTarget/update';
        $param = $this->request->dbdata($action,$post_data);
        if(is_array($param)){
            $data = $this->request->api_post($post_url,$post_data);
            return $data;
        }
        return false;
    }

    /**
     * 通过买家ID更新证照信息
     *
     * @param post_data array
     * @return false | array
     */
    public function licence_update(&$post_data=array()){
        $action = array('ctl'=>'buyer','act'=>'licence_update');
        $post_url = $this->URL.'licence/update';
        $param = $this->request->dbdata($action,$post_data);
        if(is_array($param)){
            $data = $this->request->api_post($post_url,$post_data);
            return $data;
        }
        return false;
    }

    /**
     * 通过买家ID更新证照图片
     *
     * @param post_data array
     * @return false | array
     */
    public function pictures_update(&$post_data=array()){
        $action = array('ctl'=>'buyer','act'=>'pictures_update');
        $post_url = $this->URL.'pictures/update';
        $param = $this->request->dbdata($action,$post_data);
        if(is_array($param)){
            $data = $this->request->api_post($post_url,$post_data);
            return $data;
        }
        return false;
    }

    /**
     * 通过买家ID更新雇员信息
     *
     * @param post_data array
     * @return false | array
     */
    public function employee_update(&$post_data=array()){
        $action = array('ctl'=>'buyer','act'=>'employee_update');
        $post_url = $this->URL.'employee/update';
        $param = $this->request->dbdata($action,$post_data);
        if(is_array($param)){
            $data = $this->request->api_post($post_url,$post_data);
            return $data;
        }
        return false;
    }

    /**
     * 通过买家ID更新收货地址
     *
     * @param post_data array
     * @return false | array
     */
    public function receiveAddr_update(&$post_data=array()){
        $action = array('ctl'=>'buyer','act'=>'receiveAddr_update');
        $post_url = $this->URL.'receiveAddr/update';
        $param = $this->request->dbdata($action,$post_data);
        if(is_array($param)){
            $data = $this->request->api_post($post_url,$post_data);
            return $data;
        }
        return false;
    }

    /**
     * 通过买家ID更新收货时间
     *
     * @param post_data array
     * @return false | array
     */
    public function receiveTime_update(&$post_data=array()){
        $action = array('ctl'=>'buyer','act'=>'receiveTime_update');
        $post_url = $this->URL.'receiveTime/update';
        $param = $this->request->dbdata($action,$post_data);
        if(is_array($param)){
            $data = $this->request->api_post($post_url,$post_data);
            return $data;
        }
        return false;
    }

}