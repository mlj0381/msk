<?php
/**
 * 查询买手信息---------------IBS2101103
 */
$remote['buyer_select_buyer_info'] = array(
    'url' => '/bs/slInfo/slAccount/search',

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
        'login_account' => array(
            'name' => '买手账号',
            'column' => 'slAccount',
            'type' => 'String',
            'require' => false,
        ),
        'password' => array(
            'name' => '登录密码',
            'column' => 'accountPsd',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'response' => array(
        'buyershopList' => array(
            'name' => '买手列表',
            'column' => 'buyershopList',
            'type' => 'List',
        ),
    ),
    'buyershopList' => array(
    	'slCode' => array(
    		'name' => '买手code',
    		'column' => 'buyer_code',
    		'type' => 'String',
    	),
    	'slCodeDis' => array(
    			'name' => '买手code',
    			'column' => 'buyer_codedis',
    			'type' => 'String',
    	),
        'slAccount' => array(
            'name' => '卖家账号',
            'column' => 'login_account',
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
        'authStatus' => array(
            'name' => '认证状态',
            'column' => 'authStatus',
            'type' => 'Integer',
        ),
        'fromFlg' => array(
            'name' => '注册来源',
            'column' => 'fromFlg',
            'type' => 'String',
        ),
        'slCode' => array(
            'name' => '买手编码',
            'column' => 'buyer_code',
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
        'slIdcard' => array(
            'name' => '买手身份证号',
            'column' => 'slIdcard',
            'type' => 'String',
        ),
        'slSort' => array(
            'name' => '合营优先顺方式',
            'column' => 'slSort',
            'type' => 'int',
        ),
        'slAddress' => array(
            'name' => '买手地址',
            'column' => 'slAddress',
            'type' => 'String',
        ),
        'slMainClass' => array(
            'name' => '卖家主分类',
            'column' => 'slMainClass',
            'type' => 'Integer',
        ),
        'snkFlg' => array(
            'name' => '神农客标志',
            'column' => 'snkFlg',
            'type' => 'String',
        ),
        'selfFlg' => array(
            'name' => '自产型卖家标志',
            'column' => 'selfFlg',
            'type' => 'String',
        ),
        'agentFlg' => array(
            'name' => '代理型卖家标志',
            'column' => 'agentFlg',
            'type' => 'String',
        ),
        'oemFlg' => array(
            'name' => 'OEM型卖家标志',
            'column' => 'oemFlg',
            'type' => 'String',
        ),
        'buyerFlg' => array(
            'name' => '买手型卖家标志',
            'column' => 'buyerFlg',
            'type' => 'String',
        ),
        'memo1' => array(
            'name' => '微信号码',
            'column' => 'memo1',
            'type' => 'String',
        ),
        'memo2' => array(
            'name' => 'QQ号码',
            'column' => 'memo2',
            'type' => 'String',
        ),
        'memo3' => array(
            'name' => '邮箱',
            'column' => 'memo3',
            'type' => 'String',
        ),
        'memo4' => array(
            'name' => '固定电话',
            'column' => 'memo4',
            'type' => 'String',
        ),
        'memo5' => array(
            'name' => '传真号',
            'column' => 'memo5',
            'type' => 'String',
        ),
        'memo6' => array(
            'name' => '买手类型',
            'column' => 'memo6',
            'type' => 'String',
        ),
        'memo7' => array(
            'name' => '备用字段7',
            'column' => 'memo7',
            'type' => 'String',
        ),
        'memo8' => array(
            'name' => '备用字段8',
            'column' => 'memo8',
            'type' => 'String',
        ),
        'memo9' => array(
            'name' => '备用字段9',
            'column' => 'memo9',
            'type' => 'String',
        ),
        'memo10' => array(
            'name' => '备用字段10',
            'column' => 'memo10',
            'type' => 'String',
        ),
        'memo11' => array(
            'name' => '备用字段11',
            'column' => 'memo11',
            'type' => 'String',
        ),
        'memo12' => array(
            'name' => '备用字段12',
            'column' => 'memo12',
            'type' => 'String',
        ),
        'memo13' => array(
            'name' => '备用字段13',
            'column' => 'memo13',
            'type' => 'String',
        ),
        'memo14' => array(
            'name' => '备用字段14',
            'column' => 'memo14',
            'type' => 'String',
        ),
        'memo15' => array(
            'name' => '备用字段15',
            'column' => 'memo15',
            'type' => 'String',
        ),
        'memo16' => array(
            'name' => '备用字段16',
            'column' => 'memo16',
            'type' => 'String',
        ),
        'memo17' => array(
            'name' => '备用字段17',
            'column' => 'memo17',
            'type' => 'String',
        ),
        'memo18' => array(
            'name' => '备用字段18',
            'column' => 'memo18',
            'type' => 'String',
        ),
        'memo19' => array(
            'name' => '备用字段19',
            'column' => 'memo19',
            'type' => 'String',
        ),
        'memo20' => array(
            'name' => '备用字段20',
            'column' => 'memo20',
            'type' => 'String',
        ),
        'flag1' => array(
            'name' => '性别',
            'column' => 'flag1',
            'type' => 'String',
        ),
        'flag2' => array(
            'name' => '备用字段2',
            'column' => 'flag2',
            'type' => 'String',
        ),
        'flag3' => array(
            'name' => '备用字段3',
            'column' => 'flag3',
            'type' => 'String',
        ),
        'flag4' => array(
            'name' => '备用字段4',
            'column' => 'flag4',
            'type' => 'String',
        ),
        'flag5' => array(
            'name' => '备用字段5',
            'column' => 'flag5',
            'type' => 'String',
        ),
        'flag6' => array(
            'name' => '备用字段6',
            'column' => 'flag6',
            'type' => 'String',
        ),
        'flag7' => array(
            'name' => '备用字段7',
            'column' => 'flag7',
            'type' => 'String',
        ),
        'flag8' => array(
            'name' => '备用字段8',
            'column' => 'flag8',
            'type' => 'String',
        ),
        'flag9' => array(
            'name' => '备用字段9',
            'column' => 'flag9',
            'type' => 'String',
        ),
        'flag10' => array(
            'name' => '备用字段10',
            'column' => 'flag10',
            'type' => 'String',
        ),
        'shopId' => array(
            'name' => '店铺ID',
            'column' => 'shop_id',
            'type' => 'Integer',
        ),
        'shopName' => array(
            'name' => '店铺名称',
            'column' => 'shopName',
            'type' => 'String',
        ),
        'shopLogo' => array(
            'name' => '店铺Logo',
            'column' => 'shopLogo',
            'type' => 'String',
        ),
        'managingCharact10' => array(
            'name' => '经营特色10',
            'column' => 'managingCharact10',
            'type' => 'String',
        ),
        'managingCharact9' => array(
            'name' => '经营特色9',
            'column' => 'managingCharact9',
            'type' => 'String',
        ),
        'managingCharact8' => array(
            'name' => '经营特色8',
            'column' => 'managingCharact8',
            'type' => 'String',
        ),
        'managingCharact7' => array(
            'name' => '经营特色7',
            'column' => 'managingCharact7',
            'type' => 'String',
        ),
        'managingCharact6' => array(
            'name' => '经营特色6',
            'column' => 'managingCharact6',
            'type' => 'String',
        ),
        'managingCharact5' => array(
            'name' => '经营特色5',
            'column' => 'managingCharact5',
            'type' => 'String',
        ),
        'managingCharact4' => array(
            'name' => '经营特色4',
            'column' => 'managingCharact4',
            'type' => 'String',
        ),
        'managingCharact3' => array(
            'name' => '经营特色3',
            'column' => 'managingCharact3',
            'type' => 'String',
        ),
        'managingCharact2' => array(
            'name' => '经营特色2',
            'column' => 'managingCharact2',
            'type' => 'String',
        ),
        'managingCharact1' => array(
            'name' => '经营特色1',
            'column' => 'managingCharact1',
            'type' => 'String',
        ),
        'shopFlag30' => array(
            'name' => '备用30',
            'column' => 'shopFlag30',
            'type' => 'String',
        ),
        'shopFlag29' => array(
            'name' => '备用29',
            'column' => 'shopFlag29',
            'type' => 'String',
        ),
        'shopFlag28' => array(
            'name' => '备用28',
            'column' => 'shopFlag28',
            'type' => 'String',
        ),
        'shopFlag27' => array(
            'name' => '备用27',
            'column' => 'shopFlag27',
            'type' => 'String',
        ),
        'shopFlag26' => array(
            'name' => '备用26',
            'column' => 'shopFlag26',
            'type' => 'String',
        ),
        'shopFlag25' => array(
            'name' => '备用25',
            'column' => 'shopFlag25',
            'type' => 'String',
        ),
        'shopFlag24' => array(
            'name' => '备用24',
            'column' => 'shopFlag24',
            'type' => 'String',
        ),
        'shopFlag23' => array(
            'name' => '备用23',
            'column' => 'shopFlag23',
            'type' => 'String',
        ),
        'shopFlag22' => array(
            'name' => '备用22',
            'column' => 'shopFlag22',
            'type' => 'String',
        ),
        'shopFlag21' => array(
            'name' => '备用21',
            'column' => 'shopFlag21',
            'type' => 'String',
        ),
        'shopFlag20' => array(
            'name' => '备用20',
            'column' => 'shopFlag20',
            'type' => 'String',
        ),
        'shopFlag19' => array(
            'name' => '备用19',
            'column' => 'shopFlag19',
            'type' => 'String',
        ),
        'shopFlag18' => array(
            'name' => '备用18',
            'column' => 'shopFlag18',
            'type' => 'String',
        ),
        'shopFlag17' => array(
            'name' => '备用17',
            'column' => 'shopFlag17',
            'type' => 'String',
        ),
        'shopFlag16' => array(
            'name' => '备用16',
            'column' => 'shopFlag16',
            'type' => 'String',
        ),
        'shopFlag15' => array(
            'name' => '备用15',
            'column' => 'shopFlag15',
            'type' => 'String',
        ),
        'shopFlag14' => array(
            'name' => '备用14',
            'column' => 'shopFlag14',
            'type' => 'String',
        ),
        'shopFlag13' => array(
            'name' => '备用13',
            'column' => 'shopFlag13',
            'type' => 'String',
        ),
        'shopFlag12' => array(
            'name' => '备用12',
            'column' => 'shopFlag12',
            'type' => 'String',
        ),
        'shopFlag11' => array(
            'name' => '备用11',
            'column' => 'shopFlag11',
            'type' => 'String',
        ),
        'shopFlag10' => array(
            'name' => '备用10',
            'column' => 'shopFlag10',
            'type' => 'String',
        ),
        'shopFlag9' => array(
            'name' => '备用9',
            'column' => 'shopFlag9',
            'type' => 'String',
        ),
        'shopFlag8' => array(
            'name' => '备用8',
            'column' => 'shopFlag8',
            'type' => 'String',
        ),
        'shopFlag7' => array(
            'name' => '备用7',
            'column' => 'shopFlag7',
            'type' => 'String',
        ),
        'shopFlag6' => array(
            'name' => '备用6',
            'column' => 'shopFlag6',
            'type' => 'String',
        ),
        'shopFlag5' => array(
            'name' => '备用5',
            'column' => 'shopFlag5',
            'type' => 'String',
        ),
        'shopFlag4' => array(
            'name' => '备用4',
            'column' => 'shopFlag4',
            'type' => 'String',
        ),
        'shopFlag3' => array(
            'name' => '备用3',
            'column' => 'shopFlag3',
            'type' => 'String',
        ),
        'shopFlag2' => array(
            'name' => '备用2',
            'column' => 'shopFlag2',
            'type' => 'String',
        ),
        'shopFlag1' => array(
            'name' => '备用1',
            'column' => 'shopFlag1',
            'type' => 'String',
        ),
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),
    ),

);