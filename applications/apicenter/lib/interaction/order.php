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
     * 获取供应商库存------------------ISO151421
     * @param   siteCode      Integer     Y    客户端系统编号：参见“附_系统列表”
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object
     * @param       pageCount     Integer          每页数量
     * @param       pageNo        Integer          查询页数
     * @param       supplierCode  String     Y     供应商Code
     * @param       supplierName  String           供应商名称
     * @param       districtCode  String     Y     物流区域编码
     * @param       products      List             产品列表
     * @param           pdCode        String           产品编码
     * @param           pdName        String           产品名称
     * @return  false | array
     */
    public function supplierstock_list($post_data = array())
    {
        $post_url = $this->URL . 'supplierstock/list';
        $post_data = array(
            'siteCode' => 'msk',
            'auth' => 'fasfsf',
            'loginId' => '223',
            'param' => array(
                'supplierCode' => '5646131284',
                'districtCode' => '321321',
            ),
        );
        $data = $this->request->api_post($post_url, $post_data);
//        var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 根据买家购物车中选择的产品创建购买需求订单数据。创建订单前对库存量进行检查。---------------ISO151401
     * @param   siteCode      Integer     Y    客户端系统编号：参见“附_系统列表”
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object
     * @param       years                String        Y    年月yyyy-mm
     * @param       districtCode        String        Y    区域
     * @param       orderStatus            String        Y    订单状态：1：全部，2：全部发货，3：全部收货
     * @param       products            List            产品列表,包含至少一件产品
     * @param           pdCode              String           产品编码
     * @param           pdName              String           产品名称
     * @return  false | array
     */
    public function pro_new($post_data = array())
    {
        $post_url = $this->URL . 'pro/new';
        $post_data = array(
            'siteCode' => '2',
            'auth' => 'msk',
            'loginId' => '',
            'param' => array(
                'years' => '2016-06',
                'districtCode' => '上海',
                'orderStatus' => '1',
                'products' => array(
                    'pdCode' => '132321654',
                    'pdName' => '西瓜',
                ),
            ),
        );
        $data = $this->request->api_post($post_url, $post_data);
//        var_dump($post_data, $data);exit;
        return $data;
    }

    /**
     * 根据选定的订单及退货信息，创建退货单。---------------ISO151408
     * @param   siteCode      Integer     Y    客户端系统编号：参见“附_系统列表”
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId       String           登陆的用户ID
     * @param   param         Object
     * @param       orderId    Long        Y    订单ID
     * @param       ver    Integer        Y    订单版本号
     * @param       returnTime    Datetime        Y    退货单申请时间
     * @param       returnAmount    BigDecimal        Y    退货总金额
     * @param       returnMethod    Integer        Y    退货方式,1：全退 2：部分退，神农客平台1期默认是全退
     * @param       returnReasonCode    Integer            退货原因
     * @param       returnReasonDes    String        Y    退货原因问题描述
     * @param       image1    String            退货原因照片1（文件服务器绝对路径）
     * @param       image2    String            退货原因照片2（文件服务器绝对路径）
     * @param       image3    String            退货原因照片3（文件服务器绝对路径）
     * @param       image4    String            退货原因照片4（文件服务器绝对路径）
     * @param       image5    String            退货原因照片5（文件服务器绝对路径）
     * @param       isPaid    Integer        Y    是否已付款，1:已付款
     * @param       refundMode    Integer            退款方式
     * @param       returnDetails    List            退货产品明细，退货方式为部分退的时候，至少要有一条数据
     * @param           returnQty    Integer        Y    退货数量
     * @param           returnReason    String            退货原因
     * @param           returnReasonDes    String        Y    退货原因问题描述
     * @param           orderDetailId    Integer            原订单明细ID
     * @return  false | array
     */
    public function sro_new($post_data = array())
    {
        $post_url = $this->URL . 'sro/new';
        $post_data = array(
            'siteCode' => '2',
            'auth' => 'msk',
            'loginId' => '',
            'param' => array(
                'orderId' => '32165456',
                'ver' => '1111',
                'returnTime' => '2016-1-2',
                'returnAmount' => '100',
                'returnMethod' => '2',
                'returnReasonCode' => '不想要了',
                'returnReasonDes' => 'bu yao le',
                'isPaid' => '1',
                'refundMode' => '1',
                'returnDetails' => array(
                    'returnQty' => '1',
                    'returnReason' => '',
                    'returnReasonDes' => '不想要了',
                    'orderDetailId' => '',
                ),
            ),
        );
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 根据参数中存在的条件查询退货单并返回结果列表。------------ISO151409
     * @param   siteCode      Integer     Y    客户端系统编号：参见“附_系统列表”
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId    String            登陆的用户ID
     * @param   param    Object            业务参数
     * @param       pageCount    Integer            每页数量
     * @param       pageNo    Integer            查询页数
     * @param       buyersCode    String            买家编码
     * @param       buyersId    String        Y    买家ID，当买家编码发生变化时也可以用于查询
     * @param       sellerCode    String            卖家编码
     * @param       returnType    String            退货单类型,1:分销,2:第三方,3:大促会，多选时逗号分隔。
     * @param       returnStatus    String            "退货单状态,多选时逗号分隔。"
     * @param       returnTimeFrom    Datetime            退货单申请时间开始
     * @param       returnTimeTo    Datetime            退货单申请时间截止
     * @param       returnSource    String            "退货单来源,1:平台 2:呼叫中心 3:手机客户端，多选时逗号分隔。"
     * @param       districtCode    String            退货单区域
     * @param       refundMode    Integer            退款方式,1：全退 2：部分退
     * @param       returnAmountMin    BigDecimal            退货单金额下限
     * @param       returnAmountMax    BigDecimal            退货单金额上限
     * @param       isInvoice    Integer            是否已开发票,0：未开，1:已开票
     * @param       selfDeliveryFlg    Integer            是否自配送,0：否，1:是
     * @param       sellers    String            直销员
     * @param       orderTaker    String            订单员
     * @param       orderDetailType    String            "订单明细类型,1正常订单 2:非正常订单 3:促销订单，多选时逗号分隔。"
     * @param       orderDetailLevel    String            "订单等级，1:标准订单,2:大额订单,3:大宗订单,4:超级大宗订单，多选时逗号分隔。"
     * @param       returnList    List            指定退货单列表
     * @param           returnId    Integer            退货单ID
     * @param           returnCode    String            退货单编码
     * @return  false | array
     */
    public function sro_list($post_data = array())
    {
        $post_url = $this->URL . 'sro/list';
        $post_data = array(
            'siteCode' => '2',
            'auth' => 'msk',
            'loginId' => '',
            'param' => array(
                'buyersId' => '605511c0-6495-49e0-af5c-29aa7718d2f1',
            ),
        );
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 更新指定的退货单的状态。--------------ISO151411
     * @param   siteCode      Integer     Y    客户端系统编号：参见“附_系统列表”
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId    String            登陆的用户ID
     * @param   param    Object            业务参数
     * @param       returnId    Integer        Y    退货单ID
     * @param       ver    Integer        Y    退货单版本号
     * @param       returnStatus    Integer        Y    退货单修改状态
     * @return  false | array
     */
    public function sro_update($post_data = array())
    {
        $post_url = $this->URL . 'sro/update';
        $post_data = array(
            'siteCode' => '2',
            'auth' => 'msk',
            'loginId' => '',
            'param' => array(
                'returnId' => '',
                'ver' => '',
                'returnStatus' => '',
            ),
        );
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 删除或恢复指定的订单------------------ISO151412
     * @param   siteCode      Integer     Y    客户端系统编号：参见“附_系统列表”
     * @param   auth          String      Y    分配给各个平台的身份识别码
     * @param   loginId    String            登陆的用户ID
     * @param   param    Object            业务参数
     * @param       orderId    Integer        Y    订单ID
     * @param       ver    Integer        Y    订单版本号
     * @param       operateType    Integer        Y    操作类型,0:删除,1:恢复,2:彻底删除
     * @return  false | array
     */
    public function sdo_delete($post_data = array())
    {
        $post_url = $this->URL . 'sdo/delete';
        $post_data = array(
            'siteCode' => '2',
            'auth' => 'msk',
            'loginId' => '',
            'param' => array(
                'orderId' => '123131',
                'ver' => '12312',
                'operateType' => '1',
            ),
        );
        $data = $this->request->api_post($post_url, $post_data);
//        var_dump($post_data,$data);exit;
        return $data;
    }

    public function aaa($post_data = array())
    {
        $post_url = 'msk-web/api/v1/by/account/register';
        $post_data = array(
            'siteCode' => 2,
            'auth' => 'msk',
            'loginId' => '',
            'param' => array(
                'telNo' => '1867913792912',
                'accountName' => '123456',
                'accountPass' => '654321',
                'registerSource' => '',
                'updId' => '',
            ),
        );
        $data = $this->request->api_post($post_url, $post_data);
        var_dump($post_data,$data);exit;
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