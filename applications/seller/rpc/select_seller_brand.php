<?php
/**
 * 查询卖家产品品牌---------------lSL231153
 */
$remote['seller_select_seller_brand'] = array(
    'url' => '/sl/slInfo/slPdBrandcTeam/search',

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
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
            'require' => true,
        ),
        'brandEpId' => array(
            'name' => '品牌所属企业ID',
            'column' => 'brandEpId',
            'type' => 'Integer',
            'require' => false,
        ),
        'brandId' => array(
            'name' => '品牌ID',
            'column' => 'brandId',
            'type' => 'Integer',
            'require' => false,
        ),
    ),

    'response' => array(
        'slPdBrandList' => array(
            'name' => '',
            'column' => 'slPdBrandList',
            'type' => 'List',
        ),
    ),

    'slPdBrandList' => array(
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'brandEpId' => array(
            'name' => '品牌所属企业ID',
            'column' => 'brandEpId',
            'type' => 'Integer',
        ),
        'brandId' => array(
            'name' => '品牌ID',
            'column' => 'brandId',
            'type' => 'Integer',
        ),
        'brandName' => array(
            'name' => '品牌名称',
            'column' => 'brandName',
            'type' => 'String',
        ),
        'brandType' => array(
            'name' => '品牌类型',
            'column' => 'brandType',
            'type' => 'Integer',
        ),
        'contractNo' => array(
            'name' => '代理及分销授权合同号',
            'column' => 'contractNo',
            'type' => 'String',
        ),
        'termBegin' => array(
            'name' => '有效期开始',
            'column' => 'termBegin',
            'type' => 'Datetime',
        ),
        'termEnd' => array(
            'name' => '有效期截止',
            'column' => 'termEnd',
            'type' => 'Datetime',
        ),
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),
    ),

);