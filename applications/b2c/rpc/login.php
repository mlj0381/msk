<?php
/**
 * 买家账号登陆---------------IBY121201
 */
$remote['b2c_login'] = array(
    'url' => '/by/account/login',

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
        'login_account' => array(
            'name' => '买家账号或者手机号',
            'column' => 'accountName',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'login_password' => array(
            'name' => '密码',
            'column' => 'accountPass',
            'type' => 'String',
            'default' => '',
            'require' => false,
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
        'superiorType' => array(
            'name' => '买家类型',
            'column' => 'superiorType',
            'type' => 'String',
        ),
        'lgcsAreaCode' => array(
            'name' => '物流区编码',
            'column' => 'lgcsAreaCode',
            'type' => 'String',
        ),
        'cityCode' => array(
            'name' => '城市地区编码',
            'column' => 'cityCode',
            'type' => 'String',
        ),
        'districtCode' => array(
            'name' => '区县编码',
            'column' => 'districtCode',
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