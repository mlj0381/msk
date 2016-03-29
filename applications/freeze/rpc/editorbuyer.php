<?php
/**
 * 编辑买手冻品管家的买家信息---------------IBS2101106
 */
$remote['freeze_editorbuyer'] = array(
    'url' => '/bs/slInfo/slExclusive/newOrUpdate',

    'request' => array(
        'member_id' => array(
            'name' => '登陆的用户ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require'=> false
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
        'buyerFlag' => array(
            'name' => '1:专属买家、2：抢单买家',
            'column' => 'buyerFlag',
            'type' => 'String',
            'default' => '1',
            'require' => true
        ),
        'buyer_code' => array(
            'name' => '买手店编码',
            'column' => 'slCode',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        'code' => array(
            'name' => '管家id',
            'column' => 'houseCode',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        'refer_id' => array(
            'name' => '买家编码',
            'column' => 'buyerId',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        'time' => array(
            'name' => '开始日时',
            'column' => 'startTime',
            'type' => 'datetime',
            'default' => '',
            'require' => false
        ),
        'apply_time' => array(
            'name' => '申请日时',
            'column' => 'applyTime',
            'type' => 'datetime',
            'default' => '',
            'require' => false
        ),
        'status' => array(
            'name' => '申请状态',
            'column' => 'applyStatus',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        'apply_type' => array(
            'name' => '认证方式',
            'column' => 'applySide',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        'ver' => array(
            'name' => '  版本号',
            'column' => 'ver',
            'type' => 'Integer',
            'default' => '',
            'require' => false
        ),
        'delFlg' => array(
            'name' => '  删除标志',
            'column' => 'delFlg',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        'loginId' => array(
            'name' => '创建者ID/更新者ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
    ),

    'response' => array(
        // 'buyerId' => // os id
    ),
);