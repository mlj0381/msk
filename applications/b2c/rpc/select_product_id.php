<?php
/**
 * 产品标准ID查询接口---------------IPD141142
 */
$remote['b2c_select_product_id'] = array(
    'url' => '/pd/pd_standard_list',

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

    'response' => array(
        'totalCount' => array(
            'name' => '查询结果总数',
            'column' => 'totalCount',
            'type' => 'Integer',
        ),
        'totalPage' => array(
            'name' => '查询结果总页数',
            'column' => 'totalPage',
            'type' => 'Integer',
        ),
        'pageNo' => array(
            'name' => '查询结果当前页数',
            'column' => 'pageNo',
            'type' => 'Integer',
        ),
        'searchList' => array(
            'name' => '',
            'column' => 'searchList',
            'type' => 'List',
        ),
    ),
    'searchList' => array(
        'standardID' => array(
            'name' => '产品标准ID',
            'column' => 'standardID',
            'type' => 'String',
        ),
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
        'weightCode' => array(
            'name' => '净重编码',
            'column' => 'weightCode',
            'type' => 'String',
        ),
    ),

);