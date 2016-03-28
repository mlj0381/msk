<?php
/**
 * 查询冻品管家信息---------------IBS2101105
 */
$remote['freeze_select_freeze_info'] = array(
    'url' => '/bs/slInfo/houseAccount/search',

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
        'slCode' => array(
            'name' => '买手店编码',
            'column' => 'slCode',
            'type' => 'String',
            'require' => false,
        ),
        'houseAccount' => array(
            'name' => '管家账号',
            'column' => 'houseAccount',
            'type' => 'String',
            'require' => false,
        ),
        'accountPsd' => array(
            'name' => '登录密码',
            'column' => 'accountPsd',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'response' => array(
        'houseList' => array(
            'name' => '管家列表',
            'column' => 'houseList',
            'type' => 'List',
        ),
    ),

    'houseList' => array(
        'slCode' => array(
            'name' => '买手店编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'houseAccount' => array(
            'name' => '管家账号',
            'column' => 'houseAccount',
            'type' => 'String',
        ),
        'houseCode' => array(
            'name' => '用于登录的卖家账号',
            'column' => 'houseCode',
            'type' => 'String',
        ),
        'houseTel' => array(
            'name' => '登录手机号码',
            'column' => 'houseTel',
            'type' => 'String',
        ),
        'houseShowName' => array(
            'name' => '卖家显示名称',
            'column' => 'houseShowName',
            'type' => 'String',
        ),
        'houseContact' => array(
            'name' => '联系人姓名',
            'column' => 'houseContact',
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
        'slIdcard' => array(
            'name' => '管家身份证号',
            'column' => 'slIdcard',
            'type' => 'String',
        ),
        'slConFlg' => array(
            'name' => '国籍',
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
        'houseAddress' => array(
            'name' => '管家地址',
            'column' => 'houseAddress',
            'type' => 'String',
        ),
        'lat' => array(
            'name' => '维度',
            'column' => 'lat',
            'type' => 'String',
        ),
        'lon' => array(
            'name' => '精度',
            'column' => 'lon',
            'type' => 'String',
        ),
        'vareaCode' => array(
            'name' => '虚拟大区编码',
            'column' => 'vareaCode',
            'type' => 'String',
        ),
        'vlgcsAreaCode' => array(
            'name' => '虚拟物流区编码',
            'column' => 'vlgcsAreaCode',
            'type' => 'String',
        ),
        'vprovinceCode' => array(
            'name' => '虚拟省编码',
            'column' => 'vprovinceCode',
            'type' => 'String',
        ),
        'vcityCode' => array(
            'name' => '虚拟地区编码',
            'column' => 'vcityCode',
            'type' => 'String',
        ),
        'vdistrictCode' => array(
            'name' => '虚拟区编码',
            'column' => 'vdistrictCode',
            'type' => 'String',
        ),
        'vhouseAddress' => array(
            'name' => '虚拟管家地址',
            'column' => 'vhouseAddress',
            'type' => 'String',
        ),
        'vlat' => array(
            'name' => '虚拟维度',
            'column' => 'vlat',
            'type' => 'String',
        ),
        'vlon' => array(
            'name' => '虚拟精度',
            'column' => 'vlon',
            'type' => 'String',
        ),
        'licenses' => array(
            'name' => '1:专业冻品管家资格未申请 2:专业冻品管家资格申请中',
            'column' => 'licenses',
            'type' => 'String',
        ),
        'buyerAsign' => array(
            'name' => '买手签署',
            'column' => 'buyerAsign',
            'type' => 'String',
        ),
        'wechat' => array(
            'name' => '微信号码',
            'column' => 'wechat',
            'type' => 'String',
        ),
        'qq' => array(
            'name' => 'QQ号码',
            'column' => 'qq',
            'type' => 'String',
        ),
        'email' => array(
            'name' => '邮箱',
            'column' => 'email',
            'type' => 'String',
        ),
        'fixedTel' => array(
            'name' => '固定电话',
            'column' => 'fixedTel',
            'type' => 'String',
        ),
        'fax' => array(
            'name' => '传真号',
            'column' => 'fax',
            'type' => 'String',
        ),
        'flag1' => array(
            'name' => '备用1',
            'column' => 'flag1',
            'type' => 'String',
        ),
        'flag2' => array(
            'name' => '备用2',
            'column' => 'flag2',
            'type' => 'String',
        ),
        'flag3' => array(
            'name' => '备用3',
            'column' => 'flag3',
            'type' => 'String',
        ),
        'flag4' => array(
            'name' => '备用4',
            'column' => 'flag4',
            'type' => 'String',
        ),
        'flag5' => array(
            'name' => '备用5',
            'column' => 'flag5',
            'type' => 'String',
        ),
        'flag6' => array(
            'name' => '备用6',
            'column' => 'flag6',
            'type' => 'String',
        ),
        'flag7' => array(
            'name' => '备用7',
            'column' => 'flag7',
            'type' => 'String',
        ),
        'flag8' => array(
            'name' => '备用8',
            'column' => 'flag8',
            'type' => 'String',
        ),
        'flag9' => array(
            'name' => '备用9',
            'column' => 'flag9',
            'type' => 'String',
        ),
        'flag10' => array(
            'name' => '备用10',
            'column' => 'flag10',
            'type' => 'String',
        ),
        'flag11' => array(
            'name' => '备用11',
            'column' => 'flag11',
            'type' => 'String',
        ),
        'flag12' => array(
            'name' => '备用12',
            'column' => 'flag12',
            'type' => 'String',
        ),
        'flag13' => array(
            'name' => '备用13',
            'column' => 'flag13',
            'type' => 'String',
        ),
        'flag14' => array(
            'name' => '备用14',
            'column' => 'flag14',
            'type' => 'String',
        ),
        'flag15' => array(
            'name' => '备用15',
            'column' => 'flag15',
            'type' => 'String',
        ),
        'flag16' => array(
            'name' => '备用16',
            'column' => 'flag16',
            'type' => 'String',
        ),
        'flag17' => array(
            'name' => '备用17',
            'column' => 'flag17',
            'type' => 'String',
        ),
        'flag18' => array(
            'name' => '备用18',
            'column' => 'flag18',
            'type' => 'String',
        ),
        'flag19' => array(
            'name' => '备用19',
            'column' => 'flag19',
            'type' => 'String',
        ),
        'flag20' => array(
            'name' => '备用20',
            'column' => 'flag20',
            'type' => 'String',
        ),
        'houseIntroduce' => array(
            'name' => '管家介绍',
            'column' => 'houseIntroduce',
            'type' => 'String',
        ),
        'houseClass' => array(
            'name' => '级别',
            'column' => 'houseClass',
            'type' => 'String',
        ),
        'houseCategory' => array(
            'name' => '管家分类',
            'column' => 'houseCategory',
            'type' => 'String',
        ),
        'houseCategory0' => array(
            'name' => '管家分类基本',
            'column' => 'houseCategory0',
            'type' => 'String',
        ),
        'houseCategory1' => array(
            'name' => '管家分类分销',
            'column' => 'houseCategory1',
            'type' => 'String',
        ),
        'houseCategory2' => array(
            'name' => '管家分类菜场',
            'column' => 'houseCategory2',
            'type' => 'String',
        ),
        'houseCategory3' => array(
            'name' => '管家分类团膳',
            'column' => 'houseCategory3',
            'type' => 'String',
        ),
        'houseCategory4' => array(
            'name' => '管家分类火锅',
            'column' => 'houseCategory4',
            'type' => 'String',
        ),
        'houseCategory5' => array(
            'name' => '管家分类中餐',
            'column' => 'houseCategory5',
            'type' => 'String',
        ),
        'houseCategory6' => array(
            'name' => '管家分类西餐',
            'column' => 'houseCategory6',
            'type' => 'String',
        ),
        'houseCategory7' => array(
            'name' => '管家分类小吃烧烤',
            'column' => 'houseCategory7',
            'type' => 'String',
        ),
        'houseCategory8' => array(
            'name' => '管家分类加工厂',
            'column' => 'houseCategory8',
            'type' => 'String',
        ),
        'greade' => array(
            'name' => '等级',
            'column' => 'greade',
            'type' => 'Integer',
        ),
        'loginId' => array(
            'name' => '创建者ID/更新者ID',
            'column' => 'loginId',
            'type' => 'String',
        ),
        'delFlg' => array(
            'name' => '删除标志',
            'column' => 'delFlg',
            'type' => 'String',
        ),
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),
        'slAreaList' => array(
            'name' => '经营区域List',
            'column' => 'slAreaList',
            'type' => 'List',
        ),
        'housePdList' => array(
            'name' => '',
            'column' => 'housePdList',
            'type' => 'List',
        ),
    ),

    'slAreaList' => array(
        'slAreaId' => array(
            'name' => '经营区域ID',
            'column' => 'slAreaId',
            'type' => 'Integer',
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
        'address' => array(
            'name' => '经营地址',
            'column' => 'address',
            'type' => 'String',
        ),
    ),

    'housePdList' => array(
        'pdId' => array(
            'name' => '管家管理产品ID',
            'column' => 'pdId',
            'type' => 'Integer',
        ),
        'pdClassesCode' => array(
            'name' => '产品类别',
            'column' => 'pdClassesCode',
            'type' => 'String',
        ),
        'machiningCode' => array(
            'name' => '产品二级分类编码',
            'column' => 'machiningCode',
            'type' => 'String',
        ),
        'pdBreedCode' => array(
            'name' => '产品品种',
            'column' => 'pdBreedCode',
            'type' => 'String',
        ),
        'pdFeatureCode' => array(
            'name' => '产品特征',
            'column' => 'pdFeatureCode',
            'type' => 'String',
        ),
    ),
);