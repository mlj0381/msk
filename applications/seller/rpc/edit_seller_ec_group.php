<?php
/**
 * 编辑电商团队---------------ISL231180
 */
$remote['seller_edit_seller_equipment'] = array(
    'url' => '/sl/slInfo/newOrUpdateAll',

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
        ),
    ),

    'param' => array(
        'slEcTeamList' => array(
            'name' => '电商团队',
            'column' => 'slEcTeamList',//电商 团队
            'type' => 'List',
            'default' => '',
            'require' => '',
        ),

        'loginId' => array(
            'name' => '  创建者ID/更新者ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'delFlg' => array(
            'name' => '  删除标志',
            'column' => 'delFlg',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'ver' => array('name' => '  版本号',
            'column' => 'ver',
            'type' => 'Integer',
            'default' => '',
            'require' => false
        ),
        'insertFlag' => array(
            'name' => '全体/单个',
            'column' => 'insertFlag',
            'type' => 'String',
            'default' => '',//0：全体，1：单个
            'require' => false,
        ),
    ),
    'slEcTeamList' => array(
        'slCode' => array(
            'name' => '卖家ID',
            'column' => 'slCode',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memberId' => array(
            'name' => '成员ID',
            'column' => 'memberId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'leaderFlg' => array(
            'name' => '是否负责人',
            'column' => 'leaderFlg',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memberName' => array(
            'name' => '姓名',
            'column' => 'memberName',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memberAge' => array(
            'name' => '年龄',
            'column' => 'memberAge',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'birthday' => array(
            'name' => '出生日期',
            'column' => 'birthday',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),
        'memberEduc' => array(
            'name' => '文化程度',
            'column' => 'memberEduc',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memberTel' => array(
            'name' => '联系电话',
            'column' => 'memberTel',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
    ),

    'response' => array(
        'epId' => array(
            'name' => '企业id',
            'column' => 'epId',
            'type' => 'String',
        ),
        'slCode' => array(
            'name' => '卖家id',
            'column' => 'slCode',
            'type' => 'String',
        ),
    ),

);