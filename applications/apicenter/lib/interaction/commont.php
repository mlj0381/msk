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
 * 其他
 */
class apicenter_interaction_commont
{
    public $req_params = array();

    public function __construct(&$app)
    {
        header("Content-type:text/html;charset=utf-8");
        $this->app = $app;
        $this->_request = vmc::singleton('base_component_request');
        $this->req_params = $this->_request->get_params(true);
    }

    /**
     * 编辑冻品管家信息
     *
     * @return false | array
     */
    public function slSeller_newOrUpdate($post_data=array()){
        $post_url = '/api/<ver>/bs/slInfo/slSeller/newOrUpdate';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 编辑买手信息
     *
     * @return false | array
     */
    public function slAccount_newOrUpdate($post_data=array()){
        $post_url = '/api/<ver>/bs/slInfo/slAccount/newOrUpdate';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 编辑买手冻品管家的买家信息	
     *
     * @return false | array
     */
    public function slExclusive_newOrUpdate($post_data=array()){
        $post_url = '/api/<ver>/bs/slInfo/slExclusive/newOrUpdate';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 所有供应计划尚未入库的供应量获取
     *
     * @return false | array
     */
    public function undonum($post_data=array()){
        $post_url = '/api/<ver>/sc/undonum';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }


}