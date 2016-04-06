<?php
/**
 * 查询卖家的生产商 ---------------ISL231137
 */
$remote['seller_select_producer'] = array(
    'url' => '/sl/slInfo/slProducer/search',

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
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
            'require' => true,
        ),
        'producerEpId' => array(
            'name' => '生产商_企业ID',
            'column' => 'producerEpId',
            'type' => 'Integer',
            'require' => false,
        ),
    ),

    'response' => array(
        'slEpAuthList' => array(
            'name' => '',
            'column' => 'slEpAuthList',
            'type' => 'List',
        ),

    ),
    'slEpAuthList' => array(
        'flag' => array(
            'name' => '1：卖家代理及分销授权:2：卖家OEM委托授权标志',
            'column' => 'flag',
            'type' => 'String',
        ),
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'producerEpId' => array(
            'name' => '生产商_企业ID',
            'column' => 'producerEpId',
            'type' => 'Integer',
        ),
        'contractNo' => array(
            'name' => '授权经销合同号',
            'column' => 'contractNo',
            'type' => 'String',
        ),
        'authEpName' => array(
            'name' => '授权单位',
            'column' => 'authEpName',
            'type' => 'String',
        ),
        'authTermBegin' => array(
            'name' => '授权期限开始',
            'column' => 'authTermBegin',
            'type' => 'Datetime',
        ),
        'authTermEnd' => array(
            'name' => '授权期限结束',
            'column' => 'authTermEnd',
            'type' => 'Datetime',
        ),
        'authTermUnliimited' => array(
            'name' => '授权期限长期标志',
            'column' => 'authTermUnliimited',
            'type' => 'String',
        ),
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),
    ),

);