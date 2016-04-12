<?php
/**
 * 卖家申请新产品品种/特征/净重---------------ISL231172
 */
$remote['seller_apply_for_sku'] = array(
    'url' => '/sl/slInfo/slPd/newPdBFW',

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
        'newPdBFWList' => array(
            'name' => '卖家申请新产品品种 特征 净重List',
            'column' => 'newPdBFWList',
            'type' => 'List',
            'require' => false,
        ),
    ),

    'newPdBFWList' => array(
        'newFlag' => array(
            'name' => '1品种 2特征 3净重',
            'column' => 'newFlag',
            'type' => 'String',
            'require' => true,
        ),
        'classesCode' => array(
            'name' => '产品一级分类CODE',
            'column' => 'classesCode',
            'type' => 'String',
            'require' => true,
        ),
        'classesName' => array(
            'name' => '产品一级分类名称',
            'column' => 'classesName',
            'type' => 'String',
            'require' => true,
        ),
        'machiningCode' => array(
            'name' => '产品二级分类CODE',
            'column' => 'machiningCode',
            'type' => 'String',
            'require' => true,
        ),
        'machiningName' => array(
            'name' => '产品二级分类名称',
            'column' => 'machiningName',
            'type' => 'String',
            'require' => true,
        ),
        'breedCode' => array(
            'name' => '品种编码',
            'column' => 'breedCode',
            'type' => 'String',
            'require' => false,
        ),
        'breedName' => array(
            'name' => '品种名称',
            'column' => 'breedName',
            'type' => 'String',
            'require' => false,
        ),
        'featureCode' => array(
            'name' => '产品特征编码',
            'column' => 'featureCode',
            'type' => 'String',
            'require' => false,
        ),
        'featureName' => array(
            'name' => '产品特征名称',
            'column' => 'featureName',
            'type' => 'String',
            'require' => true,
        ),
        'weightName' => array(
            'name' => '净重名称',
            'column' => 'weightName',
            'type' => 'String',
            'require' => false,
        ),
        'weightVal' => array(
            'name' => '净重数值',
            'column' => 'weightVal',
            'type' => 'BigDecimal',
            'require' => false,
        ),
        'crtId' => array(
            'name' => '创建者ID',
            'column' => 'crtId',
            'type' => 'String',
            'require' => true,
        ),
    ),

    'response' => array(),

);