<?php
/**
 * 编辑买手信息---------------IBS2101102
 */
$remote['buyer_edit_buyer_info'] = array(
    'url' => '/bs/slInfo/slAccount/newOrUpdate',

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
        'slAccount' => array(
            'name' => '卖家账号',
            'column' => 'slAccount',
            'type' => 'String',
            'require' => true,
        ),
        'slTel' => array(
            'name' => '登录手机号码',
            'column' => 'slTel',
            'type' => 'String',
            'require' => true,
        ),
        'slShowName' => array(
            'name' => '卖家显示名称',
            'column' => 'slShowName',
            'type' => 'String',
            'require' => false,
        ),
        'slContact' => array(
            'name' => '联系人姓名',
            'column' => 'slContact',
            'type' => 'String',
            'require' => true,
        ),
        'accountPsd' => array(
            'name' => '登录密码',
            'column' => 'accountPsd',
            'type' => 'String',
            'require' => true,
        ),
        'authStatus' => array(
            'name' => '认证状态',
            'column' => 'authStatus',
            'type' => 'Integer',
            'require' => false,
        ),
        'fromFlg' => array(
            'name' => '注册来源',
            'column' => 'fromFlg',
            'type' => 'String',
            'require' => false,
        ),
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
            'require' => false,
        ),
        'slConFlg' => array(
            'name' => '生产国籍',
            'column' => 'slConFlg',
            'type' => 'String',
            'require' => true,
        ),
        'areaCode' => array(
            'name' => '大区编码',
            'column' => 'areaCode',
            'type' => 'String',
            'require' => true,
        ),
        'lgcsAreaCode' => array(
            'name' => '物流区编码',
            'column' => 'lgcsAreaCode',
            'type' => 'String',
            'require' => true,
        ),
        'provinceCode' => array(
            'name' => '省编码',
            'column' => 'provinceCode',
            'type' => 'String',
            'require' => true,
        ),
        'cityCode' => array(
            'name' => '地区编码',
            'column' => 'cityCode',
            'type' => 'String',
            'require' => true,
        ),
        'districtCode' => array(
            'name' => '区编码',
            'column' => 'districtCode',
            'type' => 'String',
            'require' => true,
        ),
        'slIdcard' => array(
            'name' => '买手身份证号',
            'column' => 'slIdcard',
            'type' => 'String',
            'require' => true,
        ),
        'slSort' => array(
            'name' => '合营优先顺方式',
            'column' => 'slSort',
            'type' => 'int',
            'require' => true,
        ),
        'slAddress' => array(
            'name' => '买手地址',
            'column' => 'slAddress',
            'type' => 'String',
            'require' => true,
        ),
        'slMainClass' => array(
            'name' => '卖家主分类',
            'column' => 'slMainClass',
            'type' => 'Integer',
            'require' => true,
        ),
        'snkFlg' => array(
            'name' => '神农客标志',
            'column' => 'snkFlg',
            'type' => 'String',
            'default' => '1.是',
            'require' => true,
        ),
        'selfFlg' => array(
            'name' => '自产型卖家标志',
            'column' => 'selfFlg',
            'type' => 'String',
            'default' => '1.是',
            'require' => true,
        ),
        'agentFlg' => array(
            'name' => '代理型卖家标志',
            'column' => 'agentFlg',
            'type' => 'String',
            'default' => '1.是',
            'require' => true,
        ),
        'oemFlg' => array(
            'name' => 'OEM型卖家标志',
            'column' => 'oemFlg',
            'type' => 'String',
            'default' => '1.是',
            'require' => true,
        ),
        'buyerFlg' => array(
            'name' => '买手型卖家标志',
            'column' => 'buyerFlg',
            'type' => 'String',
            'default' => '1.是',
            'require' => true,
        ),
        'memo1' => array(
            'name' => '微信号码',
            'column' => 'memo1',
            'type' => 'String',
            'require' => false,
        ),
        'memo2' => array(
            'name' => 'QQ号码',
            'column' => 'memo2',
            'type' => 'String',
            'require' => false,
        ),
        'memo3' => array(
            'name' => '邮箱',
            'column' => 'memo3',
            'type' => 'String',
            'require' => false,
        ),
        'memo4' => array(
            'name' => '固定电话',
            'column' => 'memo4',
            'type' => 'String',
            'require' => false,
        ),
        'memo5' => array(
            'name' => '传真号',
            'column' => 'memo5',
            'type' => 'String',
            'require' => false,
        ),
        'memo6' => array(
            'name' => '买手类型',
            'column' => 'memo6',
            'type' => 'String',
            'require' => false,
        ),
        'memo7' => array(
            'name' => '备用字段7',
            'column' => 'memo7',
            'type' => 'String',
            'require' => false,
        ),
        'memo8' => array(
            'name' => '备用字段8',
            'column' => 'memo8',
            'type' => 'String',
            'require' => false,
        ),
        'memo9' => array(
            'name' => '备用字段9',
            'column' => 'memo9',
            'type' => 'String',
            'require' => false,
        ),
        'memo10' => array(
            'name' => '备用字段10',
            'column' => 'memo10',
            'type' => 'String',
            'require' => false,
        ),
        'memo11' => array(
            'name' => '备用字段11',
            'column' => 'memo11',
            'type' => 'String',
            'require' => false,
        ),
        'memo12' => array(
            'name' => '备用字段12',
            'column' => 'memo12',
            'type' => 'String',
            'require' => false,
        ),
        'memo13' => array(
            'name' => '备用字段13',
            'column' => 'memo13',
            'type' => 'String',
            'require' => false,
        ),
        'memo14' => array(
            'name' => '备用字段14',
            'column' => 'memo14',
            'type' => 'String',
            'require' => false,
        ),
        'memo15' => array(
            'name' => '备用字段15',
            'column' => 'memo15',
            'type' => 'String',
            'require' => false,
        ),
        'memo16' => array(
            'name' => '备用字段16',
            'column' => 'memo16',
            'type' => 'String',
            'require' => false,
        ),
        'memo17' => array(
            'name' => '备用字段17',
            'column' => 'memo17',
            'type' => 'String',
            'require' => false,
        ),
        'memo18' => array(
            'name' => '备用字段18',
            'column' => 'memo18',
            'type' => 'String',
            'require' => false,
        ),
        'memo19' => array(
            'name' => '备用字段19',
            'column' => 'memo19',
            'type' => 'String',
            'require' => false,
        ),
        'memo20' => array(
            'name' => '备用字段20',
            'column' => 'memo20',
            'type' => 'String',
            'require' => false,
        ),
        'flag1' => array(
            'name' => '性别',
            'column' => 'flag1',
            'type' => 'String',
            'require' => false,
        ),
        'flag2' => array(
            'name' => '备用字段2',
            'column' => 'flag2',
            'type' => 'String',
            'require' => false,
        ),
        'flag3' => array(
            'name' => '备用字段3',
            'column' => 'flag3',
            'type' => 'String',
            'require' => false,
        ),
        'flag4' => array(
            'name' => '备用字段4',
            'column' => 'flag4',
            'type' => 'String',
            'require' => false,
        ),
        'flag5' => array(
            'name' => '备用字段5',
            'column' => 'flag5',
            'type' => 'String',
            'require' => false,
        ),
        'flag6' => array(
            'name' => '备用字段6',
            'column' => 'flag6',
            'type' => 'String',
            'require' => false,
        ),
        'flag7' => array(
            'name' => '备用字段7',
            'column' => 'flag7',
            'type' => 'String',
            'require' => false,
        ),
        'flag8' => array(
            'name' => '备用字段8',
            'column' => 'flag8',
            'type' => 'String',
            'require' => false,
        ),
        'flag9' => array(
            'name' => '备用字段9',
            'column' => 'flag9',
            'type' => 'String',
            'require' => false,
        ),
        'flag10' => array(
            'name' => '备用字段10',
            'column' => 'flag10',
            'type' => 'String',
            'require' => false,
        ),
        'shopId' => array(
            'name' => '店铺ID',
            'column' => 'shopId',
            'type' => 'Integer',
            'require' => false,
        ),
        'shopName' => array(
            'name' => '店铺名称',
            'column' => 'shopName',
            'type' => 'String',
            'require' => false,
        ),
        'shopLogo' => array(
            'name' => '店铺Logo',
            'column' => 'shopLogo',
            'type' => 'String',
            'require' => false,
        ),
        'managingCharact10' => array(
            'name' => '经营特色10',
            'column' => 'managingCharact10',
            'type' => 'String',
            'require' => false,
        ),
        'managingCharact9' => array(
            'name' => '经营特色9',
            'column' => 'managingCharact9',
            'type' => 'String',
            'require' => false,
        ),
        'managingCharact8' => array(
            'name' => '经营特色8',
            'column' => 'managingCharact8',
            'type' => 'String',
            'require' => false,
        ),
        'managingCharact7' => array(
            'name' => '经营特色7',
            'column' => 'managingCharact7',
            'type' => 'String',
            'require' => false,
        ),
        'managingCharact6' => array(
            'name' => '经营特色6',
            'column' => 'managingCharact6',
            'type' => 'String',
            'require' => false,
        ),
        'managingCharact5' => array(
            'name' => '经营特色5',
            'column' => 'managingCharact5',
            'type' => 'String',
            'require' => false,
        ),
        'managingCharact4' => array(
            'name' => '经营特色4',
            'column' => 'managingCharact4',
            'type' => 'String',
            'require' => false,
        ),
        'managingCharact3' => array(
            'name' => '经营特色3',
            'column' => 'managingCharact3',
            'type' => 'String',
            'require' => false,
        ),
        'managingCharact2' => array(
            'name' => '经营特色2',
            'column' => 'managingCharact2',
            'type' => 'String',
            'require' => false,
        ),
        'managingCharact1' => array(
            'name' => '经营特色1',
            'column' => 'managingCharact1',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag30' => array(
            'name' => '备用30',
            'column' => 'shopFlag30',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag29' => array(
            'name' => '备用29',
            'column' => 'shopFlag29',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag28' => array(
            'name' => '备用28',
            'column' => 'shopFlag28',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag27' => array(
            'name' => '备用27',
            'column' => 'shopFlag27',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag26' => array(
            'name' => '备用26',
            'column' => 'shopFlag26',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag25' => array(
            'name' => '备用25',
            'column' => 'shopFlag25',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag24' => array(
            'name' => '备用24',
            'column' => 'shopFlag24',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag23' => array(
            'name' => '备用23',
            'column' => 'shopFlag23',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag22' => array(
            'name' => '备用22',
            'column' => 'shopFlag22',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag21' => array(
            'name' => '备用21',
            'column' => 'shopFlag21',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag20' => array(
            'name' => '备用20',
            'column' => 'shopFlag20',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag19' => array(
            'name' => '备用19',
            'column' => 'shopFlag19',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag18' => array(
            'name' => '备用18',
            'column' => 'shopFlag18',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag17' => array(
            'name' => '备用17',
            'column' => 'shopFlag17',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag16' => array(
            'name' => '备用16',
            'column' => 'shopFlag16',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag15' => array(
            'name' => '备用15',
            'column' => 'shopFlag15',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag14' => array(
            'name' => '备用14',
            'column' => 'shopFlag14',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag13' => array(
            'name' => '备用13',
            'column' => 'shopFlag13',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag12' => array(
            'name' => '备用12',
            'column' => 'shopFlag12',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag11' => array(
            'name' => '备用11',
            'column' => 'shopFlag11',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag10' => array(
            'name' => '备用10',
            'column' => 'shopFlag10',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag9' => array(
            'name' => '备用9',
            'column' => 'shopFlag9',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag8' => array(
            'name' => '备用8',
            'column' => 'shopFlag8',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag7' => array(
            'name' => '备用7',
            'column' => 'shopFlag7',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag6' => array(
            'name' => '备用6',
            'column' => 'shopFlag6',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag5' => array(
            'name' => '备用5',
            'column' => 'shopFlag5',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag4' => array(
            'name' => '备用4',
            'column' => 'shopFlag4',
            'type' => 'String',
            'require' => false,
        ),
        'shopFlag3' => array(
            'name' => '备用3',
            'column' => 'shopFlag3',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'response' => array(),

);