<?php
/**
 * 卖家申请新产品包装---------------ISL231172
 */
$remote['seller_apply_for_packaging'] = array(
    'url' => '/sl/slInfo/slPd/newPdPkg',

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
        'newPdPkgList' => array(
            'name' => '卖家申请新产品包装List',
            'column' => 'newPdPkgList',
            'type' => 'List',
            'require' => true
        ),
    ),

    'newPdPkgList' => array(
        'classesCode' => array(
            'name' => '产品一级分类CODE',
            'column' => 'classesCode',
            'type' => 'String',
            'require' => true
        ),
        'classesName' => array(
            'name' => '产品一级分类名称',
            'column' => 'classesName',
            'type' => 'String',
            'require' => true
        ),
        'machiningCode' => array(
            'name' => '产品二级分类CODE',
            'column' => 'machiningCode',
            'type' => 'String',
            'require' => true
        ),
        'machiningName' => array(
            'name' => '产品二级分类名称',
            'column' => 'machiningName',
            'type' => 'String',
            'require' => true
        ),
        'breedCode' => array(
            'name' => '品种编码',
            'column' => 'breedCode',
            'type' => 'String',
            'require' => true
        ),
        'breedName' => array(
            'name' => '品种名称',
            'column' => 'breedName',
            'type' => 'String',
            'require' => true
        ),
        'featureCode' => array(
            'name' => '产品特征编码',
            'column' => 'featureCode',
            'type' => 'String',
            'require' => true
        ),
        'featureName' => array(
            'name' => '产品特征名称',
            'column' => 'featureName',
            'type' => 'String',
            'require' => true
        ),
        'weightCode' => array(
            'name' => '净重编码',
            'column' => 'weightCode',
            'type' => 'String',
            'require' => true
        ),
        'weightName' => array(
            'name' => '净重名称',
            'column' => 'weightName',
            'type' => 'String',
            'require' => true
        ),
        'weightVal' => array(
            'name' => '净重数值',
            'column' => 'weightVal',
            'type' => 'decimal',
            'require' => true
        ),
        'normsCode' => array(
            'name' => '包装编码',
            'column' => 'normsCode',
            'type' => 'String',
            'require' => true
        ),
        'normsName' => array(
            'name' => '包装名称',
            'column' => 'normsName',
            'type' => 'String',
            'require' => true
        ),
        'normsSuttle' => array(
            'name' => '单个产品净重',
            'column' => 'normsSuttle',
            'type' => 'String',
            'require' => true
        ),
        'normsError' => array(
            'name' => '单个产品规格净重误差范围',
            'column' => 'normsError',
            'type' => 'String',
            'require' => true
        ),
        'normsNumber' => array(
            'name' => '内包装净重/个数',
            'column' => 'normsNumber',
            'type' => 'String',
            'require' => true
        ),
        'normsSize' => array(
            'name' => '内包装尺寸',
            'column' => 'normsSize',
            'type' => 'String',
            'require' => true
        ),
        'normsTexture' => array(
            'name' => '内包装材质及技术标准',
            'column' => 'normsTexture',
            'type' => 'String',
            'require' => true
        ),
        'normsOut' => array(
            'name' => '外包装规格',
            'column' => 'normsOut',
            'type' => 'String',
            'require' => true
        ),
        'normsKg' => array(
            'name' => '外包装净重/毛重',
            'column' => 'normsKg',
            'type' => 'String',
            'require' => true
        ),
        'normsOutSize' => array(
            'name' => '外包装尺寸',
            'column' => 'normsOutSize',
            'type' => 'String',
            'require' => true
        ),
        'normsOutTexture' => array(
            'name' => '外包装材质及技术标准',
            'column' => 'normsOutTexture',
            'type' => 'String',
            'require' => true
        ),
        'normsTen' => array(
            'name' => '其他包装信息',
            'column' => 'normsTen',
            'type' => 'String',
            'require' => true
        ),
        'normsLength' => array(
            'name' => '外包装长',
            'column' => 'normsLength',
            'type' => 'BigDecimal',
            'require' => true
        ),
        'normsWidth' => array(
            'name' => '外包装宽',
            'column' => 'normsWidth',
            'type' => 'BigDecimal',
            'require' => true
        ),
        'normsHeight' => array(
            'name' => '外包装高',
            'column' => 'normsHeight',
            'type' => 'BigDecimal',
            'require' => true
        ),
        'normsVolume' => array(
            'name' => '外包装体积',
            'column' => 'normsVolume',
            'type' => 'BigDecimal',
            'require' => true
        ),
        'netweightInner' => array(
            'name' => '内包装净重数值',
            'column' => 'netweightInner',
            'type' => 'BigDecimal',
            'require' => true
        ),
        'netweightOut' => array(
            'name' => '外包装净重数值',
            'column' => 'netweightOut',
            'type' => 'BigDecimal',
            'require' => true
        ),
        'crtId' => array(
            'name' => '创建者ID',
            'column' => 'crtId',
            'type' => 'String',
            'require' => true
        ),
    ),

    'response' => array(),

);