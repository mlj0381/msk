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
 * 订单相关
 */
class apicenter_interaction_order
{
    private $URL;
    private $request;

    public function __construct()
    {
        header("Content-type:text/html;charset=utf-8");
        $this->URL = 'msk-web/api/v1/so/';
        $this->request = vmc::singleton('apicenter_api');
    }

    /**
     * 获取供应商库存
     */
    public function supplierstock_list($post_data = array())
    {
        $post_url = $this->URL . 'supplierstock/list';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 创建购买需求订单
     */
    public function pro_new($post_data = array())
    {
        $post_url = $this->URL . 'pro/new';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 创建标准分销订单
     */
    public function sdo_new($post_data = array())
    {
        $post_url = $this->URL . 'sdo/new';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 查询标准分销订单列表
     */
    public function sdo_list($post_data = array())
    {
        $post_url = $this->URL . 'sdo/list';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 查询标准分销订单详细
     */
    public function sdo_detail($post_data = array())
    {
        $post_url = $this->URL . 'sdo/detail';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 部分取消标准分销订单
     */
    public function sdo_cancelpart($post_data = array())
    {
        $post_url = $this->URL . 'sdo/cancelpart';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 整单取消标准分销订单
     */
    public function sdo_cancel($post_data = array())
    {
        $post_url = $this->URL . 'sdo/cancel';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 修改标准分销订单状态
     */
    public function sdo_update($post_data = array())
    {
        $post_url = $this->URL . 'sdo/update';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 创建退货单
     */
    public function sro_new($post_data = array())
    {
        $post_url = $this->URL . 'sro/new';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 查询退货单
     */
    public function sro_list($post_data = array())
    {
        $post_url = $this->URL . 'sro/list';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 取消标准分销退货单
     */
    public function sro_cancel($post_data = array())
    {
        $post_url = $this->URL . 'sro/cancel';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 修改退货单状态
     */
    public function sro_update($post_data = array())
    {
        $post_url = $this->URL . 'sro/update';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 删除/恢复订单
     */
    public function sdo_delete($post_data = array())
    {
        $post_url = $this->URL . 'sdo/delete';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 修改标准分销订单
     */
    public function sdo_edit($post_data = array())
    {
        $post_url = $this->URL . 'sdo/edit';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 创建订单
     */
    public function sdo_buyer_create($post_data = array())
    {
        $post_url = $this->URL . 'sdo/buyer/create';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 修改订单
     */
    public function sdo_cancels($post_data = array())
    {
        $post_url = $this->URL . 'sdo/cancel';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 查询订单详细
     */
    public function sdo_lists($post_data = array())
    {
        $post_url = $this->URL . 'sdo/list';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 订单统计
     */
    public function sdo_distribution_statistics($post_data = array())
    {
        $post_url = $this->URL . 'sdo/distribution/statistics';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 库存统计接口
     */
    public function sds_product_list($post_data = array())
    {
        $post_url = $this->URL . 'sds/product/list';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }



}