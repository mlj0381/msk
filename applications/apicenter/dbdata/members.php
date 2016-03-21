<?php
$dbdata['card_provide'] = array(
    'columns' => array(
        'siteCode'=> array(
            'type'=> array(
                1 => '神农客平台',
                2 => '美侍客平台',
                3 => '大促会平台',
            ),//'Integer',
            'required' => 'Y',
            'default' => '',
            'comment' => '平台区分',
        ),

        'auth'=> array(
            'type'=> 'String',
            'required' => 'Y',
            'default' => '',
            'comment' => '分配给各个平台的身份识别码',
        ),

        'loginId'=> array(
            'type'=> 'String',
            'required' => 'Y',
            'default' => '',
            'comment' => '登陆的用户ID',
        ),

        'param'=> array(
            'type'=> 'array',
            'param'=> array(
                'userID'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '买家用户登录ID',
                ),
                'userName'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '买家用户名称',
                ),
            ),
            'comment' => '业务参数',
        ),
    ),

    'label' => '会员发卡接口',
    'comment' => '根据买家用户ID，分配一张未使用的会员卡，返回会员卡卡号和密码',
);

$dbdata['msbasic'] = array(
    'columns' => array(
        'siteCode' => array(
            'type'=> array(
                1 => '神农客平台',
                2 => '美侍客平台',
                3 => '大促会平台',
            ),//'Integer',
            'required' => 'Y',
            'default' => '',
            'comment' => '平台区分',
        ),

        'auth'=> array(
            'type'=> 'String',
            'required' => 'Y',
            'default' => '',
            'comment' => '分配给各个平台的身份识别码',
        ),

        'loginId'=> array(
            'type'=> 'String',
            'required' => 'N',
            'default' => '',
            'comment' => '登陆的用户ID',
        ),

        'param'=> array(
            'type'=> 'array',
            'param'=> array(
                'userID'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '查询用户的用户ID',
                ),
            ),//Object
            'comment' => '业务参数',
        ),
    ),

    'label' => '会员卡基本信息查询接口',
    'comment' => '根据买家用户ID查询会员卡的基本信息，例如持卡人姓名，卡号，密码（加密后）',
);

$dbdata['msbasic'] = array(
    'columns' => array(
        'siteCode' => array(
            'type'=> array(
                1 => '神农客平台',
                2 => '美侍客平台',
                3 => '大促会平台',
            ),//'Integer',
            'required' => 'Y',
            'default' => '',
            'comment' => '平台区分',
        ),

        'auth'=> array(
            'type'=> 'String',
            'required' => 'Y',
            'default' => '',
            'comment' => '分配给各个平台的身份识别码',
        ),

        'loginId'=> array(
            'type'=> 'String',
            'required' => 'N',
            'default' => '',
            'comment' => '登陆的用户ID',
        ),

        'param'=> array(
            'type'=> 'array',
            'param'=> array(
                'userID'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '查询用户的用户ID',
                ),

                'startDate'=> array(
                    'type'=> 'Datetime',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '查询开始日期',
                ),

                'endDate'=> array(
                    'type'=> 'Datetime',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '查询结束日期',
                ),
            ),//Object
            'comment' => '业务参数',
        ),
    ),

    'label' => '会员消费信息查询接口',
    'comment' => '根据用户ID和指定的起始和结束时间，查询该段时间内的消费一览',
);