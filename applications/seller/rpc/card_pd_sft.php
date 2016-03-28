<?php
/**
 * 安全指标信息同步接口 ---------------IPD141136
 */
$remote['seller_card_pd_sft'] = array(
    'url' => '/pd/pd_sft_list',

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
        'sftList' => array(
            'name' => '',
            'column' => 'sftList',
            'type' => 'List',
        ),
    ),

    'sftList' => array(
        'sftStdClaId' => array(
            'name' => '分类通用质量准指标ID',
            'column' => 'sftStdClaId',
            'type' => 'String',
        ),
        'sftStdClaName' => array(
            'name' => '分类通用质量标准指标',
            'column' => 'sftStdClaName',
            'type' => 'String',
        ),
        'sftStdSublist' => array(
            'name' => '具体通用质量指标列表',
            'column' => 'sftStdSublist',
            'type' => 'List',
        ),
    ),

    'sftStdSublist' => array(
        'sftStdItemId' => array(
            'name' => '分类指标ID',
            'column' => 'sftStdItemId',
            'type' => 'String',
        ),
        'sftStdClaName' => array(
            'name' => '分类指标',
            'column' => 'sftStdClaName',
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