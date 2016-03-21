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
     * 产品分类一览查询------------------IPD141101
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object           业务参数
     * @return  false | array
     */
    public function pd_classes($post_data=array()){
        $post_url = $this->URL.'pd_classes';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 产品二级分类查询------------------IPD141104
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object           业务参数
     * @param   classesCode   String      Y    一级分类编码
     * @return  false | array
     */
    public function pd_machining($post_data=array()){
        $post_url = $this->URL.'pd_machining';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 产品品种分类查询------------------IPD141128
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object           业务参数
     * @param   classesCode   String      Y    一级分类编码
     * @param   machiningCode   String    Y    二级分类编码
     * @return  false | array
     */
    public function pd_breed($post_data=array()){
        $post_url = $this->URL.'pd_breed';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 产品特征分类查询------------------IPD141129
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object           业务参数
     * @param   classesCode   String      Y    一级分类编码
     * @param   machiningCode   String    Y    二级分类编码
     * @param   breedCode   String    Y    品种编码
     * @return  false | array
     */
    public function pd_feature($post_data=array()){
        $post_url = $this->URL.'pd_feature';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 产品主码查询接口------------------IPD141105
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object           业务参数
     * @param   classesCode   String      N    类别编码：如果传值，则返回指定类别的产品主码，如果没有传值，则返回全部类别的产品主码
     * @param   codeLevel    Integer     Y     希望返回的编码等级:
    0:返回11位：国家编码2位+产品分类2位+二级分类1位+产品品种2位+产品特征2位+产品净重2位
    1：返回5位产品分类2位+二级分类1位+产品品种2位
    2：返回7位产品分类2位+二级分类1位+产品品种2位+产品特征2位
     * @return  false | array
     */
    public function pd_standard($post_data=array()){
        $post_url = $this->URL.'pd_standard';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 产品查询价盘------------------IPD141111
     * @param   siteCode      数字     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   Auth        文本 20    Y    分配给各个平台的身份识别码
     * @param   param
     * @param   classesCode   文本    Y    产品类别编码
     * @param   breedCode     文本    Y    产品种类编码
     * @param   featureCode   文本    Y   产品特征编码
     * @param   gradeCode     文本    Y   产品等级编码
     * @param   logiAreaCode  文本    Y   物流区编码
     * @return  false | array
     */
    public function pd_pricecycle($post_data=array()){
        $post_url = $this->URL.'pd_pricecycle';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 返回产品一级和二级分类信息------------------IPD141110
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @return  false | array
     */
    public function pdBidType($post_data=array()){
        $post_url = $this->URL.'pdBidType';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 返回物流区列表------------------IPD141114
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @return  false | array
     */
    public function logiArea($post_data=array()){
        $post_url = $this->URL.'logiArea';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 返回物流区对应产品一览信息------------------IPD141113
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @return  false | array
     */
    public function pdBidLogiArea($post_data=array()){
        $post_url = $this->URL.'pdBidLogiArea';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 返回产品规格等信息------------------IPD141115
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @return  false | array
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
     * （以上接口拆分为2个单独的接口）卫生指标获取接口------------------IPD141112
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object           业务参数
     * @param   classesCode   String      Y    类别编码
     * @param   machiningCode String      Y   二级分类编码
     * @param   breedCode     String      Y   品种编码
     * @param   featureCode   String      N   产品特征编码
     * @return  false | array
     */
    public function pd_sft_std($post_data=array()){
        $post_url = $this->URL.'pd_sft_std';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 质量指标获取接口------------------IPD141112
     * @param   siteCode      Integer     Y    例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object           业务参数
     * @param   classesCode   String      Y    类别编码
     * @param   machiningCode String      Y   二级分类编码
     * @param   breedCode     String      Y   品种编码
     * @param   featureCode   String      N   产品特征编码
     * @return  false | array
     */
    public function pd_tnc_std($post_data=array()){
        $post_url = $this->URL.'pd_tnc_std';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

}