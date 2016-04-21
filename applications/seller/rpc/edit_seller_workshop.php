<?php
/**
 * 编辑车间概况---------------ISL231180
 */
$remote['seller_edit_seller_workshop'] = array(
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
        'slEpWorkshopList' => array(
            'name' => '企业车间List',
            'column' => 'slEpWorkshopList',//
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


    'slEpWorkshopList' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'workshopId' => array(
            'name' => '车间ID',
            'column' => 'workshopId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'workshopName' => array(
            'name' => '车间名称',
            'column' => 'workshopName',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'product' => array(
            'name' => '生产产品',
            'column' => 'product',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'process' => array(
            'name' => '工艺流程特点',
            'column' => 'process',
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