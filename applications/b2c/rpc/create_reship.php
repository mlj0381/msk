<?php
/**
 * 创建退货单---------------ISO151408
 */
$remote['b2c_create_reship'] = array(
    'url' => '/so/sro/new',

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
        'orderId' => array(
            'name' => '订单ID',
            'column' => 'orderId',
            'type' => 'Long',
            'require' => true,
        ),
        'ver' => array(
            'name' => '订单版本号',
            'column' => 'ver',
            'type' => 'Integer',
            'require' => true,
        ),
        'returnTime' => array(
            'name' => '退货单申请时间',
            'column' => 'returnTime',
            'type' => 'Datetime',
            'require' => true,
        ),
        'returnAmount' => array(
            'name' => '退货总金额',
            'column' => 'returnAmount',
            'type' => 'BigDecimal',
            'require' => true,
        ),
        'returnMethod' => array(
            'name' => '退货方式,1：全退 2：部分退，神农客平台1期默认是全退',
            'column' => 'returnMethod',
            'type' => 'Integer',
            'require' => true,
        ),
        'returnReasonCode' => array(
            'name' => '退货原因',
            'column' => 'returnReasonCode',
            'type' => 'Integer',
            'require' => false,
        ),
        'returnReasonDes' => array(
            'name' => '退货原因问题描述',
            'column' => 'returnReasonDes',
            'type' => 'String',
            'require' => true,
        ),
        'image1' => array(
            'name' => '退货原因照片1（文件服务器绝对路径）',
            'column' => 'image1',
            'type' => 'String',
            'require' => false,
        ),
        'image2' => array(
            'name' => '退货原因照片2（文件服务器绝对路径）',
            'column' => 'image2',
            'type' => 'String',
            'require' => false,
        ),
        'image3' => array(
            'name' => '退货原因照片3（文件服务器绝对路径）',
            'column' => 'image3',
            'type' => 'String',
            'require' => false,
        ),
        'image4' => array(
            'name' => '退货原因照片4（文件服务器绝对路径）',
            'column' => 'image4',
            'type' => 'String',
            'require' => false,
        ),
        'image5' => array(
            'name' => '退货原因照片5（文件服务器绝对路径）',
            'column' => 'image5',
            'type' => 'String',
            'require' => false,
        ),
        'isPaid' => array(
            'name' => '是否已付款，1:已付款',
            'column' => 'isPaid',
            'type' => 'Integer',
            'require' => true,
        ),
        'refundMode' => array(
            'name' => '退款方式',
            'column' => 'refundMode',
            'type' => 'Integer',
            'require' => false,
        ),
        'returnDetails' => array(
            'name' => '退货产品明细，退货方式为部分退的时候，至少要有一条数据',
            'column' => 'returnDetails',
            'type' => 'List',
            'require' => false,
        ),
    ),

    'returnDetails' => array(
        'returnQty' => array(
            'name' => '退货数量',
            'column' => 'returnQty',
            'type' => 'Integer',
            'require' => true,
        ),
        'returnReason' => array(
            'name' => '退货原因',
            'column' => 'returnReason',
            'type' => 'String',
            'require' => false,
        ),
        'returnReasonDes' => array(
            'name' => '退货原因问题描述',
            'column' => 'returnReasonDes',
            'type' => 'String',
            'require' => true,
        ),
        'orderDetailId' => array(
            'name' => '原订单明细ID',
            'column' => 'orderDetailId',
            'type' => 'Integer',
            'require' => false,
        ),
    ),

    'response' => array(
        'returnId' => array(
            'name' => '退货单ID',
            'column' => 'returnId',
            'type' => 'Long',
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
    ),

);