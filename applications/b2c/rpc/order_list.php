<?php
/**
 * 买家订单列表---------------ISO151416
 */
$remote['b2c_order_list'] = array(
    'url' => '/so/sdo/by/list',

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
        'pageCount' => array(
            'name' => '每页数量',
            'column' => 'pageCount',
            'type' => 'Integer',
            'require' => false,
        ),
        'pageNo' => array(
            'name' => '查询页数',
            'column' => 'pageNo',
            'type' => 'Integer',
            'require' => false,
        ),
        'buyersId' => array(
            'name' => '买家ID，当买家编码发生变化时也可以用于查询* siteCode为神农客和美侍客时，买家ID为必须',
            'column' => 'buyersId',
            'type' => 'String',
            'require' => true,
        ),
        'buyersCode' => array(
            'name' => '买家编码',
            'column' => 'buyersCode',
            'type' => 'String',
            'require' => true,
        ),
        'sellerCode' => array(
            'name' => '卖家编码',
            'column' => 'sellerCode',
            'type' => 'String',
            'require' => false,
        ),
        'orderType' => array(
            'name' => '订单类型，1:分销,2:第三方,3:大促会，多选时逗号分隔。',
            'column' => 'orderType',
            'type' => 'String',
            'require' => false,
        ),
        'orderStatus' => array(
            'name' => '1:新建,2:待付款,3:已付款,4:待审核,5:已审核,6:待分销,7:分销中,8:已确认,9:待发货,10:部分发货,11:部分收货,12:全部发货,13:全部收货,14:分销失败多选时逗号分隔。',
            'column' => 'orderStatus',
            'type' => 'String',
            'require' => false,
        ),
        'orderTimeFrom' => array(
            'name' => '订单时间开始',
            'column' => 'orderTimeFrom',
            'type' => 'Datetime',
            'require' => false,
        ),
        'orderTimeTo' => array(
            'name' => '订单时间截止',
            'column' => 'orderTimeTo',
            'type' => 'Datetime',
            'require' => false,
        ),
        'delFlg' => array(
            'name' => '删除标志（是否回收站订单,0：否，1:是）',
            'column' => 'delFlg',
            'type' => 'Integer',
            'require' => false,
        ),
        'orderSource' => array(
            'name' => '订单来源,系统编码，参见系统列表',
            'column' => 'orderSource',
            'type' => 'String',
            'require' => false,
        ),
        'districtCode' => array(
            'name' => '订单区域，多选时逗号分隔。',
            'column' => 'districtCode',
            'type' => 'String',
            'require' => false,
        ),
        'paymentType' => array(
            'name' => '付款类型，1:在线支付 2:线下支付',
            'column' => 'paymentType',
            'type' => 'Integer',
            'require' => false,
        ),
        'orderAmountMin' => array(
            'name' => '订单金额下限',
            'column' => 'orderAmountMin',
            'type' => 'BigDecimal',
            'require' => false,
        ),
        'orderAmountMax' => array(
            'name' => '订单金额上限',
            'column' => 'orderAmountMax',
            'type' => 'BigDecimal',
            'require' => false,
        ),
        'orderLevel' => array(
            'name' => '订单等级，1:标准订单,2:大额订单,3:大宗订单,4:超级大宗订单多选时逗号分隔。',
            'column' => 'orderLevel',
            'type' => 'String',
            'require' => false,
        ),
        'needInvoice' => array(
            'name' => '是否开票',
            'column' => 'needInvoice',
            'type' => 'Integer',
            'require' => false,
        ),
        'returnFlg' => array(
            'name' => '退货标志，0.无退货,1.整单退货,2:部分退货，多选时逗号分隔。',
            'column' => 'returnFlg',
            'type' => 'String',
            'require' => false,
        ),
        'selfDeliveryFlg' => array(
            'name' => '是否自配送,0:否，1:是',
            'column' => 'selfDeliveryFlg',
            'type' => 'Integer',
            'require' => false,
        ),
        'splitDeliveryFlg' => array(
            'name' => '是否分批发货，0:否，1:是',
            'column' => 'splitDeliveryFlg',
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
        'request_orders' => array(
            'name' => '指定订单列表',
            'column' => 'orders',
            'type' => 'List',
            'require' => false,
        ),
    ),

    'request_orders' => array(
        'orderId' => array(
            'name' => '订单ID',
            'column' => 'orderId',
            'type' => 'Long',
            'require' => false,
        ),
        'orderCode' => array(
            'name' => '订单编码',
            'column' => 'orderCode',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'response' => array(
        'totalCount' => array(
            'name' => '查询结果总数',
            'column' => 'totalCount',
            'type' => 'Integer',
        ),
        'totalPage' => array(
            'name' => '查询结果总页数',
            'column' => 'totalPage',
            'type' => 'Integer',
        ),
        'pageNo' => array(
            'name' => '查询结果当前页数',
            'column' => 'pageNo',
            'type' => 'Integer',
        ),
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

);