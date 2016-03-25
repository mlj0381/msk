<?php
/**
 * 编辑卖家产品---------------ISL231106
 */
$remote['seller_edit_seller_product'] = array(
    'url' => '/sl/slInfo/slQlt/newOrUpdate',

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
        'slPdList' => array(
            'name' => '卖家能销售的产品信息',
            'column' => 'slPdList',
            'type' => 'List',
            'require' => false,
        ),
    ),

    'slPdList' => array(
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
            'require' => true,
        ),
        'prodEpId' => array(
            'name' => '生产商企业ID',
            'column' => 'prodEpId',
            'type' => 'Integer',
            'require' => true,
        ),
        'brandEpId' => array(
            'name' => '品牌商企业ID',
            'column' => 'brandEpId',
            'type' => 'Integer',
            'require' => true,
        ),
        'brandId' => array(
            'name' => '产品品牌ID',
            'column' => 'brandId',
            'type' => 'Integer',
            'require' => true,
        ),
        'pdClassesCode' => array(
            'name' => '产品类别',
            'column' => 'pdClassesCode',
            'type' => 'String',
            'require' => true,
        ),
        'machiningCode' => array(
            'name' => '产品二级分类编码',
            'column' => 'machiningCode',
            'type' => 'String',
            'require' => true,
        ),
        'pdBreedCode' => array(
            'name' => '产品品种',
            'column' => 'pdBreedCode',
            'type' => 'String',
            'require' => true,
        ),
        'pdFeatureCode' => array(
            'name' => '产品特征',
            'column' => 'pdFeatureCode',
            'type' => 'String',
            'require' => true,
        ),
        'weightCode' => array(
            'name' => '净重编码',
            'column' => 'weightCode',
            'type' => 'String',
            'require' => true,
        ),
        'distFlg' => array(
            'name' => '是否参与神农客分销，0:否，1:是',
            'column' => 'distFlg',
            'type' => 'String',
            'require' => true,
        ),
        'diskmskFlg' => array(
            'name' => '是否参与美侍客分销，0:否，1:是',
            'column' => 'diskmskFlg',
            'type' => 'String',
            'require' => true,
        ),
        'loginId' => array(
            'name' => '创建者ID/更新者ID',
            'column' => 'loginId',
            'type' => 'String',
            'require' => true,
        ),
        'delFlg' => array(
            'name' => '删除标志',
            'column' => 'delFlg',
            'type' => 'String',
            'require' => false,
        ),
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
            'require' => false,
        ),
    ),

    'response' => array(),

);