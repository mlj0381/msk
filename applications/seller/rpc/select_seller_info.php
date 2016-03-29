<?php
/**
 * 查询 商家基本信息---------------ISL231181
 */
$remote['seller_select_seller_info'] = array(
    'url' => '/sl/slInfo/searchAll',

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
        ),
    ),

    'param' => array(
        'slAccount' => array(
            'name' => '卖家账号',
            'column' => 'slAccount',
            'type' => 'String',
            'require' => true,
        ),
    ),

    'response' => array(
        'slAccount' => array(
            'name' => '卖家账号信息',
            'column' => 'slAccount',
            'type' => 'Object',
        ),
        'slSeller' => array(
            'name' => '//卖家基本信息',
            'column' => 'slSeller  ',
            'type' => 'Object',
        ),
        'pdClassesCodeList' => array(
            'name' => '产品类别List',
            'column' => 'pdClassesCodeList',
            'type' => 'List',
        ),
        'slEnterprise' => array(
            'name' => '企业基本资质',
            'column' => 'slEnterprise',
            'type' => 'Object',
        ),
        'certInfoList' => array(
            'name' => '企业证照信息List',
            'column' => 'certInfoList',
            'type' => 'List',
        ),
        'slEpHonorList' => array(
            'name' => '企业荣誉信息List',
            'column' => 'slEpHonorList',
            'type' => 'List',
        ),
        'slEpBrandList' => array(
            'name' => '',
            'column' => 'slEpBrandList',
            'type' => 'List',
        ),
        'slEpBrandHonorList' => array(
            'name' => '企业产品品牌荣誉信息List',
            'column' => 'slEpBrandHonorList',
            'type' => 'List',
        ),
        'slPdBrandList' => array(
            'name' => '',
            'column' => 'slPdBrandList',
            'type' => 'List',
        ),
        'slEpWorkshopList' => array(
            'name' => '企业车间List',
            'column' => 'slEpWorkshopList',
            'type' => 'List',
        ),
        'slEpCap' => array(
            'name' => '企业生产能力信息',
            'column' => 'slEpCap',
            'type' => 'Object',
        ),
        'slEpAuthList' => array(
            'name' => '',
            'column' => 'slEpAuthList',
            'type' => 'List',
        ),
        'slEpManagerList' => array(
            'name' => '',
            'column' => 'slEpManagerList',
            'type' => 'List',
        ),
        'slEcTeamList' => array(
            'name' => '',
            'column' => 'slEcTeamList',
            'type' => 'List',
        ),

    ),

    'slAccount' => array(
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
    ),

    'slSeller' => array(
        'slAccount' => array(
            'name' => '卖家账号',
            'column' => 'slAccount',
            'type' => 'String',
        ),
        'slCode' => array(
            'name' => '卖家ID',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'slCodeDis' => array(
            'name' => '卖家编码',
            'column' => 'slCodeDis',
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
        'areaName' => array(
            'name' => '大区名',
            'column' => 'areaName',
            'type' => 'String',
        ),
        'lgcsAreaCode' => array(
            'name' => '物流区编码',
            'column' => 'lgcsAreaCode',
            'type' => 'String',
        ),
        'lgcsAreaName' => array(
            'name' => '物流区名',
            'column' => 'lgcsAreaName',
            'type' => 'String',
        ),
        'provinceCode' => array(
            'name' => '省编码',
            'column' => 'provinceCode',
            'type' => 'String',
        ),
        'provinceName' => array(
            'name' => '省名',
            'column' => 'provinceName',
            'type' => 'String',
        ),
        'cityCode' => array(
            'name' => '地区编码名',
            'column' => 'cityCode',
            'type' => 'String',
        ),
        'cityName' => array(
            'name' => '地区名',
            'column' => 'cityName',
            'type' => 'String',
        ),
        'districtCode' => array(
            'name' => '区编码名',
            'column' => 'districtCode',
            'type' => 'String',
        ),
        'districtName' => array(
            'name' => '区名',
            'column' => 'districtName',
            'type' => 'String',
        ),
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
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
        'sqaStatus' => array(
            'name' => '神农客贯标审核',
            'column' => 'sqaStatus',
            'type' => 'Integer',
        ),
        'distQua' => array(
            'name' => '卖家分销资格',
            'column' => 'distQua',
            'type' => 'Integer',
        ),
        'shopQua' => array(
            'name' => '卖家开店资格',
            'column' => 'shopQua',
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
            'name' => '身份证号',
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
    ),

    'pdClassesCodeList' => array(
        'pdClassesCode' => array(
            'name' => '产品类别',
            'column' => 'pdClassesCode',
            'type' => 'String',
        ),
        'machiningCode' => array(
            'name' => '产品二级分类',
            'column' => 'machiningCode',
            'type' => 'String',
        ),

    ),

    'slEnterprise' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'String',
        ),
        'epName' => array(
            'name' => '企业名称',
            'column' => 'epName',
            'type' => 'String',
        ),
        'licType' => array(
            'name' => '三证合一营业执照标志',
            'column' => 'licType',
            'type' => 'String',
        ),
        'licName' => array(
            'name' => '营业执照_名称',
            'column' => 'licName',
            'type' => 'String',
        ),
        'licNo' => array(
            'name' => '营业执照_注册号',
            'column' => 'licNo',
            'type' => 'String',
        ),
        'licAddr' => array(
            'name' => '营业执照_住所',
            'column' => 'licAddr',
            'type' => 'String',
        ),
        'licBusiType' => array(
            'name' => '营业执照_经营类型',
            'column' => 'licBusiType',
            'type' => 'String',
        ),
        'licBusiScope' => array(
            'name' => '营业执照_经营范围',
            'column' => 'licBusiScope',
            'type' => 'String',
        ),
        'licLegalPerson' => array(
            'name' => '营业执照_法人代表',
            'column' => 'licLegalPerson',
            'type' => 'String',
        ),
        'licRegCapital' => array(
            'name' => '营业执照_注册资本',
            'column' => 'licRegCapital',
            'type' => 'BigDecimal',
        ),
        'licPaidinCapital' => array(
            'name' => '营业执照_实收资本',
            'column' => 'licPaidinCapital',
            'type' => 'BigDecimal',
        ),
        'licCrtDate' => array(
            'name' => '营业执照_成立日期',
            'column' => 'licCrtDate',
            'type' => 'Datetime',
        ),
        'licTermBegin' => array(
            'name' => '营业执照_营业期限开始',
            'column' => 'licTermBegin',
            'type' => 'Datetime',
        ),
        'licTermEnd' => array(
            'name' => '营业执照_营业期限截止',
            'column' => 'licTermEnd',
            'type' => 'Datetime',
        ),
        'licTermUnliimited' => array(
            'name' => '营业执照_营业期限长期标志',
            'column' => 'licTermUnliimited',
            'type' => 'String',
        ),
        'taxNo' => array(
            'name' => '税务登记证_税务登记证号',
            'column' => 'taxNo',
            'type' => 'String',
        ),
        'taxVatNo' => array(
            'name' => '税务登记证_一般增值税纳税人资格认定编号',
            'column' => 'taxVatNo',
            'type' => 'String',
        ),
        'orgNo' => array(
            'name' => '组织机构代码证_代码',
            'column' => 'orgNo',
            'type' => 'String',
        ),
        'orgTermBegin' => array(
            'name' => '组织机构代码证_有效期开始',
            'column' => 'orgTermBegin',
            'type' => 'Datetime',
        ),
        'orgTermEnd' => array(
            'name' => '组织机构代码证_有效期截止',
            'column' => 'orgTermEnd',
            'type' => 'Datetime',
        ),
        'balLegalPerson' => array(
            'name' => '银行开户许可证_法定代表人',
            'column' => 'balLegalPerson',
            'type' => 'String',
        ),
        'balBank' => array(
            'name' => '银行开户许可证_开户银行',
            'column' => 'balBank',
            'type' => 'String',
        ),
        'balAccount' => array(
            'name' => '银行开户许可证_帐号',
            'column' => 'balAccount',
            'type' => 'String',
        ),
        'fdlNo' => array(
            'name' => '食品流通许可证_许可证编号',
            'column' => 'fdlNo',
            'type' => 'String',
        ),
        'fdlTermBegin' => array(
            'name' => '食品流通许可证_有效期开始',
            'column' => 'fdlTermBegin',
            'type' => 'Datetime',
        ),
        'fdlTermEnd' => array(
            'name' => '食品流通许可证_有效期截止',
            'column' => 'fdlTermEnd',
            'type' => 'Datetime',
        ),

    ),

    'certInfoList' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' =>
                'Integer',
        ),
        'certId' => array(
            'name' => '证照ID',
            'column' => 'certId',
            'type' => 'Integer',
        ),
        'certName' => array(
            'name' => '证照名称',
            'column' => 'certName',
            'type' => 'String',
        ),
        'certItemList' => array(
            'name' => '企业证照项目信息List',
            'column' => 'certItemList',
            'type' => 'List',
        ),

    ),

    'certItemList' => array(
        'certId' => array(
            'name' => '证照ID',
            'column' => 'certId',
            'type' => 'Integer',
        ),
        'certItemId' => array(
            'name' => '证照项目ID',
            'column' => 'certItemId',
            'type' => 'Integer',
        ),
        'certItemName' => array(
            'name' => '证照项目名称',
            'column' => 'certItemName',
            'type' => 'String',
        ),
        'certItemValue' => array(
            'name' => '证照项目内容',
            'column' => 'certItemValue',
            'type' => 'String',
        ),

    ),

    'slEpHonorList' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
        ),
        'honorId' => array(
            'name' => '荣誉ID',
            'column' => 'honorId',
            'type' => 'Integer',
        ),
        'honorDesc' => array(
            'name' => '荣誉描述',
            'column' => 'honorDesc',
            'type' => 'String',
        ),
        'certDate' => array(
            'name' => '发证日期',
            'column' => 'certDate',
            'type' => 'Datetime',
        ),
        'certIssuer' => array(
            'name' => '发证单位',
            'column' => 'certIssuer',
            'type' => 'String',
        ),

    ),

    'slEpBrandList' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
        ),
        'brandId' => array(
            'name' => '品牌ID',
            'column' => 'brandId',
            'type' => 'Integer',
        ),
        'brandName' => array(
            'name' => '品牌名称',
            'column' => 'brandName',
            'type' => 'String',
        ),
        'brandClass' => array(
            'name' => '品牌分类',
            'column' => 'brandClass',
            'type' => 'String',
        ),
        'brandNo' => array(
            'name' => '商标注册证',
            'column' => 'brandNo',
            'type' => 'String',
        ),
        'brandTermBegin' => array(
            'name' => '有效期限开始',
            'column' => 'brandTermBegin',
            'type' => 'Datetime',
        ),
        'brandTermEnd' => array(
            'name' => '有效期限截止',
            'column' => 'brandTermEnd',
            'type' => 'Datetime',
        ),

    ),

    'slEpBrandHonorList' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
        ),
        'brandId' => array(
            'name' => '品牌ID',
            'column' => 'brandId',
            'type' => 'Integer',
        ),
        'honorId' => array(
            'name' => '荣誉ID',
            'column' => 'honorId',
            'type' => 'Integer',
        ),
        'honorDes' => array(
            'name' => '荣誉描述',
            'column' => 'honorDes',
            'type' => 'String',
        ),
        'honorNo' => array(
            'name' => '证书编号',
            'column' => 'honorNo',
            'type' => 'String',
        ),
        'certDate' => array(
            'name' => '发证日期',
            'column' => 'certDate',
            'type' => 'Datetime',
        ),
        'certIssuer' => array(
            'name' => '发证单位',
            'column' => 'certIssuer',
            'type' => 'String',
        ),

    ),

    'slPdBrandList' => array(
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'brandEpId' => array(
            'name' => '品牌所属企业ID',
            'column' => 'brandEpId',
            'type' => 'Integer',
        ),
        'brandId' => array(
            'name' => '品牌ID',
            'column' => 'brandId',
            'type' => 'Integer',
        ),
        'brandName' => array(
            'name' => '品牌名称',
            'column' => 'brandName',
            'type' => 'String',
        ),
        'brandClass' => array(
            'name' => '品牌分类',
            'column' => 'brandClass',
            'type' => 'String',
        ),
        'brandType' => array(
            'name' => '品牌类型',
            'column' => 'brandType',
            'type' => 'Integer',
        ),
        'contractNo' => array(
            'name' => '代理及分销授权合同号',
            'column' => 'contractNo',
            'type' => 'String',
        ),
        'termBegin' => array(
            'name' => '有效期开始',
            'column' => 'termBegin',
            'type' => 'Datetime',
        ),
        'termEnd' => array(
            'name' => '有效期截止',
            'column' => 'termEnd',
            'type' => 'Datetime',
        ),

    ),

    'slEpWorkshopList' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
        ),
        'workshopId' => array(
            'name' => '车间ID',
            'column' => 'workshopId',
            'type' => 'Integer',
        ),
        'workshopName' => array(
            'name' => '车间名称',
            'column' => 'workshopName',
            'type' => 'String',
        ),
        'product' => array(
            'name' => '生产产品',
            'column' => 'product',
            'type' => 'String',
        ),
        'process' => array(
            'name' => '工艺流程特点',
            'column' => 'process',
            'type' => 'String',
        ),


    ),

    'slEpCap' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
        ),
        'ftyAsset' => array(
            'name' => '厂区_总资产',
            'column' => 'ftyAsset',
            'type' => 'BigDecimal',
        ),
        'ftyRegCapital' => array(
            'name' => '厂区_注册资本',
            'column' => 'ftyRegCapital',
            'type' => 'BigDecimal',
        ),
        'ftyLandArea' => array(
            'name' => '厂区_占地面积',
            'column' => 'ftyLandArea',
            'type' => 'BigDecimal',
        ),
        'ftyFloorArea' => array(
            'name' => '厂区_厂房面积',
            'column' => 'ftyFloorArea',
            'type' => 'BigDecimal',
        ),
        'ftyEquipment' => array(
            'name' => '厂区_主要设备',
            'column' => 'ftyEquipment',
            'type' => 'String',
        ),
        'ftyDesignCap' => array(
            'name' => '厂区_设计产能',
            'column' => 'ftyDesignCap',
            'type' => 'String',
        ),
        'ftyActualCap' => array(
            'name' => '厂区_实际产能',
            'column' => 'ftyActualCap',
            'type' => 'String',
        ),
        'ftyFtRate' => array(
            'name' => '厂区_外贸销售占比',
            'column' => 'ftyFtRate',
            'type' => 'BigDecimal',
        ),
        'ftyDsRate' => array(
            'name' => '厂区_直销占比',
            'column' => 'ftyDsRate',
            'type' => 'BigDecimal',
        ),
        'ftyAsRate' => array(
            'name' => '厂区_代理销售占比',
            'column' => 'ftyAsRate',
            'type' => 'BigDecimal',
        ),
        'scapMaterial' => array(
            'name' => '库容概括_原料库容',
            'column' => 'scapMaterial',
            'type' => 'BigDecimal',
        ),
        'scapProduct' => array(
            'name' => '库容概括_成品库容',
            'column' => 'scapProduct',
            'type' => 'BigDecimal',
        ),
        'labArea' => array(
            'name' => '实验室_面积',
            'column' => 'labArea',
            'type' => 'BigDecimal',
        ),
        'labFunction' => array(
            'name' => '实验室_功能',
            'column' => 'labFunction',
            'type' => 'String',
        ),
        'labInvestment' => array(
            'name' => '实验室_投资',
            'column' => 'labInvestment',
            'type' => 'BigDecimal',
        ),
        'labMember' => array(
            'name' => '实验室_人员',
            'column' => 'labMember',
            'type' => 'Integer',
        ),
        'ddEquipment' => array(
            'name' => '检测设备_主要设备及用途',
            'column' => 'ddEquipment',
            'type' => 'String',
        ),

    ),

    'slEpAuthList' => array(
        'flag' => array(
            'name' => '1：卖家代理及分销授权:2：卖家OEM委托授权标志',
            'column' => 'flag',
            'type' => 'String',
        ),
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'producerEpId' => array(
            'name' => '生产商_企业ID',
            'column' => 'producerEpId',
            'type' => 'Integer',
        ),
        'contractNo' => array(
            'name' => '授权经销合同号',
            'column' => 'contractNo',
            'type' => 'String',
        ),
        'authEpName' => array(
            'name' => '授权单位',
            'column' => 'authEpName',
            'type' => 'String',
        ),
        'authTermBegin' => array(
            'name' => '授权期限开始',
            'column' => 'authTermBegin',
            'type' => 'Datetime',
        ),
        'authTermEnd' => array(
            'name' => '授权期限结束',
            'column' => 'authTermEnd',
            'type' => 'Datetime',
        ),
        'authTermUnliimited' => array(
            'name' => '授权期限长期标志',
            'column' => 'authTermUnliimited',
            'type' => 'String',
        ),

    ),

    'slEpManagerList' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
        ),
        'memberId' => array(
            'name' => '管理成员ID',
            'column' => 'memberId',
            'type' => 'Integer',
        ),
        'memberDuties' => array(
            'name' => '职务',
            'column' => 'memberDuties',
            'type' => 'String',
        ),
        'memberName' => array(
            'name' => '姓名',
            'column' => 'memberName',
            'type' => 'String',
        ),
        'memberAge' => array(
            'name' => '年龄',
            'column' => 'memberAge',
            'type' => 'Integer',
        ),
        'memberEduc' => array(
            'name' => '文化程度',
            'column' => 'memberEduc',
            'type' => 'String',
        ),
        'memberTel' => array(
            'name' => '联系电话',
            'column' => 'memberTel',
            'type' => 'String',
        ),

    ),

    'slEcTeamList' => array(
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'memberId' => array(
            'name' => '成员ID',
            'column' => 'memberId',
            'type' => 'Integer',
        ),
        'leaderFlg' => array(
            'name' => '是否负责人',
            'column' => 'leaderFlg',
            'type' => 'String',
        ),
        'memberName' => array(
            'name' => '姓名',
            'column' => 'memberName',
            'type' => 'String',
        ),
        'memberAge' => array(
            'name' => '年龄',
            'column' => 'memberAge',
            'type' => 'Integer',
        ),
        'birthday' => array(
            'name' => '出生日期',
            'column' => 'birthday',
            'type' => 'Datetime',
        ),
        'memberEduc' => array(
            'name' => '文化程度',
            'column' => 'memberEduc',
            'type' => 'String',
        ),
        'memberTel' => array(
            'name' => '联系电话',
            'column' => 'memberTel',
            'type' => 'String',
        ),
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),

    ),
);