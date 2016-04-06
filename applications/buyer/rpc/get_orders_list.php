<?php
/**
 * 订单列表查询接口---------------ISO151416
 */
$remote['buyer_get_orders_list'] = array(
    'url' => '/so/sdo/detail',
	'version' => 'v2',
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
        'buyer_id' => array(
            'name' => '买家ID，当买家编码发生变化时也可以用于查询 * siteCode为神农客和美侍客时，买家ID为必须',
            'column' => 'buyersId',
            'type' => 'String',
            'require' => false,
        ),
        'buyer_code' => array(
            'name' => '买家编码',
            'column' => 'buyersCode',
            'type' => 'String',
            'require' => false,
        ),
        'sl_code' => array(
            'name' => '卖家编码',
            'column' => 'sellerCode',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'response' => array(
        'orders' => array(
            'name' => '订单列表',
            'column' => 'orders',
            'type' => 'List',
        ),
    ),

    'orders' => array(
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
        'orderTime' => array(
            'name' => '订单创建时间',
            'column' => 'orderTime',
            'type' => 'Datetime',
        ),
        'buyersCode' => array(
            'name' => '买家编码',
            'column' => 'buyersCode',
            'type' => 'String',
        ),
        'buyersName' => array(
            'name' => '买家名称',
            'column' => 'buyersName',
            'type' => 'String',
        ),
        'sellerCode' => array(
            'name' => '卖家编码',
            'column' => 'sellerCode',
            'type' => 'String',
        ),
        'sellerName' => array(
            'name' => '卖家名称',
            'column' => 'sellerName',
            'type' => 'String',
        ),
        'orderStatus' => array(
            'name' => '1:新建,2:待付款,3:已付款,4:待审核,5:已审核,6:待分销,7:分销中,8:已确认,9:待发货,10:部分发货,11:部分收货,12:全部发货,13:全部收货,14:分销失败',
            'column' => 'orderStatus',
            'type' => 'Integer',
        ),
        'delFlg' => array(
            'name' => '删除标志（是否回收站订单）',
            'column' => 'delFlg',
            'type' => 'Integer',
        ),
        'orderAmount' => array(
            'name' => '订单总金额',
            'column' => 'orderAmount',
            'type' => 'BigDecimal',
        ),
        'orderType' => array(
            'name' => '订单类型',
            'column' => 'orderType',
            'type' => 'Integer',
        ),
        'districtCode' => array(
            'name' => '订单区域',
            'column' => 'districtCode',
            'type' => 'String',
        ),
        'paymentType' => array(
            'name' => '付款类型',
            'column' => 'paymentType',
            'type' => 'Integer',
        ),
        'paidAmount' => array(
            'name' => '已支付金额',
            'column' => 'paidAmount',
            'type' => 'BigDecimal',
        ),
        'paidTime' => array(
            'name' => '支付时间',
            'column' => 'paidTime',
            'type' => 'Datetime',
        ),
        'sellers' => array(
            'name' => '直销员',
            'column' => 'sellers',
            'type' => 'String',
        ),
        'orderTaker' => array(
            'name' => '订单员',
            'column' => 'orderTaker',
            'type' => 'String',
        ),
        'invoiceFlg' => array(
            'name' => '是否已开发票，1：是',
            'column' => 'invoiceFlg',
            'type' => 'Integer',
        ),
        'commentTime' => array(
            'name' => '评价时间',
            'column' => 'commentTime',
            'type' => 'Datetime',
        ),
        'receiveInfo' => array(
            'name' => '收货信息',
            'column' => 'receiveInfo',
            'type' => 'Object',
        ),
        'deliveryReq' => array(
            'name' => '配送要求',
            'column' => 'deliveryReq',
            'type' => 'Object',
        ),
        'orderDetail' => array(
            'name' => '配送要求',
            'column' => 'orderDetail',
            'type' => 'List',
        ),
        'delivery' => array(
            'name' => '物流配送信息',
            'column' => 'delivery',
            'type' => 'Object',
        ),
    ),

    'receiveInfo' => array(
        'receiverName' => array(
            'name' => '收货人名称',
            'column' => 'receiverName',
            'type' => 'String',
        ),
        'receiverQQ' => array(
            'name' => '收货人QQ号',
            'column' => 'receiverQQ',
            'type' => 'String',
        ),
        'receiverWeixin' => array(
            'name' => '收货人微信号',
            'column' => 'receiverWeixin',
            'type' => 'String',
        ),
        'receiverTel' => array(
            'name' => '收货人电话',
            'column' => 'receiverTel',
            'type' => 'String',
        ),
        'receiverProvince' => array(
            'name' => '收货地址省份',
            'column' => 'receiverProvince',
            'type' => 'String',
        ),
        'receiverCity' => array(
            'name' => '收货地址市',
            'column' => 'receiverCity',
            'type' => 'String',
        ),
        'receiverDistrict' => array(
            'name' => '收货地址区',
            'column' => 'receiverDistrict',
            'type' => 'String',
        ),
        'receiverAddr' => array(
            'name' => '收货人详细地址',
            'column' => 'receiverAddr',
            'type' => 'String',
        ),
        'receiveTime' => array(
            'name' => '习惯正常收货时间段',
            'column' => 'receiveTime',
            'type' => 'Integer',
        ),
        'receiveEarliest' => array(
            'name' => '习惯收货最早时间要求',
            'column' => 'receiveEarliest',
            'type' => 'String',
        ),
        'receiveLast' => array(
            'name' => '习惯收货最晚时间要求',
            'column' => 'receiveLast',
            'type' => 'String',
        ),
        'parkingDistance' => array(
            'name' => '距离门店最近停车距离(米)',
            'column' => 'parkingDistance',
            'type' => 'BigDecimal',
        ),
        'remark' => array(
            'name' => '备注',
            'column' => 'remark',
            'type' => 'String',
        ),
        'remark2' => array(
            'name' => '备注2',
            'column' => 'remark2',
            'type' => 'String',
        ),
        'remark3' => array(
            'name' => '备注3',
            'column' => 'remark3',
            'type' => 'String',
        ),
        'remark4' => array(
            'name' => '备注4',
            'column' => 'remark4',
            'type' => 'String',
        ),
    ),

    'deliveryReq' => array(
        'vicFlg' => array(
            'name' => '动检证要求,1:需要',
            'column' => 'vicFlg',
            'type' => 'Integer',
        ),
        'unloadReq' => array(
            'name' => '装卸要求',
            'column' => 'unloadReq',
            'type' => 'String',
        ),
        'packingReq' => array(
            'name' => '包装要求',
            'column' => 'packingReq',
            'type' => 'String',
        ),
        'otherDeliveryReq' => array(
            'name' => '其它配送服务要求',
            'column' => 'otherDeliveryReq',
            'type' => 'String',
        ),
        'thisDeliveryReq' => array(
            'name' => '本次配送服务要求',
            'column' => 'thisDeliveryReq',
            'type' => 'String',
        ),
    ),

    'orderDetail' => array(
        'pdCode' => array(
            'name' => '产品编码',
            'column' => 'pdCode',
            'type' => 'Integer',
        ),
        'pdName' => array(
            'name' => '产品名称',
            'column' => 'pdName',
            'type' => 'String',
        ),
        'pdPrice' => array(
            'name' => '产品价格',
            'column' => 'pdPrice',
            'type' => 'BigDecimal',
        ),
        'orderQty' => array(
            'name' => '订购数量',
            'column' => 'orderQty',
            'type' => 'BigDecimal',
        ),
    ),

    'delivery' => array(
        'operationDate' => array(
            'name' => '物流配送操作时间',
            'column' => 'operationDate',
            'type' => 'Datetime',
        ),
        'operationDescribe' => array(
            'name' => '物流配送操作说明：例如：订单已经被配送人员AAAA配送，联系电话XXXXX，预计到货时间XXXXX',
            'column' => 'operationDescribe',
            'type' => 'String',
        ),
    ),

);