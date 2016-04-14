<?php
/**
 * 查询证照基础信息 ---------------ISL231126
 */
$remote['seller_select_company_ licenses'] = array(
    'url' => '/sl/slInfo/slMstCertInfo/search',

    'request' => array(
        'member_id' => array(
            'name' => '登陆的用户ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'param' => array(
            'name' => '业务参数',
            'column' => 'param',
            'type' => 'Object',
            'require' => false,
        ),
    ),

    'param' => array(
        'certId' => array(
            'name' => '证照ID',
            'column' => 'certId',
            'type' => 'Integer',
            'require' => false,
        ),
        'certName' => array(
            'name' => '证照名称',
            'column' => 'certName',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'response' => array(
        'certInfoList' => array(
            'name' => '证照信息List',
            'column' => 'certInfoList',
            'type' => 'List',
        ),
        'certItemList' => array(
            'name' => '证照项目List',
            'column' => 'certItemList',
            'type' => 'List',
        ),
    ),
    'certInfoList' => array(
        'certId' => array(
            'name' => '证照ID',
            'column' => 'certId',
            'type' => 'Integer',
        ),
        'certName' => array(
            'name' => '证照名称',
            'column' => 'certName',
            'type' => 'Integer',
        ),
        'reqFlg' => array(
            'name' => '是否必须',
            'column' => 'reqFlg',
            'type' => 'String',
        ),
        'sort' => array(
            'name' => '显示顺序',
            'column' => 'sort',
            'type' => 'Integer',
        ),
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),
    ),
    'certItemList' => array(
        'certId' => array(
            'name' => '证照ID',
            'column' => 'certId',
            'type' => 'Integer',
        ),
        'certItemId' => array(
            'name' => '证照项目ID',
            'column' => 'certItemId',
            'type' => 'Integer',
        ),
        'certItemName' => array(
            'name' => '证照项目名称',
            'column' => 'certItemName',
            'type' => 'String',
        ),
        'sort' => array(
            'name' => '显示顺序',
            'column' => 'sort',
            'type' => 'Integer',
        ),
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),
    ),

);