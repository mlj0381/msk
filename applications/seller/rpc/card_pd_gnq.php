<?php
/**
 * 通用质量信息指标同步接口 ---------------IPD141135
 */
$remote['seller_card_pd_gnq'] = array(
    'url' => '/pd/pd_gnq_list',

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
        'gnqList' => array(
            'name' => '',
            'column' => 'gnqList',
            'type' => 'List',
        ),
    ),

    'gnqList' => array(
        'gnqStdClaId' => array(
            'name' => '分类通用质量准指标ID',
            'column' => 'gnqStdClaId',
            'type' => 'String',
        ),
        'gnqStdClaName' => array(
            'name' => '分类通用质量标准指标',
            'column' => 'gnqStdClaName',
            'type' => 'String',
        ),
        'gnqStdSublist' => array(
            'name' => '具体通用质量指标列表',
            'column' => 'gnqStdSublist',
            'type' => 'List',
        ),
    ),

    'gnqStdSublist' => array(
        'gnqStdItemId' => array(
            'name' => '分类指标ID',
            'column' => 'gnqStdItemId',
            'type' => 'String',
        ),
        'gnqStdClaName' => array(
            'name' => '分类指标',
            'column' => 'gnqStdClaName',
            'type' => 'String',
        ),
        'okVal' => array(
            'name' => '合格值',
            'column' => 'okVal',
            'type' => 'String',
        ),
        'ngVal' => array(
            'name' => '不合格值',
            'column' => 'ngVal',
            'type' => 'String',
        ),
    ),

);