<?php
/**
 * 编辑企业荣誉---------------ISL231180
 */
$remote['seller_edit_seller_touted'] = array(
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
        'slEpHonorList' => array(
            'name' => '企业荣誉信息List',
            'column' => 'slEpHonorList',
            'type' => 'List',
            'default' => '',
            'require' => '',
        ),

        'loginId' => array(
            'name' => '  创建者ID/更新者ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '11',
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
            'default' => '1',//0：全体，1：单个
            'require' => false,
        ),
    ),

    'slEpHonorList' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'honorId' => array(
            'name' => '荣誉ID',
            'column' => 'honorId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'honorDesc' => array(
            'name' => '荣誉描述',
            'column' => 'honorDesc',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'certDate' => array(
            'name' => '发证日期',
            'column' => 'certDate',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),
        'certIssuer' => array(
            'name' => '发证单位',
            'column' => 'certIssuer',
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