<?php
/**
 * 根据增量时间戳取得卖家或供应商信息数据。---------------ISL231101
 */
$remote['seller_sellerinfo'] = array(
    'url' => '/sl/slInfo',

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

    'param' => array(
        'incrementalTime' => array(
            'name' => 'YYYY-MM-DD HH24:mi:ss',
            'column' => 'incrementalTime',
            'type' => 'String',
            'default' => '',
            'require' => true,
        ),
    ),

    'response' => array(
        'slAccountList' => array(
            'name' => '卖家账号列表',
            'coloumn' => 'slAccountList',
            'type' => 'List',
        ),
    ),

    'slAccountList' => array(
        'slAccount' => array(
            'name' => '卖家账号',
            'column' => 'slAccount',
            'type' => 'String',
        ),
        'slTel' => array(
            'name' => '登录手机号码',
            'column' => 'slTel',
            'type' => 'String',
        ),
        'slShowName' => array(
            'name' => '卖家显示名称',
            'column' => 'slShowName',
            'type' => 'String',
        ),
        'slContact' => array(
            'name' => '联系人姓名',
            'column' => 'slContact',
            'type' => 'String',
        ),
        'accountPsd' => array(
            'name' => '登录密码',
            'column' => 'accountPsd',
            'type' => 'String',
        ),
        'slAreaCode' => array(
            'name' => '卖家所在区划',
            'column' => 'slAreaCode',
            'type' => 'String',
        ),
        'slConFlg' => array(
            'name' => '生产国籍',
            'column' => 'slConFlg',
            'type' => 'String',
        ),
        'areaCode' => array(
            'name' => '大区编码',
            'column' => 'areaCode',
            'type' => 'String',
        ),
        'lgcsAreaCode' => array(
            'name' => '物流区编码',
            'column' => 'lgcsAreaCode',
            'type' => 'String',
        ),
        'provinceCode' => array(
            'name' => '省编码',
            'column' => 'provinceCode',
            'type' => 'String',
        ),
        'cityCode' => array(
            'name' => '地区编码',
            'column' => 'cityCode',
            'type' => 'String',
        ),
        'districtCode' => array(
            'name' => '区编码',
            'column' => 'districtCode',
            'type' => 'String',
        ),
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Number',
        ),
        'epName' => array(
            'name' => '企业名',
            'column' => 'epName',
            'type' => 'String',
        ),
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),
    ),

);