<?php
/**
 * 原种种源指标信息同步接口 ---------------IPD141131
 */
$remote['seller_card_pd_org'] = array(
    'url' => '/pd/pd_org_list',

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
        'orgList' => array(
            'name' => '',
            'column' => 'orgList',
            'type' => 'List',
        ),
    ),

    'orgList' => array(
        'orgStdItemId' => array(
            'name' => '分类指标ID',
            'column' => 'orgStdItemId',
            'type' => 'String',
        ),
        'orgStdItemName' => array(
            'name' => '分类指标',
            'column' => 'orgStdItemName',
            'type' => 'String',
        ),
        'goodVal' => array(
            'name' => '优良值',
            'column' => 'goodVal',
            'type' => 'String',
        ),
        'normalVal' => array(
            'name' => '一般值',
            'column' => 'normalVal',
            'type' => 'String',
        ),
        'badVal' => array(
            'name' => '差值',
            'column' => 'badVal',
            'type' => 'String',
        ),
    ),

);