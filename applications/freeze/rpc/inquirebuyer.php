<?php
/**
 * 查询买手冻品管家的买家信息---------------IBS2101107
 */
$remote['freeze_inquirebuyer'] = array(
    'url' => '/bs/slInfo/slExclusive/search',

    'params' => array(
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
        '' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '买家编码',
            'column' => 'buyerid',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '1:专属买家、2：抢单买家',
            'column' => 'buyerFlag',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
    ),

    'result' => array(
        // 'buyerId' => // os id
    ),
);