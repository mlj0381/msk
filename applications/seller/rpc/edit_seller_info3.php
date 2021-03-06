<?php
/**
 * 编辑商家基本信息---------------ISL231180
 * OEM专家类型
 */
$remote['seller_edit_seller_info3'] = array(
    'url' => '/sl/slInfo/newOrUpdateAll',

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
            'name' => '卖家账号信息',
            'column' => 'slAccount',
            'type' => 'Object',
            'require' => false,
        ),
        'slSeller' => array(
            'name' => '卖家基本信息',
            'column' => 'slSeller',
            'type' => 'Object',
            'default' => '',
            'require' => false,
        ),
        'pdClassesCodeList' => array(
            'name' => '产品类别List',
            'column' => 'pdClassesCodeList',
            'type' => 'List',
            'default' => '',
            'require' => '',
        ),
        'slEnterprise' => array(
            'name' => '企业基本资质',
            'column' => 'slEnterprise',
            'type' => 'Object',
            'default' => '',
            'require' => '',
        ),
//        'certInfoList' => array(
//            'name' => '企业证照信息List',
//            'column' => 'certInfoList',
//            'type' => 'List',
//            'default' => '',
//            'require' => '',
//        ),
        'slEpHonorList' => array(
            'name' => '企业荣誉信息List',
            'column' => 'slEpHonorList',
            'type' => 'List',
            'default' => '',
            'require' => '',
        ),
        'slEpBrandList' => array(
            'name' => '',
            'column' => 'slEpBrandList',
            'type' => 'List',
            'default' => '',
            'require' => '',
        ),
//        'slEpBrandHonorList' => array(
//            'name' => '企业产品品牌荣誉信息List',
//            'column' => 'slEpBrandHonorList',
//            'type' => 'List',
//            'default' => '',
//            'require' => '',
//        ),
//        'slPdBrandList' => array(
//            'name' => '',
//            'column' => 'slPdBrandList',
//            'type' => 'List',
//            'default' => '不是自己企业的品牌时使用',
//            'require' => '',
//        ),
        'slEpWorkshopList' => array(
            'name' => '企业车间List',
            'column' => 'slEpWorkshopList',
            'type' => 'List',
            'default' => '',
            'require' => '',
        ),
        'slEpCap' => array(
            'name' => '企业生产能力信息',
            'column' => 'slEpCap',
            'type' => 'Object',
            'default' => '',
            'require' => '',
        ),
        'slEpAuthList' => array(
            'name' => '',
            'column' => 'slEpAuthList',
            'type' => 'List',
            'default' => '',
            'require' => '',
        ),
        'slEpManagerList' => array(
            'name' => '',
            'column' => 'slEpManagerList',
            'type' => 'List',
            'default' => '',
            'require' => '',
        ),
        'slEcTeamList' => array(
            'name' => '',
            'column' => 'slEcTeamList',
            'type' => 'List',
            'default' => '',
            'require' => '',
        ),
        'loginId' => array(
            'name' => '  创建者ID/更新者ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'delFlg' => array(
            'name' => '  删除标志',
            'column' => 'delFlg',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'ver' => array('name' => '  版本号',
            'column' => 'ver',
            'type' => 'Integer',
            'default' => '',
            'require' => false
        ),
        'insertFlag' => array(
            'name' => '全体/单个',
            'column' => 'insertFlag',
            'type' => 'String',
            'default' => '',//0：全体，1：单个
            'require' => false,
        ),
    ),

    'slAccount' => array(
        'login_account' => array(
            'name' => '卖家账号',
            'column' => 'slAccount',
            'type' => 'String',
            'require' => false,
        ),
        'mobile' => array(
            'name' => '登录手机号码',
            'column' => 'slTel',
            'type' => 'String',
            'require' => false,
        ),
        'show_name' => array(
            'name' => '卖家显示名称',
            'column' => 'slShowName',
            'type' => 'String',
            'require' => false,
        ),
        'contact_person' => array(
            'name' => '联系人姓名',
            'column' => 'slContact',
            'type' => 'String',
            'require' => false,
        ),
        'login_password' => array(
            'name' => '登录密码',
            'column' => 'accountPsd',
            'type' => 'String',
            'require' => false,
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
    ),

    'slSeller' => array(
        'login_account' => array(
            'name' => '',
            'column' => 'slAccount',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'slCode' => array(
            'name' => '卖家ID',
            'column' => 'slCode',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'slConFlg' => array(
            'name' => '生产国籍',
            'column' => 'slConFlg',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'areaCode' => array(
            'name' => '大区编码',
            'column' => 'areaCode',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'lgcsAreaCode' => array(
            'name' => '物流区编码',
            'column' => 'lgcsAreaCode',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'provinceCode' => array(
            'name' => '省编码',
            'column' => 'provinceCode',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'cityCode' => array(
            'name' => '地区编码',
            'column' => 'cityCode',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'districtCode' => array(
            'name' => '区编码',
            'column' => 'districtCode',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'slMainClass' => array(
            'name' => '卖家主分类',
            'column' => 'slMainClass',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'snkFlg' => array(
            'name' => '神农客标志',
            'column' => 'snkFlg',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'selfFlg' => array(
            'name' => '自产型卖家标志',
            'column' => 'selfFlg',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'agentFlg' => array(
            'name' => '代理型卖家标志',
            'column' => 'agentFlg',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'oemFlg' => array(
            'name' => 'OEM型卖家标志',
            'column' => 'oemFlg',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'buyerFlg' => array(
            'name' => '买手型卖家标志',
            'column' => 'buyerFlg',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'sqaStatus' => array(
            'name' => '神农客贯标审核',
            'column' => 'sqaStatus',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'distQua' => array(
            'name' => '卖家分销资格',
            'column' => 'distQua',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'shopQua' => array(
            'name' => '卖家开店资格',
            'column' => 'shopQua',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo1' => array(
            'name' => '微信号码',
            'column' => 'memo1',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo2' => array(
            'name' => 'QQ号码',
            'column' => 'memo2',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo3' => array(
            'name' => '邮箱',
            'column' => 'memo3',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo4' => array(
            'name' => '固定电话',
            'column' => 'memo4',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo5' => array(
            'name' => '传真号',
            'column' => 'memo5',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo6' => array(
            'name' => '买手类型',
            'column' => 'memo6',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo7' => array(
            'name' => '身份证号',
            'column' => 'memo7',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo8' => array(
            'name' => '备用字段8',
            'column' => 'memo8',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo9' => array(
            'name' => '备用字段9',
            'column' => 'memo9',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo10' => array(
            'name' => '备用字段10',
            'column' => 'memo10',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo11' => array(
            'name' => '备用字段11',
            'column' => 'memo11',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo12' => array(
            'name' => '备用字段12',
            'column' => 'memo12',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo13' => array(
            'name' => '备用字段13',
            'column' => 'memo13',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo14' => array(
            'name' => '备用字段14',
            'column' => 'memo14',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo15' => array(
            'name' => '备用字段15',
            'column' => 'memo15',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo16' => array(
            'name' => '备用字段16',
            'column' => 'memo16',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo17' => array(
            'name' => '备用字段17',
            'column' => 'memo17',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo18' => array(
            'name' => '备用字段18',
            'column' => 'memo18',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo19' => array(
            'name' => '备用字段19',
            'column' => 'memo19',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memo20' => array(
            'name' => '备用字段20',
            'column' => 'memo20',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
    ),

    'pdClassesCodeList' => array(
        'pdClassesCode' => array(
            'name' => '产品类别',
            'column' => 'pdClassesCode',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'machiningCode' => array(
            'name' => '产品二级分类',
            'column' => 'machiningCode',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'slCode' => array(
            'name' => '卖家ID',
            'column' => 'slCode',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),

    ),

    'slEnterprise' => array(
        'slCode' => array(
            'name' => '卖家ID',
            'column' => 'slCode',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'epName' => array(
            'name' => '企业名称',
            'column' => 'epName',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'licType' => array(
            'name' => '三证合一营业执照标志',
            'column' => 'licType',
            'type' => 'String',
            'default' => '',//0:普通,1:三证合一营业执照
            'require' => false,
        ),
        'licName' => array(
            'name' => '营业执照_名称',
            'column' => 'licName',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'licNo' => array(
            'name' => '营业执照_注册号',
            'column' => 'licNo',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'licAddr' => array(
            'name' => '营业执照_住所',
            'column' => 'licAddr',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'licBusiType' => array(
            'name' => '营业执照_经营类型',
            'column' => 'licBusiType',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'licBusiScope' => array(
            'name' => '营业执照_经营范围',
            'column' => 'licBusiScope',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'licLegalPerson' => array(
            'name' => '营业执照_法人代表',
            'column' => 'licLegalPerson',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'licRegCapital' => array(
            'name' => '营业执照_注册资本',
            'column' => 'licRegCapital',
            'type' => 'BigDecimal',
            'default' => '',
            'require' => false,
        ),
        'licPaidinCapital' => array(
            'name' => '营业执照_实收资本',
            'column' => 'licPaidinCapital',
            'type' => 'BigDecimal',
            'default' => '',
            'require' => false,
        ),
        'licCrtDate' => array(
            'name' => '营业执照_成立日期',
            'column' => 'licCrtDate',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),
        'licTermBegin' => array(
            'name' => '营业执照_营业期限开始',
            'column' => 'licTermBegin',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),
        'licTermEnd' => array(
            'name' => '营业执照_营业期限截止',
            'column' => 'licTermEnd',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),
        'licTermUnliimited' => array(
            'name' => '营业执照_营业期限长期标志',
            'column' => 'licTermUnliimited',
            'type' => 'String',
            'default' => '',//0：短期 1:长期
            'require' => false,
        ),
        'taxNo' => array(
            'name' => '税务登记证_税务登记证号',
            'column' => 'taxNo',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'taxVatNo' => array(
            'name' => '税务登记证_一般增值税纳税人资格认定编号',
            'column' => 'taxVatNo',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'orgNo' => array(
            'name' => '组织机构代码证_代码',
            'column' => 'orgNo',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'orgTermBegin' => array(
            'name' => '组织机构代码证_有效期开始',
            'column' => 'orgTermBegin',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),
        'orgTermEnd' => array(
            'name' => '组织机构代码证_有效期截止',
            'column' => 'orgTermEnd',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),
        'balLegalPerson' => array(
            'name' => '银行开户许可证_法定代表人',
            'column' => 'balLegalPerson',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'balBank' => array(
            'name' => '银行开户许可证_开户银行',
            'column' => 'balBank',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'balAccount' => array(
            'name' => '银行开户许可证_帐号',
            'column' => 'balAccount',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'fdlNo' => array(
            'name' => '食品流通许可证_许可证编号',
            'column' => 'fdlNo',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'fdlTermBegin' => array(
            'name' => '食品流通许可证_有效期开始',
            'column' => 'fdlTermBegin',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),
        'fdlTermEnd' => array(
            'name' => '食品流通许可证_有效期截止',
            'column' => 'fdlTermEnd',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),

    ),

//    'certInfoList' => array(
//        'epId' => array(
//            'name' => '企业ID',
//            'column' => 'epId',
//            'type' => 'Integer',
//            'default' => '全体新增时为空，单独新增时不为空，修改时不为空',
//            'require' => false,
//        ),
//        'certId' => array(
//            'name' => '证照ID',
//            'column' => 'certId',
//            'type' => 'Integer',
//            'default' => '',
//            'require' => false,
//        ),
//        'certName' => array(
//            'name' => '证照名称',
//            'column' => 'certName',
//            'type' => 'String',
//            'default' => '',
//            'require' => false,
//        ),
//        'certItemList' => array(
//            'name' => '企业证照项目信息List',
//            'column' => 'certItemList',
//            'type' => 'List',
//            'default' => '',
//            'require' => false,
//        ),
//
//    ),
    'certItemList' => array(
        'certId' => array(
            'name' => '证照ID',
            'column' => 'certId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'certItemId' => array(
            'name' => '证照项目ID',
            'column' => 'certItemId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'certItemName' => array(
            'name' => '证照项目名称',
            'column' => 'certItemName',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'certItemValue' => array(
            'name' => '证照项目内容',
            'column' => 'certItemValue',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),

    ),

    'slEpHonorList' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'honorId' => array(
            'name' => '荣誉ID',
            'column' => 'honorId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'honorDesc' => array(
            'name' => '荣誉描述',
            'column' => 'honorDesc',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'certDate' => array(
            'name' => '发证日期',
            'column' => 'certDate',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),
        'certIssuer' => array(
            'name' => '发证单位',
            'column' => 'certIssuer',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),

    ),

    'slEpBrandList' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'brandId' => array(
            'name' => '品牌ID',
            'column' => 'brandId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'brandClass' => array(
            'name' => '品牌分类',
            'column' => 'brandClass',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'brandName' => array(
            'name' => '品牌名称',
            'column' => 'brandName',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'brandNo' => array(
            'name' => '商标注册证',
            'column' => 'brandNo',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'brandTermBegin' => array(
            'name' => '有效期限开始',
            'column' => 'brandTermBegin',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),
        'brandTermEnd' => array(
            'name' => '有效期限截止',
            'column' => 'brandTermEnd',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),

    ),

    'slEpBrandHonorList' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'brandId' => array(
            'name' => '品牌ID',
            'column' => 'brandId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'honorId' => array(
            'name' => '荣誉ID',
            'column' => 'honorId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'honorDes' => array(
            'name' => '荣誉描述',
            'column' => 'honorDes',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'honorNo' => array(
            'name' => '证书编号',
            'column' => 'honorNo',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'certDate' => array(
            'name' => '发证日期',
            'column' => 'certDate',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),
        'certIssuer' => array(
            'name' => '发证单位',
            'column' => 'certIssuer',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),

    ),

//    'slPdBrandList' => array(
//        'slCode' => array(
//            'name' => '卖家ID',
//            'column' => 'slCode',
//            'type' => 'String',
//            'default' => '全体新增时为空，单独新增时不为空，修改时不为空',
//            'require' => false,
//        ),
//        'brandEpId' => array(
//            'name' => '品牌所属企业ID',
//            'column' => 'brandEpId',
//            'type' => 'Integer',
//            'default' => '如果需要操作，必须有',
//            'require' => false,
//        ),
//        'brandId' => array(
//            'name' => '品牌ID',
//            'column' => 'brandId',
//            'type' => 'Integer',
//            'default' => '如果需要操作，必须有',
//            'require' => false,
//        ),
//        'brandName' => array(
//            'name' => '品牌名称',
//            'column' => 'brandName',
//            'type' => 'String',
//            'default' => '',
//            'require' => false,
//        ),
//        'brandType' => array(
//            'name' => '品牌类型',
//            'column' => 'brandType',
//            'type' => 'Integer',
//            'default' => '',
//            'require' => false,
//        ),
//        'brandClass' => array(
//            'name' => '品牌分类',
//            'column' => 'brandClass',
//            'type' => 'String',
//            'default' => '',
//            'require' => false,
//        ),
//        'contractNo' => array(
//            'name' => '代理及分销授权合同号',
//            'column' => 'contractNo',
//            'type' => 'String',
//            'default' => '',
//            'require' => false,
//        ),
//        'termBegin' => array(
//            'name' => '有效期开始',
//            'column' => 'termBegin',
//            'type' => 'Datetime',
//            'default' => '',
//            'require' => false,
//        ),
//        'termEnd' => array(
//            'name' => '有效期截止',
//            'column' => 'termEnd',
//            'type' => 'Datetime',
//            'default' => '',
//            'require' => false,
//        ),
//
//    ),

    'slEpWorkshopList' => array(
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'workshopId' => array(
            'name' => '车间ID',
            'column' => 'workshopId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'workshopName' => array(
            'name' => '车间名称',
            'column' => 'workshopName',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'product' => array(
            'name' => '生产产品',
            'column' => 'product',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'process' => array(
            'name' => '工艺流程特点',
            'column' => 'process',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
    ),

    'slEpCap' => array(
        'slCode' => array(
            'name' => '卖家ID',
            'column' => 'slCode',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
            'default' => '',
            'require' => false
        ),
        'ftyAsset' => array(
            'name' => '厂区_总资产',
            'column' => 'ftyAsset',
            'type' => 'BigDecimal',
            'default' => '',
            'require' => false,
        ),
        'ftyRegCapital' => array(
            'name' => '厂区_注册资本',
            'column' => 'ftyRegCapital',
            'type' => 'BigDecimal',
            'default' => '',
            'require' => false,
        ),
        'ftyLandArea' => array(
            'name' => '厂区_占地面积',
            'column' => 'ftyLandArea',
            'type' => 'BigDecimal',
            'default' => '',
            'require' => false,
        ),
        'ftyFloorArea' => array(
            'name' => '厂区_厂房面积',
            'column' => 'ftyFloorArea',
            'type' => 'BigDecimal',
            'default' => '',
            'require' => false,
        ),
        'ftyEquipment' => array(
            'name' => '厂区_主要设备',
            'column' => 'ftyEquipment',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'ftyDesignCap' => array(
            'name' => '厂区_设计产能',
            'column' => 'ftyDesignCap',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'ftyActualCap' => array(
            'name' => '厂区_实际产能',
            'column' => 'ftyActualCap',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'ftyFtRate' => array(
            'name' => '厂区_外贸销售占比',
            'column' => 'ftyFtRate',
            'type' => 'BigDecimal',
            'default' => '',
            'require' => false,
        ),
        'ftyDsRate' => array(
            'name' => '厂区_直销占比',
            'column' => 'ftyDsRate',
            'type' => 'BigDecimal',
            'default' => '',
            'require' => false,
        ),
        'ftyAsRate' => array(
            'name' => '厂区_代理销售占比',
            'column' => 'ftyAsRate',
            'type' => 'BigDecimal',
            'default' => '',
            'require' => false,
        ),
        'scapMaterial' => array(
            'name' => '库容概括_原料库容',
            'column' => 'scapMaterial',
            'type' => 'BigDecimal',
            'default' => '',
            'require' => false,
        ),
        'scapProduct' => array(
            'name' => '库容概括_成品库容',
            'column' => 'scapProduct',
            'type' => 'BigDecimal',
            'default' => '',
            'require' => false,
        ),
        'labArea' => array(
            'name' => '实验室_面积',
            'column' => 'labArea',
            'type' => 'BigDecimal',
            'default' => '',
            'require' => false,
        ),
        'labFunction' => array(
            'name' => '实验室_功能',
            'column' => 'labFunction',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'labInvestment' => array(
            'name' => '实验室_投资',
            'column' => 'labInvestment',
            'type' => 'BigDecimal',
            'default' => '单位万元',
            'require' => false,
        ),
        'labMember' => array(
            'name' => '实验室_人员',
            'column' => 'labMember',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'ddEquipment' => array(
            'name' => '检测设备_主要设备及用途',
            'column' => 'ddEquipment',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
    ),

    'slEpAuthList' => array(
        'flag' => array(
            'name' => '1：卖家代理及分销授权:2：卖家OEM委托授权标志',
            'column' => 'flag',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'slCode' => array(
            'name' => '卖家ID',
            'column' => 'slCode',
            'type' => 'String',
            'default' => '全体新增时为空，单独新增时不为空，修改时不为空',
            'require' => false,
        ),
        'producerEpId' => array(
            'name' => '生产商_企业ID',
            'column' => 'producerEpId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'contractNo' => array(
            'name' => '授权经销合同号',
            'column' => 'contractNo',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'authEpName' => array(
            'name' => '授权单位',
            'column' => 'authEpName',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'authTermBegin' => array(
            'name' => '授权期限开始',
            'column' => 'authTermBegin',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),
        'authTermEnd' => array(
            'name' => '授权期限结束',
            'column' => 'authTermEnd',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),
        'authTermUnliimited' => array(
            'name' => '授权期限长期标志',
            'column' => 'authTermUnliimited',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
    ),

    'slEpManagerList' => array(
        'epId' => array('name' => '企业ID',
            'column' => 'epId',
            'type' => 'Integer',
            'default' => '',
            'require' => false
        ),
        'memberId' => array(
            'name' => '管理成员ID',
            'column' => 'memberId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'memberDuties' => array(
            'name' => '职务',
            'column' => 'memberDuties',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memberName' => array(
            'name' => '姓名',
            'column' => 'memberName',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memberAge' => array(
            'name' => '年龄',
            'column' => 'memberAge',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'memberEduc' => array(
            'name' => '文化程度',
            'column' => 'memberEduc',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memberTel' => array(
            'name' => '联系电话',
            'column' => 'memberTel',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),

    ),

    'slEcTeamList' => array(
        'slCode' => array(
            'name' => '卖家ID',
            'column' => 'slCode',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memberId' => array(
            'name' => '成员ID',
            'column' => 'memberId',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'leaderFlg' => array(
            'name' => '是否负责人',
            'column' => 'leaderFlg',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memberName' => array(
            'name' => '姓名',
            'column' => 'memberName',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memberAge' => array(
            'name' => '年龄',
            'column' => 'memberAge',
            'type' => 'Integer',
            'default' => '',
            'require' => false,
        ),
        'birthday' => array(
            'name' => '出生日期',
            'column' => 'birthday',
            'type' => 'Datetime',
            'default' => '',
            'require' => false,
        ),
        'memberEduc' => array(
            'name' => '文化程度',
            'column' => 'memberEduc',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
        'memberTel' => array(
            'name' => '联系电话',
            'column' => 'memberTel',
            'type' => 'String',
            'default' => '',
            'require' => false,
        ),
    ),


    'response' => array(
        'epId' => array(
            'name' => '企业id',
            'column' => 'epId',
            'type' => 'String',
        ),
        'slCode' => array(
            'name' => '卖家id',
            'column' => 'slCode',
            'type' => 'String',
        ),
    ),

);