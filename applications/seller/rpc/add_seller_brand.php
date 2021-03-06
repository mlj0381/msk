<?php
/**
 * 增加卖家产品品牌---------------ISL231150
 */
$remote['seller_add_seller_brand'] = array(
    'url' => '/sl/slInfo/slPdBrandcTeam/new',

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
            'require' => false,
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
        'brandName' => array(
            'name' => '品牌名称',
            'column' => 'brandName',
            'type' => 'String',
            'require' => false,
        ),
        'brandType' => array(
            'name' => '品牌类型',
            'column' => 'brandType',
            'type' => 'Integer',
            'require' => false,
        ),
        'brandClass' => array(
            'name' => '品牌分类',
            'column' => 'brandClass',
            'type' => 'Integer',
            'require' => false,
        ),
        'contractNo' => array(
            'name' => '代理及分销授权合同号',
            'column' => 'contractNo',
            'type' => 'String',
            'require' => false,
        ),
        'termBegin' => array(
            'name' => '有效期开始',
            'column' => 'termBegin',
            'type' => 'Datetime',
            'require' => false,
        ),
        'termEnd' => array(
            'name' => '有效期截止',
            'column' => 'termEnd',
            'type' => 'Datetime',
            'require' => false,
        ),
        'crtId' => array(
            'name' => '创建者ID',
            'column' => 'crtId',
            'type' => 'String',
            'require' => false,
            'default' => '1',
        ),
    ),
    'response' => array(),

);