<?php
/**
 * 编辑商家基本信息---------------ISL231180
 * 代理OEN更新卖家类型
 */
$remote['seller_edit_seller_info2-2'] = array(
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

        'slEpHonorList' => array(
            'name' => '企业荣誉信息List',
            'column' => 'slEpHonorList',
            'type' => 'List',
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