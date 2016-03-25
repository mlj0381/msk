<?php
/**
 * 查询退货单---------------ISO151409
 */
$remote['b2c_select_reship'] = array(
    'url' => '/so/sro/list',

    'request' => array(
        'member_id' => array(
            'name' => '登陆的用户ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'param' => array(
            'name' => '业务参数',
            'column' => 'param',
            'type' => 'Object',
            'require' => false,
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
        'buyersCode' => array(
            'name' => '买家编码',
            'column' => 'buyersCode',
            'type' => 'String',
            'require' => false,
        ),
        'buyersId' => array(
            'name' => '买家ID，当买家编码发生变化时也可以用于查询',
            'column' => 'buyersId',
            'type' => 'String',
            'require' => true,
        ),
        'sellerCode' => array(
            'name' => '卖家编码',
            'column' => 'sellerCode',
            'type' => 'String',
            'require' => false,
        ),
        'returnStatus' => array(
            'name' => '退货单状态,多选时逗号分隔。',
            'column' => 'returnStatus',
            'type' => 'String',
            'require' => false,
        ),
        'returnTimeFrom' => array(
            'name' => '退货单申请时间开始',
            'column' => 'returnTimeFrom',
            'type' => 'Datetime',
            'require' => false,
        ),
        'returnTimeTo' => array(
            'name' => '退货单申请时间截止',
            'column' => 'returnTimeTo',
            'type' => 'Datetime',
            'require' => false,
        ),
        'returnSource' => array(
            'name' => '退货单来源,1:平台 2:呼叫中心 3:手机客户端，多选时逗号分隔。',
            'column' => 'returnSource',
            'type' => 'String',
            'require' => false,
        ),
        'districtCode' => array(
            'name' => '退货单区域',
            'column' => 'districtCode',
            'type' => 'String',
            'require' => false,
        ),
        'refundMode' => array(
            'name' => '退款方式,1：全退 2：部分退',
            'column' => 'refundMode',
            'type' => 'Integer',
            'require' => false,
        ),
        'returnAmountMin' => array(
            'name' => '退货单金额下限',
            'column' => 'returnAmountMin',
            'type' => 'BigDecimal',
            'require' => false,
        ),
        'returnAmountMax' => array(
            'name' => '退货单金额上限',
            'column' => 'returnAmountMax',
            'type' => 'BigDecimal',
            'require' => false,
        ),
        'isInvoice' => array(
            'name' => '是否已开发票,0：未开，1:已开票',
            'column' => 'isInvoice',
            'type' => 'Integer',
            'require' => false,
        ),
        'selfDeliveryFlg' => array(
            'name' => '是否自配送,0：否，1:是',
            'column' => 'selfDeliveryFlg',
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
        'orderDetailType' => array(
            'name' => '订单明细类型,1正常订单 2:非正常订单 3:促销订单,多选时逗号分隔。',
            'column' => 'orderDetailType',
            'type' => 'String',
            'require' => false,
        ),
        'orderDetailLevel' => array(
            'name' => '订单等级，1:标准订单,2:大额订单,3:大宗订单,4:超级大宗订单,多选时逗号分隔。',
            'column' => 'orderDetailLevel',
            'type' => 'String',
            'require' => false,
        ),
        'returnList' => array(
            'name' => '指定退货单列表',
            'column' => 'returnList',
            'type' => 'List',
            'require' => false,
        ),
    ),

    'returnList' => array(
        'returnId' => array(
            'name' => '退货单ID',
            'column' => 'returnId',
            'type' => 'Integer',
            'require' => false,
        ),
        'returnCode' => array(
            'name' => '退货单编码',
            'column' => 'returnCode',
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
        'returnInfos' => array(
            'name' => '退货单信息列表',
            'column' => 'returnInfos',
            'type' => 'List',
        ),
    ),

    'returnInfos' => array(
        'returnId' => array(
            'name' => '退货单ID',
            'column' => 'returnId',
            'type' => 'Integer',
        ),
        'returnCode' => array(
            'name' => '退货单编码',
            'column' => 'returnCode',
            'type' => 'String',
        ),
        'crtTime' => array(
            'name' => '退货单创建时间',
            'column' => 'crtTime',
            'type' => 'Datetime',
        ),
        'returnStatus' => array(
            'name' => '退货单状态',
            'column' => 'returnStatus',
            'type' => 'Integer',
        ),
        'ver' => array(
            'name' => '退货单版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),
        'returnSource' => array(
            'name' => '退货单来源,1:平台 2:呼叫中心 3:手机客户端',
            'column' => 'returnSource',
            'type' => 'Integer',
        ),
        'returnType' => array(
            'name' => '退货类型,1:分销,2:第三方,3:大促会',
            'column' => 'returnType',
            'type' => 'Integer',
        ),
        'returnTime' => array(
            'name' => '退货单申请时间',
            'column' => 'returnTime',
            'type' => 'Datetime',
        ),
        'returnAmount' => array(
            'name' => '退货总金额',
            'column' => 'returnAmount',
            'type' => 'BigDecimal',
        ),
        'returnMode' => array(
            'name' => '退货方式',
            'column' => 'returnMode',
            'type' => 'Integer',
        ),
        'returnReasonCode' => array(
            'name' => '退货原因',
            'column' => 'returnReasonCode',
            'type' => 'String',
        ),
        'returnReasonDes' => array(
            'name' => '退货原因问题描述',
            'column' => 'returnReasonDes',
            'type' => 'String',
        ),
        'image1' => array(
            'name' => '退货原因照片1（文件服务器绝对路径）',
            'column' => 'image1',
            'type' => 'String',
        ),
        'image2' => array(
            'name' => '退货原因照片2（文件服务器绝对路径）',
            'column' => 'image2',
            'type' => 'String',
        ),
        'image3' => array(
            'name' => '退货原因照片3（文件服务器绝对路径）',
            'column' => 'image3',
            'type' => 'String',
        ),
        'image4' => array(
            'name' => '退货原因照片4（文件服务器绝对路径）',
            'column' => 'image4',
            'type' => 'String',
        ),
        'image5' => array(
            'name' => '退货原因照片5（文件服务器绝对路径）',
            'column' => 'image5',
            'type' => 'String',
        ),
        'iaPaid' => array(
            'name' => '是否已付款，1:已付款',
            'column' => 'iaPaid',
            'type' => 'Integer',
        ),
        'returnStatus' => array(
            'name' => '是否已退款，1:已退款',
            'column' => 'returnStatus',
            'type' => 'Integer',
        ),
        'refundMode' => array(
            'name' => '退款方式',
            'column' => 'refundMode',
            'type' => 'Integer',
        ),
        'orderId' => array(
            'name' => '原订单ID',
            'column' => 'orderId',
            'type' => 'Integer',
        ),
        'orderCode' => array(
            'name' => '原订单编码',
            'column' => 'orderCode',
            'type' => 'String',
        ),
        'orderTime' => array(
            'name' => '原订单创建时间',
            'column' => 'orderTime',
            'type' => 'BigDecimal',
        ),
        'returnDetails' => array(
            'name' => '退货产品明细列表',
            'column' => 'returnDetails',
            'type' => 'List',
        ),
    ),

    'returnDetails' => array(
        'returnDetailId' => array(
            'name' => '退货单明细ID',
            'column' => 'returnDetailId',
            'type' => 'Integer',
        ),
        'pdCode' => array(
            'name' => '产品编号',
            'column' => 'pdCode',
            'type' => 'String',
        ),
        'pdName' => array(
            'name' => '产品名称',
            'column' => 'pdName',
            'type' => 'String',
        ),
        'pdLevel' => array(
            'name' => '产品等级',
            'column' => 'pdLevel',
            'type' => 'Integer',
        ),
        'unit' => array(
            'name' => '产品单位',
            'column' => 'unit',
            'type' => 'String',
        ),
        'packingVolume' => array(
            'name' => '单件体积',
            'column' => 'packingVolume',
            'type' => 'BigDecimal',
        ),
        'weight' => array(
            'name' => '重量',
            'column' => 'weight',
            'type' => 'BigDecimal',
        ),
        'volume' => array(
            'name' => '体积',
            'column' => 'volume',
            'type' => 'BigDecimal',
        ),
        'orderPrice' => array(
            'name' => '单价',
            'column' => 'orderPrice',
            'type' => 'BigDecimal',
        ),
        'priceCycle' => array(
            'name' => '单价所属价盘周期',
            'column' => 'priceCycle',
            'type' => 'String',
        ),
        'returnQty' => array(
            'name' => '退货数量',
            'column' => 'returnQty',
            'type' => 'Integer',
        ),
        'receiveQty' => array(
            'name' => '收货数量',
            'column' => 'receiveQty',
            'type' => 'Integer',
        ),
        'returnReasonCode' => array(
            'name' => '退货原因',
            'column' => 'returnReasonCode',
            'type' => 'String',
        ),
        'returnReasonDes' => array(
            'name' => '退货原因描述',
            'column' => 'returnReasonDes',
            'type' => 'String',
        ),
        'orderDetailId' => array(
            'name' => '原订单明细ID',
            'column' => 'orderDetailId',
            'type' => 'Integer',
        ),
    ),

);