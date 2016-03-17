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
 * 产品相关
 */
class apicenter_interaction_product
{
    private $URL;
    private $request;
    public function __construct()
    {
        header("Content-type:text/html;charset=utf-8");
        $this->URL = 'msk-web/api/v1/pd/';
        $this->request = vmc::singleton('apicenter_api');
    }

    /**
     * 产品分类一览查询接口
     *
     * @return false | array
     */
    public function pd_classes($post_data=array()){
        $post_url = $this->URL.'pd_classes';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 产品二级分类查询															
     *
     * @return false | array
     */
    public function pd_machining($post_data=array()){
        $post_url = $this->URL.'pd_machining';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 产品品种分类查询															
     *
     * @return false | array
     */
    public function pd_breed($post_data=array()){
        $post_url = $this->URL.'pd_breed';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 产品特征分类查询															
     *
     * @return false | array
     */
    public function pd_feature($post_data=array()){
        $post_url = $this->URL.'pd_feature';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 产品主码查询接口															
     *
     * @return false | array
     */
    public function pd_standard($post_data=array()){
        $post_url = $this->URL.'pd_standard';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 产品查询价盘					
     *
     * @return false | array
     */
    public function pd_pricecycle($post_data=array()){
        $post_url = $this->URL.'pd_pricecycle';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 返回产品一级和二级分类信息															
     *
     * @return false | array
     */
    public function pdBidType($post_data=array()){
        $post_url = $this->URL.'pdBidType';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 返回物流区列表															
     *
     * @return false | array
     */
    public function logiArea($post_data=array()){
        $post_url = $this->URL.'logiArea';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 返回物流区对应产品一览信息															
     *
     * @return false | array
     */
    public function pdBidLogiArea($post_data=array()){
        $post_url = $this->URL.'pdBidLogiArea';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 返回产品规格等信息															
     *
     * @return false | array
     */
    public function pdBidInfo($post_data=array()){
        $post_url = $this->URL.'pdBidInfo';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 返回等级分类。具体产品的等级信息在系统一期无法获取（产品等级在线评定系统上线以后才能获取）
     *
     * @return false | array
     */
    public function pd_grade($post_data=array()){
        $post_url = $this->URL.'pd_grade';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 返回各个产品卫生质量标准档案卡的具体数值（非概要性说明文字）
     *
     * @return false | array
     */
    public function pdBidQltTnc($post_data=array()){//（本接口废弃）
        $post_url = $this->URL.'pdBidQltTnc';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * （以上接口拆分为2个单独的接口）卫生指标获取接口
     *
     * @return false | array
     */
    public function pd_sft_std($post_data=array()){
        $post_url = $this->URL.'pd_sft_std';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 质量指标获取接口
     *
     * @return false | array
     */
    public function pd_tnc_std($post_data=array()){
        $post_url = $this->URL.'pd_tnc_std';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

}