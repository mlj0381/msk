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
