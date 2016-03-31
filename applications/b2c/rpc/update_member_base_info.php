<?php
/**
 * 更新买家基本信息---------------IBY121202
 */
$remote['b2c_update_member_base_info'] = array(
    'url' => '/by/buyerInfo/update',

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
            'require' => false,
        ),
        'buyerCode' => array(
            'name' => '买家编码',
            'column' => 'buyerCode',
            'type' => 'String',
            'require' => false,
        ),
        'buyerName' => array(
            'name' => '买家名称',
            'column' => 'buyerName',
            'type' => 'String',
            'require' => false,
        ),
        'buyerAddr' => array(
            'name' => '买家地址',
            'column' => 'buyerAddr',
            'type' => 'String',
            'require' => false,
        ),
        'superiorId' => array(
            'name' => '所属ID',
            'column' => 'superiorId',
            'type' => 'String',
            'require' => false,
        ),
        'buyerWebsite' => array(
            'name' => '买家网站',
            'column' => 'buyerWebsite',
            'type' => 'String',
            'require' => false,
        ),
        'buyerWechat' => array(
            'name' => '买家微信公众号',
            'column' => 'buyerWechat',
            'type' => 'String',
            'require' => false,
        ),
        'storeNo' => array(
            'name' => '店铺号',
            'column' => 'storeNo',
            'type' => 'String',
            'require' => false,
        ),
        'storeArea' => array(
            'name' => '店铺面积',
            'column' => 'storeArea',
            'type' => 'String',
            'require' => false,
        ),
        'busiTel' => array(
            'name' => '营业电话',
            'column' => 'busiTel',
            'type' => 'String',
            'require' => false,
        ),
        'employeesNum' => array(
            'name' => '员工人数',
            'column' => 'employeesNum',
            'type' => 'String',
            'require' => false,
        ),
        'paymentType' => array(
            'name' => '习惯支付方式',
            'column' => 'paymentType',
            'type' => 'String',
            'require' => false,
        ),
        'planOrderGap' => array(
            'name' => '计划订货间隙',
            'column' => 'planOrderGap',
            'type' => 'String',
            'require' => false,
        ),
        'planOrderNum' => array(
            'name' => '计划订货量',
            'column' => 'planOrderNum',
            'type' => 'String',
            'require' => false,
        ),
        'actualOrderGap' => array(
            'name' => '实际订货间隙',
            'column' => 'actualOrderGap',
            'type' => 'String',
            'require' => false,
        ),
        'actualOrderNum' => array(
            'name' => '实际订货量',
            'column' => 'actualOrderNum',
            'type' => 'String',
            'require' => false,
        ),
        'marketingsStatus' => array(
            'name' => '上线状态',
            'column' => 'marketingsStatus',
            'type' => 'String',
            'require' => false,
        ),
        'updId' => array(
            'name' => '更新者ID',
            'column' => 'updId',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'response' => array(),

);