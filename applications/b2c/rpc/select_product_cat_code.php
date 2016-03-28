<?php
/**
 * 产品主码查询接口---------------IPD141129
 */
$remote['b2c_select_product_cat_code'] = array(
    'url' => '/pd/pd_standard',

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
            'name' => '类别编码：如果传值，则返回指定类别的产品主码，如果没有传值，则返回全部类别的产品主码',
            'column' => 'classesCode',
            'type' => 'String',
            'require' => false,
        ),
        'codeLevel' => array(
            'name' => '希望返回的编码等级:0:返回11位：国家编码2位+产品分类2位+二级分类1位+产品品种2位+产品特征2位+产品净重2位;1：返回5位产品分类2位+二级分类1位+产品品种2位;2：返回7位产品分类2位+二级分类1位+产品品种2位+产品特征2位',
            'column' => 'codeLevel',
            'type' => 'Integer',
            'default' => '0',
            'require' => true,
        ),
    ),

    'response' => array(
        'classesCode' => array(
            'name' => '',
            'column' => 'classesCode',
            'type' => 'String',
        ),
        'classesName' => array(
            'name' => '',
            'column' => 'classesName',
            'type' => 'String',
        ),
        'pdCode' => array(
            'name' => '指定位数产品主码',
            'column' => 'pdCode',
            'type' => 'String',
        ),
        'pdName' => array(
            'name' => '指定位数产品名称',
            'column' => 'pdName',
            'type' => 'String',
        ),
    ),

);