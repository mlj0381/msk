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
//        $post_data = array(
//            'siteCode' => 'msk',
//            'auth' => 'fasfsf',
//            'loginId' => '223',
//            'param' => array(
//                'supplierCode' => '5646131284',
//                'districtCode' => '321321',
//            ),
//        );
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
//        $post_data = array(
//            'siteCode' => '2',
//            'auth' => 'msk',
//            'loginId' => '',
//            'param' => array(
//                'years' => '2016-06',
//                'districtCode' => '上海',
//                'orderStatus' => '1',
//                'products' => array(
//                    'pdCode' => '132321654',
//                    'pdName' => '西瓜',
//                ),
//            ),
//        );
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
//        $post_data = array(
//            'siteCode' => '2',
//            'auth' => 'msk',
//            'loginId' => '',
//            'param' => array(
//                'orderId' => '32165456',
//                'ver' => '1111',
//                'returnTime' => '2016-1-2',
//                'returnAmount' => '100',
//                'returnMethod' => '2',
//                'returnReasonCode' => '不想要了',
//                'returnReasonDes' => 'bu yao le',
//                'isPaid' => '1',
//                'refundMode' => '1',
//                'returnDetails' => array(
//                    'returnQty' => '1',
//                    'returnReason' => '',
//                    'returnReasonDes' => '不想要了',
//                    'orderDetailId' => '',
//                ),
//            ),
//        );
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
//        $post_data = array(
//            'siteCode' => '2',
//            'auth' => 'msk',
//            'loginId' => '',
//            'param' => array(
//                'buyersId' => '605511c0-6495-49e0-af5c-29aa7718d2f1',
//            ),
//        );
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
//        $post_data = array(
//            'siteCode' => '2',
//            'auth' => 'msk',
//            'loginId' => '',
//            'param' => array(
//                'returnId' => '',
//                'ver' => '',
//                'returnStatus' => '',
//            ),
//        );
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
//        $post_data = array(
//            'siteCode' => '2',
//            'auth' => 'msk',
//            'loginId' => '',
//            'param' => array(
//                'orderId' => '123131',
//                'ver' => '12312',
//                'operateType' => '1',
//            ),
//        );
        $data = $this->request->api_post($post_url, $post_data);
//        var_dump($post_data,$data);exit;
        return $data;
    }


    /**
     * 创建订单----买手囤货订单
     * @param siteCode    Integer        Y    客户端系统编号：参见“附_系统列表”
     * @param auth    String        Y    分配给各个平台的身份识别码
     * @param loginId    String            登陆的用户ID
     * @param param    Object            业务参数
     * @param   proCode    String        Y    购物需求订单编码，标准分销订单必然来源于一张购物需求订单
     * @param   districtCode    String        Y    订单区域编码
     * @param   buyersId    String        Y    买家ID，当买家编码发生变化时也可以用于查询
     * @param   buyersCode    String        Y    买家编码
     * @param   buyersName    String        Y    买家名称
     * @param   buyersType    Integer        Y    买家类别，1:分销买家,2:菜场买家,3:团膳买家,4:火锅买家,5:中餐买家,6:西餐买家,7:小吃烧烤买家,8:加工厂买家
     * @param   sellerCode    String        Y    卖家编码
     * @param   sellerName    String        Y    卖家名称
     * @param   needInvoice    Integer            是否开票，1:要
     * @param   orderAmount    BigDecimal        Y    订单总金额
     * @param   orderType    Integer        Y    订单类型，1:分销,2:第三方,3:大促会
     * @param   paymentType    Integer        Y    付款类型，1:在线支付 2:线下支付
     * @param   sellers    String            直销员
     * @param   orderTaker    String            订单员
     * @param receiverInfo    Object            收货人信息
     * @param   receiverName    String        Y    收货人名称
     * @param   receiverQQ    Integer            收货人QQ号
     * @param   receiverWeixin    String            收货人微信号
     * @param   receiverTel    String        Y    收货人电话
     * @param   receiverProvince    String        Y    收货地址省份
     * @param   receiverCity    String        Y    收货地址市
     * @param   receiverDistrict    String        Y    收货地址区
     * @param   receiverAddr    String        Y    收货人详细地址
     * @param   receiveTime    String            习惯正常收货时间段编码，多个时候，以逗号分隔。
     * @param   receiveEarliest    String            习惯收货最早时间要求
     * @param   receiveLast    String            习惯收货最晚时间要求
     * @param   remark    String            备注
     * @param   remark2    String            备注2
     * @param   remark3    String            备注3
     * @param   remark4    String            备注4
     * @param deliveryReq    Object            配送要求
     * @param   vicFlg    Integer            动检证要求，1:要
     * @param   unloadReq    String            装卸要求
     * @param   packingReq    String            包装要求
     * @param   parkingDistance    Integer            距离门店最近停车距离(米)
     * @param   otherDeliveryReq    String            其它配送服务要求
     * @param   thisDeliveryReq    String            本次配送服务要求
     * @param invoiceReq    Object            发票要求
     * @param   invoiceType    Integer            发票类型,1:普通发票,2:增值税普通发票,3:增值税专用发票
     * @param   invoiceTitle    String            发票抬头
     * @param   invoiceContent    String            发票内容
     * @param   invReceiverTel    String            收发票人手机号码
     * @param   invTimeReq    Datetime            开票时间要求
     * @param   invReceiverEmail    String            收发票人邮箱
     * @param   invReceiverAddr    String            收发票人地址
     * @param   invoiceReq    String            发票要求
     * @param   vatInvComp    String            增票单位名称
     * @param   vatTaxpayer    String            增票纳税人识别码
     * @param   vatAddr    String            增票注册地址
     * @param   vatTel    String            增票注册电话
     * @param   vatBank    String            增票开户银行
     * @param   vatAccount    String            增票银行账号
     * @param       products    List            订单详细产品列表，包含至少一件产品
     * @param       pdCode    String        Y    产品编码
     * @param       pdName    String        Y    产品名称
     * @param       orderPrice    BigDecimal        Y    订单价格
     * @param       priceCycle    String            价盘周期，yyMMddxx
     * @param       orderQty    Integer        Y    订单数量
     * @param       orderDetailLevel    Integer        Y    订单等级
     * @param       agreeJoint    Integer            是否同意拼货，1：同意
     * @param       supplierCode    String            在创建买手囤货订单的时候不需要该字段，只有第三方订单才需要
     * @return  false | array
     */
    public function sdo_buyer_create($post_data = array())
    {
        $post_url = $this->URL . 'sdo/buyer/create';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 创建订单----第三方订单
     * @param siteCode    Integer        Y    客户端系统编号：参见“附_系统列表”
     * @param auth    String        Y    分配给各个平台的身份识别码
     * @param loginId    String            登陆的用户ID
     * @param param    Object            业务参数
     * @param   proCode    String        Y    购物需求订单编码，标准分销订单必然来源于一张购物需求订单
     * @param   districtCode    String        Y    订单区域编码
     * @param   buyersId    String        Y    买家ID，当买家编码发生变化时也可以用于查询
     * @param   buyersCode    String        Y    买家编码
     * @param   buyersName    String        Y    买家名称
     * @param   buyersType    Integer        Y    买家类别，1:分销买家,2:菜场买家,3:团膳买家,4:火锅买家,5:中餐买家,6:西餐买家,7:小吃烧烤买家,8:加工厂买家
     * @param   sellerCode    String        Y    卖家编码
     * @param   sellerName    String        Y    卖家名称
     * @param   needInvoice    Integer            是否开票，1:要
     * @param   orderAmount    BigDecimal        Y    订单总金额
     * @param   orderType    Integer        Y    订单类型，1:分销,2:第三方,3:大促会
     * @param   paymentType    Integer        Y    付款类型，1:在线支付 2:线下支付
     * @param   sellers    String            直销员
     * @param   orderTaker    String            订单员
     * @param receiverInfo    Object            收货人信息
     * @param   receiverName    String        Y    收货人名称
     * @param   receiverQQ    Integer            收货人QQ号
     * @param   receiverWeixin    String            收货人微信号
     * @param   receiverTel    String        Y    收货人电话
     * @param   receiverProvince    String        Y    收货地址省份
     * @param   receiverCity    String        Y    收货地址市
     * @param   receiverDistrict    String        Y    收货地址区
     * @param   receiverAddr    String        Y    收货人详细地址
     * @param   receiveTime    String            习惯正常收货时间段编码，多个时候，以逗号分隔。
     * @param   receiveEarliest    String            习惯收货最早时间要求
     * @param   receiveLast    String            习惯收货最晚时间要求
     * @param   remark    String            备注
     * @param   remark2    String            备注2
     * @param   remark3    String            备注3
     * @param   remark4    String            备注4
     * @param deliveryReq    Object            配送要求
     * @param   vicFlg    Integer            动检证要求，1:要
     * @param   unloadReq    String            装卸要求
     * @param   packingReq    String            包装要求
     * @param   parkingDistance    Integer            距离门店最近停车距离(米)
     * @param   otherDeliveryReq    String            其它配送服务要求
     * @param   thisDeliveryReq    String            本次配送服务要求
     * @param invoiceReq    Object            发票要求
     * @param   invoiceType    Integer            发票类型,1:普通发票,2:增值税普通发票,3:增值税专用发票
     * @param   invoiceTitle    String            发票抬头
     * @param   invoiceContent    String            发票内容
     * @param   invReceiverTel    String            收发票人手机号码
     * @param   invTimeReq    Datetime            开票时间要求
     * @param   invReceiverEmail    String            收发票人邮箱
     * @param   invReceiverAddr    String            收发票人地址
     * @param   invoiceReq    String            发票要求
     * @param   vatInvComp    String            增票单位名称
     * @param   vatTaxpayer    String            增票纳税人识别码
     * @param   vatAddr    String            增票注册地址
     * @param   vatTel    String            增票注册电话
     * @param   vatBank    String            增票开户银行
     * @param   vatAccount    String            增票银行账号
     * @param       products    List            订单详细产品列表，包含至少一件产品
     * @param       pdCode    String        Y    产品编码
     * @param       pdName    String        Y    产品名称
     * @param       orderPrice    BigDecimal        Y    订单价格
     * @param       priceCycle    String            价盘周期，yyMMddxx
     * @param       orderQty    Integer        Y    订单数量
     * @param       orderDetailLevel    Integer        Y    订单等级
     * @param       agreeJoint    Integer            是否同意拼货，1：同意
     * @param       supplierCode    String            在创建买手囤货订单的时候不需要该字段，只有第三方订单才需要
     * @return  false | array
     */
    public function sdo_thirdparty_create($post_data = array())
    {
        $post_url = $this->URL . 'sdo/thirdparty/create';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 创建订单----第三方买手囤货订单
     * @param siteCode    Integer        Y    客户端系统编号：参见“附_系统列表”
     * @param auth    String        Y    分配给各个平台的身份识别码
     * @param loginId    String            登陆的用户ID
     * @param param    Object            业务参数
     * @param   proCode    String        Y    购物需求订单编码，标准分销订单必然来源于一张购物需求订单
     * @param   districtCode    String        Y    订单区域编码
     * @param   buyersId    String        Y    买家ID，当买家编码发生变化时也可以用于查询
     * @param   buyersCode    String        Y    买家编码
     * @param   buyersName    String        Y    买家名称
     * @param   buyersType    Integer        Y    买家类别，1:分销买家,2:菜场买家,3:团膳买家,4:火锅买家,5:中餐买家,6:西餐买家,7:小吃烧烤买家,8:加工厂买家
     * @param   sellerCode    String        Y    卖家编码
     * @param   sellerName    String        Y    卖家名称
     * @param   needInvoice    Integer            是否开票，1:要
     * @param   orderAmount    BigDecimal        Y    订单总金额
     * @param   orderType    Integer        Y    订单类型，1:分销,2:第三方,3:大促会
     * @param   paymentType    Integer        Y    付款类型，1:在线支付 2:线下支付
     * @param   sellers    String            直销员
     * @param   orderTaker    String            订单员
     * @param receiverInfo    Object            收货人信息
     * @param   receiverName    String        Y    收货人名称
     * @param   receiverQQ    Integer            收货人QQ号
     * @param   receiverWeixin    String            收货人微信号
     * @param   receiverTel    String        Y    收货人电话
     * @param   receiverProvince    String        Y    收货地址省份
     * @param   receiverCity    String        Y    收货地址市
     * @param   receiverDistrict    String        Y    收货地址区
     * @param   receiverAddr    String        Y    收货人详细地址
     * @param   receiveTime    String            习惯正常收货时间段编码，多个时候，以逗号分隔。
     * @param   receiveEarliest    String            习惯收货最早时间要求
     * @param   receiveLast    String            习惯收货最晚时间要求
     * @param   remark    String            备注
     * @param   remark2    String            备注2
     * @param   remark3    String            备注3
     * @param   remark4    String            备注4
     * @param deliveryReq    Object            配送要求
     * @param   vicFlg    Integer            动检证要求，1:要
     * @param   unloadReq    String            装卸要求
     * @param   packingReq    String            包装要求
     * @param   parkingDistance    Integer            距离门店最近停车距离(米)
     * @param   otherDeliveryReq    String            其它配送服务要求
     * @param   thisDeliveryReq    String            本次配送服务要求
     * @param invoiceReq    Object            发票要求
     * @param   invoiceType    Integer            发票类型,1:普通发票,2:增值税普通发票,3:增值税专用发票
     * @param   invoiceTitle    String            发票抬头
     * @param   invoiceContent    String            发票内容
     * @param   invReceiverTel    String            收发票人手机号码
     * @param   invTimeReq    Datetime            开票时间要求
     * @param   invReceiverEmail    String            收发票人邮箱
     * @param   invReceiverAddr    String            收发票人地址
     * @param   invoiceReq    String            发票要求
     * @param   vatInvComp    String            增票单位名称
     * @param   vatTaxpayer    String            增票纳税人识别码
     * @param   vatAddr    String            增票注册地址
     * @param   vatTel    String            增票注册电话
     * @param   vatBank    String            增票开户银行
     * @param   vatAccount    String            增票银行账号
     * @param       products    List            订单详细产品列表，包含至少一件产品
     * @param       pdCode    String        Y    产品编码
     * @param       pdName    String        Y    产品名称
     * @param       orderPrice    BigDecimal        Y    订单价格
     * @param       priceCycle    String            价盘周期，yyMMddxx
     * @param       orderQty    Integer        Y    订单数量
     * @param       orderDetailLevel    Integer        Y    订单等级
     * @param       agreeJoint    Integer            是否同意拼货，1：同意
     * @param       supplierCode    String            在创建买手囤货订单的时候不需要该字段，只有第三方订单才需要
     * @return  false | array
     */
    public function sdo_thirdbuyer_create($post_data = array())
    {
        $post_url = $this->URL . 'sdo/thirdbuyer/create';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 创建订单----标准分销订单
     * @param siteCode    Integer        Y    客户端系统编号：参见“附_系统列表”
     * @param auth    String        Y    分配给各个平台的身份识别码
     * @param loginId    String            登陆的用户ID
     * @param param    Object            业务参数
     * @param   proCode    String        Y    购物需求订单编码，标准分销订单必然来源于一张购物需求订单
     * @param   districtCode    String        Y    订单区域编码
     * @param   buyersId    String        Y    买家ID，当买家编码发生变化时也可以用于查询
     * @param   buyersCode    String        Y    买家编码
     * @param   buyersName    String        Y    买家名称
     * @param   buyersType    Integer        Y    买家类别，1:分销买家,2:菜场买家,3:团膳买家,4:火锅买家,5:中餐买家,6:西餐买家,7:小吃烧烤买家,8:加工厂买家
     * @param   sellerCode    String        Y    卖家编码
     * @param   sellerName    String        Y    卖家名称
     * @param   needInvoice    Integer            是否开票，1:要
     * @param   orderAmount    BigDecimal        Y    订单总金额
     * @param   orderType    Integer        Y    订单类型，1:分销,2:第三方,3:大促会
     * @param   paymentType    Integer        Y    付款类型，1:在线支付 2:线下支付
     * @param   sellers    String            直销员
     * @param   orderTaker    String            订单员
     * @param receiverInfo    Object            收货人信息
     * @param   receiverName    String        Y    收货人名称
     * @param   receiverQQ    Integer            收货人QQ号
     * @param   receiverWeixin    String            收货人微信号
     * @param   receiverTel    String        Y    收货人电话
     * @param   receiverProvince    String        Y    收货地址省份
     * @param   receiverCity    String        Y    收货地址市
     * @param   receiverDistrict    String        Y    收货地址区
     * @param   receiverAddr    String        Y    收货人详细地址
     * @param   receiveTime    String            习惯正常收货时间段编码，多个时候，以逗号分隔。
     * @param   receiveEarliest    String            习惯收货最早时间要求
     * @param   receiveLast    String            习惯收货最晚时间要求
     * @param   remark    String            备注
     * @param   remark2    String            备注2
     * @param   remark3    String            备注3
     * @param   remark4    String            备注4
     * @param deliveryReq    Object            配送要求
     * @param   vicFlg    Integer            动检证要求，1:要
     * @param   unloadReq    String            装卸要求
     * @param   packingReq    String            包装要求
     * @param   parkingDistance    Integer            距离门店最近停车距离(米)
     * @param   otherDeliveryReq    String            其它配送服务要求
     * @param   thisDeliveryReq    String            本次配送服务要求
     * @param invoiceReq    Object            发票要求
     * @param   invoiceType    Integer            发票类型,1:普通发票,2:增值税普通发票,3:增值税专用发票
     * @param   invoiceTitle    String            发票抬头
     * @param   invoiceContent    String            发票内容
     * @param   invReceiverTel    String            收发票人手机号码
     * @param   invTimeReq    Datetime            开票时间要求
     * @param   invReceiverEmail    String            收发票人邮箱
     * @param   invReceiverAddr    String            收发票人地址
     * @param   invoiceReq    String            发票要求
     * @param   vatInvComp    String            增票单位名称
     * @param   vatTaxpayer    String            增票纳税人识别码
     * @param   vatAddr    String            增票注册地址
     * @param   vatTel    String            增票注册电话
     * @param   vatBank    String            增票开户银行
     * @param   vatAccount    String            增票银行账号
     * @param       products    List            订单详细产品列表，包含至少一件产品
     * @param       pdCode    String        Y    产品编码
     * @param       pdName    String        Y    产品名称
     * @param       orderPrice    BigDecimal        Y    订单价格
     * @param       priceCycle    String            价盘周期，yyMMddxx
     * @param       orderQty    Integer        Y    订单数量
     * @param       orderDetailLevel    Integer        Y    订单等级
     * @param       agreeJoint    Integer            是否同意拼货，1：同意
     * @param       supplierCode    String            在创建买手囤货订单的时候不需要该字段，只有第三方订单才需要
     * @return  false | array
     */
    public function sdo_distribution_create($post_data = array())
    {
        $post_url = $this->URL . 'sdo/distribution/create';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 修改订单----------订单整体取消
     * @param   siteCode    Integer        Y    客户端系统编号：参见“附_系统列表”
     * @param   auth    String        Y    分配给各个平台的身份识别码
     * @param   loginId    String            登陆的用户ID
     * @param   param    Object            业务参数
     * @param       orderId    Long        Y    订单ID
     * @param       ver    Integer        Y    订单版本号
     * @param       cancelType    Integer        Y    1.买家取消 2.不同意拼货的取消 3.不同意分批的取消神农客网站调用时默认是1.买家取消，CallCenter调用时有不同选择。
     * @param       cancelReason    String            取消原因
     * @param       orderType    Integer        Y    订单类型
     * @param       orderAmount    BigDecimal            只有在调用已付款状态时候传入
     * @return  false | array
     */
    public function sdo_cancels($post_data = array())
    {
        $post_url = $this->URL . 'sdo/cancel';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 修改订单-------------订单已付款状态
     * @param   siteCode    Integer        Y    客户端系统编号：参见“附_系统列表”
     * @param   auth    String        Y    分配给各个平台的身份识别码
     * @param   loginId    String            登陆的用户ID
     * @param   param    Object            业务参数
     * @param       orderId    Long        Y    订单ID
     * @param       ver    Integer        Y    订单版本号
     * @param       cancelType    Integer        Y    1.买家取消 2.不同意拼货的取消 3.不同意分批的取消神农客网站调用时默认是1.买家取消，CallCenter调用时有不同选择。
     * @param       cancelReason    String            取消原因
     * @param       orderType    Integer        Y    订单类型
     * @param       orderAmount    BigDecimal            只有在调用已付款状态时候传入
     * @return  false | array
     */
    public function sdo_payment($post_data = array())
    {
        $post_url = $this->URL . 'sdo/payment';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 修改订单----------------订单已全部发货
     * @param   siteCode    Integer        Y    客户端系统编号：参见“附_系统列表”
     * @param   auth    String        Y    分配给各个平台的身份识别码
     * @param   loginId    String            登陆的用户ID
     * @param   param    Object            业务参数
     * @param       orderId    Long        Y    订单ID
     * @param       ver    Integer        Y    订单版本号
     * @param       cancelType    Integer        Y    1.买家取消 2.不同意拼货的取消 3.不同意分批的取消神农客网站调用时默认是1.买家取消，CallCenter调用时有不同选择。
     * @param       cancelReason    String            取消原因
     * @param       orderType    Integer        Y    订单类型
     * @param       orderAmount    BigDecimal            只有在调用已付款状态时候传入
     * @return  false | array
     */
    public function sdo_allshipment($post_data = array())
    {
        $post_url = $this->URL . 'sdo/allshipment';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 修改订单---------------订单全部收货发货
     * @param   siteCode    Integer        Y    客户端系统编号：参见“附_系统列表”
     * @param   auth    String        Y    分配给各个平台的身份识别码
     * @param   loginId    String            登陆的用户ID
     * @param   param    Object            业务参数
     * @param       orderId    Long        Y    订单ID
     * @param       ver    Integer        Y    订单版本号
     * @param       cancelType    Integer        Y    1.买家取消 2.不同意拼货的取消 3.不同意分批的取消神农客网站调用时默认是1.买家取消，CallCenter调用时有不同选择。
     * @param       cancelReason    String            取消原因
     * @param       orderType    Integer        Y    订单类型
     * @param       orderAmount    BigDecimal            只有在调用已付款状态时候传入
     * @return  false | array
     */
    public function sdo_allreceipt($post_data = array())
    {
        $post_url = $this->URL . 'sdo/allreceipt';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 查询订单详细-------------查询明细
     * @param    siteCode    Integer        Y    客户端系统编号：参见“附_系统列表”
     * @param    auth    String        Y    分配给各个平台的身份识别码
     * @param    loginId    String            登陆的用户ID
     * @param    param    Object            业务参数
     * @param       pageCount    Integer            每页数量
     * @param       pageNo    Integer            查询页数
     * @param       buyersId    String        N    "买家ID，当买家编码发生变化时也可以用于查询* siteCode为神农客和美侍客时，买家ID为必须"
     * @param       buyersCode    String            买家编码
     * @param       sellerCode    String            卖家编码
     * @param       orderType    String            订单类型，1:分销,2:第三方,3:大促会，多选时逗号分隔。
     * @param       orderStatus    String            "1:新建,2:待付款,3:已付款,4:待审核,5:已审核,6:待分销,7:分销中,8:已确认,9:待发货,10:部分发货,11:部分收货,12:全部发货,13:全部收货,14:分销失败，多选时逗号分隔。"
     * @param       orderTimeFrom    Datetime            订单时间开始
     * @param        orderTimeTo    Datetime            订单时间截止
     * @param       delFlg    Integer            删除标志（是否回收站订单,0：否，1:是）
     * @param       orderSource    String            订单来源,系统编码，参见系统列表
     * @param       districtCode    String            订单区域，多选时逗号分隔。
     * @param       paymentType    Integer            付款类型，1:在线支付 2:线下支付
     * @param       orderAmountMin    BigDecimal            订单金额下限
     * @param       orderAmountMax    BigDecimal            订单金额上限
     * @param       orderLevel    String            "订单等级，1:标准订单,2:大额订单,3:大宗订单,4:超级大宗订单，多选时逗号分隔。"
     * @param       needInvoice    Integer            是否开票
     * @param       returnFlg    String            退货标志，0.无退货,1.整单退货,2:部分退货，多选时逗号分隔。
     * @param       selfDeliveryFlg    Integer            是否自配送,0:否，1:是
     * @param       splitDeliveryFlg    Integer            是否分批发货，0:否，1:是
     * @param       sellers    String            直销员
     * @param       orderTaker    String            订单员
     * @param       orders    List            指定订单列表
     * @param           orderId    Long            订单ID
     * @param           orderCode    String            订单编码
     * @return  false | array
     */
    public function sdo_list($post_data = array())
    {
        $post_url = $this->URL . 'sdo/list';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 查询订单详细-------------查询详细信息
     * @param    siteCode    Integer        Y    客户端系统编号：参见“附_系统列表”
     * @param    auth    String        Y    分配给各个平台的身份识别码
     * @param    loginId    String            登陆的用户ID
     * @param    param    Object            业务参数
     * @param       buyersId    String        N    "买家ID，当买家编码发生变化时也可以用于查询* siteCode为神农客和美侍客时，买家ID为必须"
     * @param       buyersCode    String            买家编码
     * @param       orders    List            指定订单列表
     * @param           orderId    Long            订单ID
     * @param           orderCode    String            订单编码
     * @return  false | array
     */
    public function sdo_detail($post_data = array())
    {
        $post_url = $this->URL . 'sdo/detail';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 订单统计：根据订单统计产品销售情况--------ISC1891I1
     * @param    siteCode    Integer        Y    客户端系统编号：参见“附_系统列表”
     * @param    auth    String        Y    分配给各个平台的身份识别码
     * @param    loginId    String            登陆的用户ID
     * @param    param    Object            业务参数
     * @param       years    String    10    Y    年月yyyy-mm-dd
     * @param       orderSource    Integer            订单来源
     * @param       districtCode    String    6    N    区域
     * @param       orderStatus    String    1    N    订单状态：1：全部，2：全部发货，3：全部收货
     * @param       dateType    String    1    Y    时间类型：1：代表年月格式（下月分销需求预测使用）
     * @param       pageCount    Integer        Y    每页数量
     * @param       pageNo    Integer        Y    查询页数
     * @param       product    List            产品列表,包含至少一件产品
     * @param           pdCode    String        N    产品编码
     * @param           weight    String        N    净重
     * @param           pdName    String        N    产品名称
     * @return  false | array
     */
    public function sdo_distribution_statistics($post_data = array())
    {
        $post_url = $this->URL . 'sdo/distribution/statistics';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 库存统计接口:根据库存历史记录获得库存信息------------ISO151419
     * @param    siteCode    Integer        Y    客户端系统编号：参见“附_系统列表”
     * @param    auth    String        Y    分配给各个平台的身份识别码
     * @param    loginId    String            登陆的用户ID
     * @param    param    Object            业务参数
     * @param       years    String    10    Y    年月yyyy-mm-dd
     * @param       sellerCode    String    10    N    卖家Code
     * @param       sellerName    String    10    N    卖家名称
     * @param       supplierCode    String    10    N    供应商Code
     * @param       supplierName    String    10    N    卖家名称
     * @param       groupType    String    10    Y    分组类型：1：卖家，2：供应商，3：产品
     * @param       pageCount    Integer        Y    每页数量
     * @param       pageNo    Integer        Y    查询页数
     * @param       product    List            产品列表,包含至少一件产品
     * @param           pdCode    String        N    产品编码
     * @param           pdName    String        N    产品名称
     * @param           weight    String        N    净重
     * @return
     */
    public function sds_product_list($post_data = array())
    {
        $post_url = $this->URL . 'sds/product/list';
        $data = $this->request->api_post($post_url, $post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }


}