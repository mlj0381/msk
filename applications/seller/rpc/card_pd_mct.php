<?php
/**
 * 加工技术标准指标信息同步接口 ---------------IPD141133
 */
$remote['seller_card_pd_mct'] = array(
    'url' => '/pd/pd_mct_list',

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
        'mctList' => array(
            'name' => '',
            'column' => 'mctList',
            'type' => 'List',
        ),
    ),

    'mctList' => array(
        'mctStdItemId' => array(
            'name' => '分类指标ID',
            'column' => 'mctStdItemId',
            'type' => 'String',
        ),
        'fedStdItemName' => array(
            'name' => '分类指标',
            'column' => 'fedStdItemName',
            'type' => 'String',
        ),
        'okVal' => array(
            'name' => '优良值',
            'column' => 'okVal',
            'type' => 'String',
        ),
        'ngVal' => array(
            'name' => '一般值',
            'column' => 'ngVal',
            'type' => 'String',
        ),
    ),

);