<?php
/**
 * 产品包装分类查询---------------IPD141139
 */
$remote['b2c_select_product_cat6'] = array(
    'url' => '/pd/pd_package',

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

    'param' => array(
        'classesCode' => array(
            'name' => '一级分类编码',
            'column' => 'classesCode',
            'type' => 'String',
            'default' => '',
            'require' => true,
        ),
        'machiningCode' => array(
            'name' => '二级分类编码',
            'column' => 'machiningCode',
            'type' => 'String',
            'default' => '',
            'require' => true,
        ),
        'breedCode' => array(
            'name' => '品种编码',
            'column' => 'breedCode',
            'type' => 'String',
            'default' => '',
            'require' => true,
        ),
        'featureCode' => array(
            'name' => '特征编码',
            'column' => 'featureCode',
            'type' => 'String',
            'default' => '',
            'require' => true,
        ),
        'weightCode' => array(
            'name' => '净重编码',
            'column' => 'weightCode',
            'type' => 'String',
            'default' => '',
            'require' => true,
        ),
    ),

    'response' => array(
        'normsCode' => array(
            'name' => '产品包装编码',
            'column' => 'normsCode',
            'type' => 'String',
        ),
        'normsName' => array(
            'name' => '产品包装规格名称',
            'column' => 'normsName',
            'type' => 'String',
        ),
        'normsSuttle' => array(
            'name' => '单个产品规格净重',
            'column' => 'normsSuttle',
            'type' => 'String',
        ),
        'normsError' => array(
            'name' => '单个产品规格净重误差范围',
            'column' => 'normsError',
            'type' => 'String',
        ),
        'normsNumber' => array(
            'name' => '内包装净重/个数',
            'column' => 'normsNumber',
            'type' => 'String',
        ),
        'normsSize' => array(
            'name' => '内包装尺寸',
            'column' => 'normsSize',
            'type' => 'String',
        ),
        'normsTexture' => array(
            'name' => '内包装材质及技术标准',
            'column' => 'normsTexture',
            'type' => 'String',
        ),
        'normsOut' => array(
            'name' => '外包装规格',
            'column' => 'normsOut',
            'type' => 'String',
        ),
        'normsKg' => array(
            'name' => '外包装净重/毛重',
            'column' => 'normsKg',
            'type' => 'String',
        ),
        'normsOutSize' => array(
            'name' => '外包装尺寸',
            'column' => 'normsOutSize',
            'type' => 'String',
        ),
        'normsOutTexture' => array(
            'name' => '外包装材质及技术标准',
            'column' => 'normsOutTexture',
            'type' => 'String',
        ),

    ),

);