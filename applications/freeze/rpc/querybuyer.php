<?php
/**
 * 查询买手冻品管家的买家信息---------------IBS2101107
 */
$remote['freeze_inquirebuyer'] = array(
    'url' => '/bs/slInfo/slExclusive/search',

    'request' => array(
        'member_id' => array(
            'name' => '登陆的用户ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false
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
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        'buyerid' => array(
            'name' => '买家编码',
            'column' => 'buyerid',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        'buyerFlag' => array(
            'name' => '1:专属买家、2：抢单买家',
            'column' => 'buyerFlag',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
    ),

    'response' => array(
        'slBuyerList' => array(
            'name' => '买手买家列表',
            'coloumn' => 'slBuyerList',
            'type' => 'List',
        ),
    ),

    'slBuyerList' => array(
        'buyerFlag' => array(
            'name' => '1:专属买家、2：抢单买家',
            'coloumn' => 'buyerFlag',
            'type' => 'String',
        ),
        'slCode' => array(
            'name' => '买手店编码',
            'coloumn' => 'slCode',
            'type' => 'String',
        ),
        'houseAccount' => array(
            'name' => '管家账号',
            'coloumn' => 'houseAccount',
            'type' => 'String',
        ),
        'buyerid' => array(
            'name' => '买家编码',
            'coloumn' => 'buyerid',
            'type' => 'String',
        ),
        'startTime' => array(
            'name' => '开始日时',
            'coloumn' => 'startTime',
            'type' => 'datetime',
        ),
        'applyTime' => array(
            'name' => '申请日时',
            'coloumn' => 'applyTime',
            'type' => 'datetime',
        ),
        'applyStatus' => array(
            'name' => '申请状态',
            'coloumn' => 'applyStatus',
            'type' => 'String',
        ),
        'applySide' => array(
            'name' => '认证方式',
            'coloumn' => 'applySide',
            'type' => 'String',
        ),
        'ver' => array(
            'name' => '版本号',
            'coloumn' => 'ver',
            'type' => 'Integer',
        )
    ),
);