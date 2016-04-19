<?php
/**
 * 编辑检测设备---------------ISL231180
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
		'slEpDdList' => array(
            'name' => '检测设备',
            'column' => 'slEpDdList',//检测设备
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


	'slEpDdList' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'ddId' => array(
            'name' => '设备ID',
            'column' => 'ddId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
		'ddName' => array(
            'name' => '设备名称',
            'column' => 'ddName',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
		'ddEquipment' => array(
            'name' => '主要用途',
            'column' => 'ddEquipment',
            'type' => 'Integer',
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