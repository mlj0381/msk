<?php
/**
 * 产品信息---------------IPD141115
 */
$remote['b2c_product_info'] = array(
    'url' => '/pd/pdBidInfo',

    'request' => array(
        'member_id' => array(
            'name' => '登陆的用户ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
    ),

    'response' => array(
        'pdList' => array(
            'name' => '产品信息列表',
            'column' => 'pdList',
            'type' => 'List',
        ),
    ),

    'pdList' => array(
        'productCode' => array(
            'name' => '9位复合编码（产品分类编码+二级分类编码+产品品种编码+产品特征编码+产品净重编码）',
            'column' => 'productCode',
            'type' => 'String',
        ),
        'productName' => array(
            'name' => '产品名称',
            'column' => 'productName',
            'type' => 'String',
        ),
        'countryCode' => array(
            'name' => '产品国家编码',
            'column' => 'countryCode',
            'type' => 'String',
        ),
        'classesCode' => array(
            'name' => '产品分类编码 （返回单独编码，防止产品编码以后定义变更）',
            'column' => 'classesCode',
            'type' => 'String',
        ),
        'machiningCode' => array(
            'name' => '二级分类编码（返回单独编码，防止产品编码以后定义变更）',
            'column' => 'machiningCode',
            'type' => 'String',
        ),
        'breedCode' => array(
            'name' => '产品品种编码（返回单独编码，防止产品编码以后定义变更）',
            'column' => 'breedCode',
            'type' => 'String',
        ),
        'featureCode' => array(
            'name' => '产品特征编码（返回单独编码，防止产品编码以后定义变更）',
            'column' => 'featureCode',
            'type' => 'String',
        ),
        'weightCode' => array(
            'name' => '产品净重编码（返回单独编码，防止产品编码以后定义变更）',
            'column' => 'weightCode',
            'type' => 'String',
        ),
        'pkgCode' => array(
            'name' => '包装规格编码',
            'column' => 'pkgCode',
            'type' => 'String',
        ),
        'productSpec' => array(
            'name' => '产品规格(产品特征名)',
            'column' => 'productSpec',
            'type' => 'String',
        ),
        'pkgSpec' => array(
            'name' => '包装规格',
            'column' => 'pkgSpec',
            'type' => 'String',
        ),
        'netWeight' => array(
            'name' => '净重',
            'column' => 'netWeight',
            'type' => 'Decimal',
        ),
    ),

);