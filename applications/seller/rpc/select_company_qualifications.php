<?php
/**
 * 查询企业基本资质（所有生产商）---------------ISL231125
 */
$remote['seller_select_company_qualifications'] = array(
    'url' => '/sl/slInfo/slEnterprise/search',

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
        'epId' => array(
            'name' => '企业ID',
            'column' => 'epId',
            'type' => 'String',
            'require' => false,
        ),
        'epName' => array(
            'name' => '企业名称',
            'column' => 'epName',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'response' => array(
        'epInfoList' => array(
            'name' => '企业信息列表',
            'column' => 'epInfoList',
            'type' => 'List',
        ),

    ),
    'epInfoList' => array(
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
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),

    ),

);