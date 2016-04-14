<?php
/**
 * 编辑商家基本信息---------------ISL231180
 */
$remote['seller_edit_seller_aptitudes'] = array(
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
        'certInfoList' => array(
            'name' => '企业证照信息List',
            'column' => 'certInfoList',
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
            'default' => '1',
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

    'certInfoList' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'certId' => array(
            'name' => '证照ID',
            'column' => 'certId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'certName' => array(
            'name' => '证照名称',
            'column' => 'certName',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'certItemList' => array(
            'name' => '企业证照项目信息List',
            'column' => 'certItemList',
            'type' => 'List',
            'default' => '',
            'require' => false,
        ),

    ),
    'certItemList' => array(
        'certId' => array(
            'name' => '证照ID',
            'column' => 'certId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'certItemId' => array(
            'name' => '证照项目ID',
            'column' => 'certItemId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'certItemName' => array(
            'name' => '证照项目名称',
            'column' => 'certItemName',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'certItemValue' => array(
            'name' => '证照项目内容',
            'column' => 'certItemValue',
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