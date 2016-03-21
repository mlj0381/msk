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
 * 销售相关
 */
class apicenter_interaction_seller
{
    private $URL;
    private $request;
    public function __construct()
    {
        header("Content-type:text/html;charset=utf-8");
        $this->URL = 'msk-web/api/v1/ms/';
        $this->request = vmc::singleton('apicenter_api');
    }

    /**
     * 返回卖家所有的物流区产品表
     *
     * @return false | array
     */
    public function slBidLogiArea($post_data=array()){
        $post_url = $this->URL.'slBidLogiArea';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 根据增量时间戳取得卖家信息数据。
     *
     * @return false | array
     */
    public function slInfo($post_data=array()){
        $post_url = $this->URL.'slInfo';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 编辑一个卖家产品和标准质量标准数据。
     *
     * @return false | array
     */
    public function slQlt_newOrUpdate($post_data=array()){
        $post_url = $this->URL.'slQlt/newOrUpdate';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 查询一个卖家能销售的产品信息数据。
     *
     * @return false | array
     */
    public function slInfo_searchSlPd($post_data=array()){
        $post_url = $this->URL.'slInfo/searchSlPd';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 查询一个卖家物流区的产品信息数据。
     *
     * @return false | array
     */
    public function slLogiAreaPd($post_data=array()){
        $post_url = $this->URL.'slLogiAreaPd';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 查询证照基础信息	
     *
     * @return false | array
     */
    public function slInfo_slMstCertInfo_search($post_data=array()){
        $post_url = $this->URL.'slInfo/slMstCertInfo/search';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 增加生产商
     *
     * @return false | array
     */
    public function slInfo_slProducer_new($post_data=array()){
        $post_url = $this->URL.'slInfo/slProducer/new';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 增加企业产品品牌	
     *
     * @return false | array
     */
    public function slInfo_slEpBrandcTeam_new($post_data=array()){
        $post_url = $this->URL.'slInfo/slEpBrandcTeam/new';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 增加卖家产品品牌
     *
     * @return false | array
     */
    public function slInfo_slPdBrandcTeam_new($post_data=array()){
        $post_url = $this->URL.'slInfo/slPdBrandcTeam/new';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 查询卖家产品品牌
     *
     * @return false | array
     */
    public function slInfo_slPdBrandcTeam_search($post_data=array()){
        $post_url = $this->URL.'slInfo/slPdBrandcTeam/search';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 编辑一个卖家增加卖家信息All数据。
     *
     * @return false | array
     */
    public function slInfo_newOrUpdateAll($post_data=array()){
        $post_url = $this->URL.'slInfo/newOrUpdateAll';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 卖家申请新产品品种/特征/净重
     *
     * @return false | array
     */
    public function slInfo_slPd_newPdBFW($post_data=array()){
        $post_url = $this->URL.'slInfo/slPd/newPdBFW';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 卖家申请新产品包装
     *
     * @return false | array
     */
    public function slInfo_slPd_newPdPkg($post_data=array()){
        $post_url = $this->URL.'slInfo/slPd/newPdPkg';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 取得神农客卖家分销章程信息数据。
     *
     * @return false | array
     */
    public function chapInfo($post_data=array()){
        $post_url = $this->URL.'chapInfo';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 创建卖家对神农客卖家分销章程的意见。
     *
     * @return false | array
     */
    public function chapInfo_new($post_data=array()){
        $post_url = $this->URL.'chapInfo/new';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 更新卖家对神农客卖家分销章程的意见。
     *
     * @return false | array
     */
    public function chapInfo_update($post_data=array()){
        $post_url = $this->URL.'chapInfo/update';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 查询一个卖家账号数据。
     *
     * @return false | array
     */
    public function slInfo_slAccount_search($post_data=array()){
        $post_url = $this->URL.'slInfo/slAccount/search';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 删除卖家产品
     *
     * @return false | array
     */
    public function slInfo_slProduct_delete($post_data=array()){
        $post_url = $this->URL.'slInfo/slProduct/delete';
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

}