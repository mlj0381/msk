<?php
/**
 * 编辑卖家产品和标准---------------ISL231106
 */
$remote['seller_edit_seller_product'] = array(
    'url' => '/sl/slInfo/slQlt/newOrUpdate',
    'request' => array(
        'member_id' => array(
            'name' => '登陆的用户ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '1',
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
        )
    ),
    'slPdList' => array(
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
            'require' => false,
        ),
        'prodEpId' => array(
            'name' => '生产商企业ID',
            'column' => 'prodEpId',
            'type' => 'Integer',
            'require' => false,
        ),
        'brandEpId' => array(
            'name' => '品牌商企业ID',
            'column' => 'brandEpId',
            'type' => 'Integer',
            'require' => false,
        ),
        'brandId' => array(
            'name' => '产品品牌ID',
            'column' => 'brandId',
            'type' => 'Integer',
            'require' => false,
        ),
        'pdClassesCode' => array(
            'name' => '产品类别',
            'column' => 'pdClassesCode',
            'type' => 'String',
            'require' => false,
        ),
        'machiningCode' => array(
            'name' => '产品二级分类编码',
            'column' => 'machiningCode',
            'type' => 'String',
            'require' => false,
        ),
        'pdBreedCode' => array(
            'name' => '产品品种',
            'column' => 'pdBreedCode',
            'type' => 'String',
            'require' => false,
        ),
        'pdFeatureCode' => array(
            'name' => '产品特征',
            'column' => 'pdFeatureCode',
            'type' => 'String',
            'require' => false,
        ),
        'weightCode' => array(
            'name' => '净重编码',
            'column' => 'weightCode',
            'type' => 'String',
            'require' => false,
        ),
        'distFlg' => array(
            'name' => '是否参与神农客分销，0:否，1:是',
            'column' => 'distFlg',
            'type' => 'String',
            'require' => false,
        ),
        'distmskFlg' => array(
            'name' => '是否参与美侍客分销，0:否，1:是',
            'column' => 'distmskFlg',
            'type' => 'String',
            'require' => false,
        ),
        'loginId' => array(
            'name' => '创建者ID/更新者ID',
            'column' => 'loginId',
            'type' => 'String',
            'require' => false,
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