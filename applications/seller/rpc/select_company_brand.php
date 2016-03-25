<?php
/**
 * 查询企业产品品牌---------------lSL231149
 */
$remote['seller_select_company_brand'] = array(
    'url' => '/sl/slInfo/slEpBrandcTeam/search',

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
    ),

    'response' => array(
        'slEpBrandList' => array(
            'name' => '',
            'column' => 'slEpBrandList',
            'type' => 'List',
        ),
    ),

    'slEpBrandList' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
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
        'brandNo' => array(
            'name' => '商标注册证',
            'column' => 'brandNo',
            'type' => 'String',
        ),
        'brandTermBegin' => array(
            'name' => '有效期限开始',
            'column' => 'brandTermBegin',
            'type' => 'Datetime',
        ),
        'brandTermEnd' => array(
            'name' => '有效期限截止',
            'column' => 'brandTermEnd',
            'type' => 'Datetime',
        ),
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),
    ),

);