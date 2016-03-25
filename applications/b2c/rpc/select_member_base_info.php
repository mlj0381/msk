<?php
/**
 * 查询买家基本信息---------------IBY121202
 */
$remote['b2c_select_member_base_info'] = array(
    'url' => '/by/buyerInfo/findDetail',

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
        'buyerId' => array(
            'name' => '买家ID',
            'column' => 'buyerId',
            'type' => 'String',
            'require' => true,
        ),
    ),

    'response' => array(
        'buyerId' => array(
            'name' => '买家ID',
            'column' => 'buyerId',
            'type' => 'String',
        ),
        'buyerCode' => array(
            'name' => '买家编码',
            'column' => 'buyerCode',
            'type' => 'String',
        ),
        'buyerName' => array(
            'name' => '买家名称',
            'column' => 'buyerName',
            'type' => 'String',
        ),
        'buyerAddr' => array(
            'name' => '买家地址',
            'column' => 'buyerAddr',
            'type' => 'String',
        ),
        'superiorId' => array(
            'name' => '所属ID',
            'column' => 'superiorId',
            'type' => 'String',
        ),
        'buyerWebsite' => array(
            'name' => '买家网站',
            'column' => 'buyerWebsite',
            'type' => 'String',
        ),
        'buyerWechat' => array(
            'name' => '买家微信公众号',
            'column' => 'buyerWechat',
            'type' => 'String',
        ),
        'storeNo' => array(
            'name' => '店铺号',
            'column' => 'storeNo',
            'type' => 'String',
        ),
        'storeArea' => array(
            'name' => '店铺面积',
            'column' => 'storeArea',
            'type' => 'String',
        ),
        'busiTel' => array(
            'name' => '营业电话',
            'column' => 'busiTel',
            'type' => 'String',
        ),
        'employeesNum' => array(
            'name' => '员工人数',
            'column' => 'employeesNum',
            'type' => 'String',
        ),
        'paymentType' => array(
            'name' => '习惯支付方式',
            'column' => 'paymentType',
            'type' => 'String',
        ),
        'planOrderGap' => array(
            'name' => '计划订货间隙',
            'column' => 'planOrderGap',
            'type' => 'String',
        ),
        'planOrderNum' => array(
            'name' => '计划订货量',
            'column' => 'planOrderNum',
            'type' => 'String',
        ),
        'actualOrderGap' => array(
            'name' => '实际订货间隙',
            'column' => 'actualOrderGap',
            'type' => 'String',
        ),
        'actualOrderNum' => array(
            'name' => '实际订货量',
            'column' => 'actualOrderNum',
            'type' => 'String',
        ),
        'marketingsStatus' => array(
            'name' => '上线状态',
            'column' => 'marketingsStatus',
            'type' => 'String',
        ),
        'updId' => array(
            'name' => '更新者ID',
            'column' => 'updId',
            'type' => 'String',
        ),
    ),

);