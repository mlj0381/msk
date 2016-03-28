<?php
/**
 * 创建第三方买手销售订单---------------ISO151414
 */
$remote['buyer_create_out_order'] = array(
    'url' => '/so/sdo/thirdparty/create',

    'request' => array(
        'member_id' => array(
            'name' => '登陆的用户ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'param' => array(
            'name' => '参数',
            'column' => 'param',
            'type' => 'object',
            'default' => Array(),
            //'require'=> true
        ),
    ),

    'param' => array(
        'proCode' => array(
            'name' => '购物需求订单编码，标准分销订单必然来源于一张购物需求订单',
            'column' => 'proCode',
            'type' => 'String',
            'require' => true,
        ),
        'districtCode' => array(
            'name' => '订单区域编码',
            'column' => 'districtCode',
            'type' => 'String',
            'require' => true,
        ),
        'buyersId' => array(
            'name' => '买家ID，当买家编码发生变化时也可以用于查询',
            'column' => 'buyersId',
            'type' => 'String',
            'require' => false,
        ),
        'buyersCode' => array(
            'name' => '买家编码',
            'column' => 'buyersCode',
            'type' => 'String',
            'require' => false,
        ),
        'buyersName' => array(
            'name' => '买家名称',
            'column' => 'buyersName',
            'type' => 'String',
            'require' => false,
        ),
        'buyersType' => array(
            'name' => '买家类别，1:分销买家,2:菜场买家,3:团膳买家,4:火锅买家,5:中餐买家,6:西餐买家,7:小吃烧烤买家,8:加工厂买家',
            'column' => 'buyersType',
            'type' => 'Integer',
            'require' => true,
        ),
        'sellerCode' => array(
            'name' => '卖家编码',
            'column' => 'sellerCode',
            'type' => 'String',
            'require' => true,
        ),
        'sellerName' => array(
            'name' => '卖家名称',
            'column' => 'sellerName',
            'type' => 'String',
            'require' => true,
        ),
        'needInvoice' => array(
            'name' => '是否开票，1:要',
            'column' => 'needInvoice',
            'type' => 'Integer',
            'require' => true,
        ),
        'orderAmount' => array(
            'name' => '订单总金额',
            'column' => 'orderAmount',
            'type' => 'BigDecimal',
            'require' => true,
        ),
        'paymentType' => array(
            'name' => '付款类型，1:在线支付 2:线下支付',
            'column' => 'paymentType',
            'type' => 'Integer',
            'require' => false,
        ),
        'sellers' => array(
            'name' => '直销员',
            'column' => 'sellers',
            'type' => 'String',
            'require' => false,
        ),
        'orderTaker' => array(
            'name' => '订单员',
            'column' => 'orderTaker',
            'type' => 'String',
            'require' => false,
        ),
        'receiverInfo' => array(
            'name' => '收货人信息',
            'column' => 'receiverInfo',
            'type' => 'Object',
            'require' => false,
        ),
        'deliveryReq' => array(
            'name' => '配送要求',
            'column' => 'deliveryReq',
            'type' => 'Object',
            'require' => false,
        ),
        'invoiceReq' => array(
            'name' => '发票要求',
            'column' => 'invoiceReq',
            'type' => 'Object',
            'require' => false,
        ),
        'products' => array(
            'name' => '订单详细产品列表，包含至少一件产品',
            'column' => 'products',
            'type' => 'List',
            'require' => false,
        ),
    ),

    'receiverInfo' => array(
        'receiverName' => array(
            'name' => '收货人名称',
            'column' => 'receiverName',
            'type' => 'String',
            'require' => true,
        ),
        'receiverQQ' => array(
            'name' => '收货人QQ号',
            'column' => 'receiverQQ',
            'type' => 'Integer',
            'require' => false,
        ),
        'receiverWeixin' => array(
            'name' => '收货人微信号',
            'column' => 'receiverWeixin',
            'type' => 'String',
            'require' => false,
        ),
        'receiverTel' => array(
            'name' => '收货人电话',
            'column' => 'receiverTel',
            'type' => 'String',
            'require' => true,
        ),
        'receiverProvince' => array(
            'name' => '收货地址省份',
            'column' => 'receiverProvince',
            'type' => 'String',
            'require' => true,
        ),
        'receiverCity' => array(
            'name' => '收货地址市',
            'column' => 'receiverCity',
            'type' => 'String',
            'require' => true,
        ),
        'receiverDistrict' => array(
            'name' => '收货地址区',
            'column' => 'receiverDistrict',
            'type' => 'String',
            'require' => true,
        ),
        'receiverAddr' => array(
            'name' => '收货人详细地址',
            'column' => 'receiverAddr',
            'type' => 'String',
            'require' => true,
        ),
        'receiveTime' => array(
            'name' => '习惯正常收货时间段编码，多个时候，以逗号分隔。',
            'column' => 'receiveTime',
            'type' => 'String',
            'require' => false,
        ),
        'receiveEarliest' => array(
            'name' => '习惯收货最早时间要求',
            'column' => 'receiveEarliest',
            'type' => 'String',
            'require' => false,
        ),
        'receiveLast' => array(
            'name' => '习惯收货最晚时间要求',
            'column' => 'receiveLast',
            'type' => 'String',
            'require' => false,
        ),
        'remark' => array(
            'name' => '备注',
            'column' => 'remark',
            'type' => 'String',
            'require' => false,
        ),
        'remark2' => array(
            'name' => '备注2',
            'column' => 'remark2',
            'type' => 'String',
            'require' => false,
        ),
        'remark3' => array(
            'name' => '备注3',
            'column' => 'remark3',
            'type' => 'String',
            'require' => false,
        ),
        'remark4' => array(
            'name' => '备注4',
            'column' => 'remark4',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'deliveryReq' => array(
        'vicFlg' => array(
            'name' => '动检证要求，1:要',
            'column' => 'vicFlg',
            'type' => 'Integer',
            'require' => false,
        ),
        'unloadReq' => array(
            'name' => '装卸要求',
            'column' => 'unloadReq',
            'type' => 'String',
            'require' => false,
        ),
        'packingReq' => array(
            'name' => '包装要求',
            'column' => 'packingReq',
            'type' => 'String',
            'require' => false,
        ),
        'parkingDistance' => array(
            'name' => '距离门店最近停车距离(米)',
            'column' => 'parkingDistance',
            'type' => 'Integer',
            'require' => false,
        ),
        'otherDeliveryReq' => array(
            'name' => '其它配送服务要求',
            'column' => 'otherDeliveryReq',
            'type' => 'String',
            'require' => false,
        ),
        'thisDeliveryReq' => array(
            'name' => '本次配送服务要求',
            'column' => 'thisDeliveryReq',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'invoiceReq' => array(
        'invoiceType' => array(
            'name' => '发票类型,1:普通发票,2:增值税普通发票,3:增值税专用发票',
            'column' => 'invoiceType',
            'type' => 'Integer',
            'require' => false,
        ),
        'invoiceTitle' => array(
            'name' => '发票抬头',
            'column' => 'invoiceTitle',
            'type' => 'String',
            'require' => false,
        ),
        'invoiceContent' => array(
            'name' => '发票内容',
            'column' => 'invoiceContent',
            'type' => 'String',
            'require' => false,
        ),
        'invReceiverTel' => array(
            'name' => '收发票人手机号码',
            'column' => 'invReceiverTel',
            'type' => 'String',
            'require' => false,
        ),
        'invTimeReq' => array(
            'name' => '开票时间要求',
            'column' => 'invTimeReq',
            'type' => 'Datetime',
            'require' => false,
        ),
        'invReceiverEmail' => array(
            'name' => '收发票人邮箱',
            'column' => 'invReceiverEmail',
            'type' => 'String',
            'require' => false,
        ),
        'invReceiverAddr' => array(
            'name' => '收发票人地址',
            'column' => 'invReceiverAddr',
            'type' => 'String',
            'require' => false,
        ),
        'invoiceReq' => array(
            'name' => '发票要求',
            'column' => 'invoiceReq',
            'type' => 'String',
            'require' => false,
        ),
        'vatInvComp' => array(
            'name' => '增票单位名称',
            'column' => 'vatInvComp',
            'type' => 'String',
            'require' => false,
        ),
        'vatTaxpayer' => array(
            'name' => '增票纳税人识别码',
            'column' => 'vatTaxpayer',
            'type' => 'String',
            'require' => false,
        ),
        'vatAddr' => array(
            'name' => '增票注册地址',
            'column' => 'vatAddr',
            'type' => 'String',
            'require' => false,
        ),
        'vatTel' => array(
            'name' => '增票注册电话',
            'column' => 'vatTel',
            'type' => 'String',
            'require' => false,
        ),
        'vatBank' => array(
            'name' => '增票开户银行',
            'column' => 'vatBank',
            'type' => 'String',
            'require' => false,
        ),
        'vatAccount' => array(
            'name' => '增票银行账号',
            'column' => 'vatAccount',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'products' => array(
        'pdCode' => array(
            'name' => '产品编码',
            'column' => 'pdCode',
            'type' => 'String',
            'require' => true,
        ),
        'pdName' => array(
            'name' => '产品名称',
            'column' => 'pdName',
            'type' => 'String',
            'require' => true,
        ),
        'orderPrice' => array(
            'name' => '订单价格',
            'column' => 'orderPrice',
            'type' => 'BigDecimal',
            'require' => true,
        ),
        'priceCycle' => array(
            'name' => '价盘周期，yyMMddxx',
            'column' => 'priceCycle',
            'type' => 'String',
            'require' => false,
        ),
        'orderQty' => array(
            'name' => '订单数量',
            'column' => 'orderQty',
            'type' => 'Integer',
            'require' => true,
        ),
        'agreeJoint' => array(
            'name' => '是否同意拼货，1：同意',
            'column' => 'agreeJoint',
            'type' => 'Integer',
            'require' => false,
        ),
        'supplierCode' => array(
            'name' => '供应商编号',
            'column' => 'supplierCode',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'response' => array(
        'orderId' => array(
            'name' => '订单ID',
            'column' => 'orderId',
            'type' => 'Long',
        ),
        'orderCode' => array(
            'name' => '需求订单编码',
            'column' => 'orderCode',
            'type' => 'String',
        ),
        'OrderTime' => array(
            'name' => '订单创建时间',
            'column' => 'OrderTime',
            'type' => 'Datetime',
        ),
        'orderStatus' => array(
            'name' => '1:新建,2:待付款,3:已付款,4:待审核,5:已审核,6:待分销,7:分销中,8:已确认,9:待发货,10:部分发货,11:部分收货,12:全部发货,13:全部收货,14:分销失败',
            'column' => 'orderStatus',
            'type' => 'Integer',
        ),
        'ver' => array(
            'name' => '数据版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),
    ),

);