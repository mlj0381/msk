<?php
/**
 * 查询物流区---------------IPD141114
 */
$remote['b2c_selecte_area'] = array(
    'url' => '/pd/logiArea',

    'request' => array(
        'member_id' => array(
            'name' => '登陆的用户ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
    ),

    'response' => array(
        'logiAreaList' => array(
            'name' => '物流区产品信息列表',
            'column' => 'logiAreaList',
            'type' => 'List',
        ),
    ),

    'logiAreaList' => array(
        'logiAreaCode' => array(
            'name' => '物流区编码',
            'column' => 'logiAreaCode',
            'type' => 'String',
        ),
        'logiAreaName' => array(
            'name' => '物流区名称',
            'column' => 'logiAreaName',
            'type' => 'String',
        ),
    ),

);