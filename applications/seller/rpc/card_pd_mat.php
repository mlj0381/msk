<?php
/**
 * 原料种源信息同步接口 ---------------IPD141140
 */
$remote['seller_card_pd_mat'] = array(
    'url' => '/pd/pd_mat_list',

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
            //'require'=> true
        ),
    ),

    'response' => array(
        'totalCount' => array(
            'name' => '总记录数（辅助字段）',
            'column' => 'totalCount',
            'type' => 'int',
        ),
        'totalPage' => array(
            'name' => '总业数（辅助字段）',
            'column' => 'totalPage',
            'type' => 'int',
        ),
        'pageNo' => array(
            'name' => '页码（辅助字段）',
            'column' => 'pageNo',
            'type' => 'int',
        ),
        'searchList' => array(
            'name' => '',
            'column' => 'searchList',
            'type' => 'List',
        ),
    ),

    'searchList' => array(
        'classesCode' => array(
            'name' => '类别编码',
            'column' => 'classesCode',
            'type' => 'String',
        ),
        'machiningCode' => array(
            'name' => '二级分类编码',
            'column' => 'machiningCode',
            'type' => 'String',
        ),
        'breedCode' => array(
            'name' => '品种编码',
            'column' => 'breedCode',
            'type' => 'String',
        ),
        'featureCode' => array(
            'name' => '特征编码',
            'column' => 'featureCode',
            'type' => 'String',
        ),
        'scientificName' => array(
            'name' => '学名',
            'column' => 'scientificName',
            'type' => 'String',
        ),
        'localName' => array(
            'name' => '俗名',
            'column' => 'localName',
            'type' => 'String',
        ),
        'salesName' => array(
            'name' => '销售名',
            'column' => 'salesName',
            'type' => 'String',
        ),
        'placeOrigin' => array(
            'name' => '原料原产地',
            'column' => 'placeOrigin',
            'type' => 'String',
        ),
        'placeCurrent' => array(
            'name' => '现产地',
            'column' => 'placeCurrent',
            'type' => 'String',
        ),
        'source' => array(
            'name' => '原料种源',
            'column' => 'source',
            'type' => 'String',
        ),
        'childType' => array(
            'name' => '雏类',
            'column' => 'childType',
            'type' => 'String',
        ),
        'feedType' => array(
            'name' => '饲养方式',
            'column' => 'feedType',
            'type' => 'String',
        ),
        'feedPeriod' => array(
            'name' => '饲养周期',
            'column' => 'feedPeriod',
            'type' => 'String',
        ),
    ),

);