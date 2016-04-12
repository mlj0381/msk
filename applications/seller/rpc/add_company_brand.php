<?php
/**
 * 增加企业产品品牌---------------ISL231146
 */
$remote['seller_add_company_brand'] = array(
    'url' => '/sl/slInfo/slEpBrandcTeam/new',

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
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
            'require' => true,
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
            'require' => true,
        ),
        'brandClass' => array(
            'name' => '品牌分类',
            'column' => 'brandClass',
            'type' => 'Integer',
            'require' => false,
        ),
        'brandNo' => array(
            'name' => '商标注册证',
            'column' => 'brandNo',
            'type' => 'String',
            'require' => true,
        ),
        'brandTermBegin' => array(
            'name' => '有效期限开始',
            'column' => 'brandTermBegin',
            'type' => 'Datetime',
            'require' => false,
        ),
        'brandTermEnd' => array(
            'name' => '有效期限截止',
            'column' => 'brandTermEnd',
            'type' => 'Datetime',
            'require' => true,
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