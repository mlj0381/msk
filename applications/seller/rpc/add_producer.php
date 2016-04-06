<?php
/**
 * 增加生产商---------------ISL231134
 */
$remote['seller_add_producer'] = array(
    'url' => '/sl/slInfo/slProducer/new',

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
        'flag' => array(
            'name' => '1：卖家代理及分销授权:2：卖家OEM委托授权标志',
            'column' => 'flag',
            'type' => 'String',
            'require' => false,
        ),
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
            'require' => false,
        ),
        'producerEpId' => array(
            'name' => '生产商_企业ID',
            'column' => 'producerEpId',
            'type' => 'Integer',
            'require' => false,
        ),
        'contractNo' => array(
            'name' => '授权经销合同号',
            'column' => 'contractNo',
            'type' => 'String',
            'require' => false,
        ),
        'authEpName' => array(
            'name' => '授权单位',
            'column' => 'authEpName',
            'type' => 'String',
            'require' => false,
        ),
        'authTermBegin' => array(
            'name' => '授权期限开始',
            'column' => 'authTermBegin',
            'type' => 'Datetime',
            'require' => false,
        ),
        'authTermEnd' => array(
            'name' => '授权期限结束',
            'column' => 'authTermEnd',
            'type' => 'Datetime',
            'require' => false,
        ),
        'authTermUnliimited' => array(
            'name' => '授权期限长期标志',
            'column' => 'authTermUnliimited',
            'type' => 'String',
            'require' => false,
        ),
        'crtId' => array(
            'name' => '创建者ID',
            'column' => 'crtId',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'response' => array(),

);