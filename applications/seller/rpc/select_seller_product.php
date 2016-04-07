<?php
/**
 * 查询卖家产品和标准---------------ISL231109
 */
$remote['seller_select_seller_product'] = array(
    'url' => '/sl/slInfo/slQlt/search',

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
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'Integer',
            'require' => false,
        ),
        'prodEpId' => array(
            'name' => '生产商企业ID',
            'column' => 'prodEpId',
            'type' => 'Integer',
            'require' => false,
        ),
        'brandEpId' => array(
            'name' => '品牌商企业ID',
            'column' => 'brandEpId',
            'type' => 'Integer',
            'require' => false,
        ),
        'brandId' => array(
            'name' => '产品品牌ID',
            'column' => 'brandId',
            'type' => 'Integer',
            'require' => false,
        ),
        'pdClassesCode' => array(
            'name' => '产品类别',
            'column' => 'pdClassesCode',
            'type' => 'String',
            'require' => false,
        ),
        'machiningCode' => array(
            'name' => '产品二级分类编码',
            'column' => 'machiningCode',
            'type' => 'String',
            'require' => false,
        ),
        'pdBreedCode' => array(
            'name' => '产品品种',
            'column' => 'pdBreedCode',
            'type' => 'String',
            'require' => false,
        ),
        'pdFeatureCode' => array(
            'name' => '产品特征',
            'column' => 'pdFeatureCode',
            'type' => 'String',
            'require' => false,
        ),
        'weightCode' => array(
            'name' => '净重编码',
            'column' => 'weightCode',
            'type' => 'String',
            'require' => false,
        ),
    ),

    'response' => array(
        'slPdList' => array(
            'name' => '卖家能销售的产品信息/产品加工质量标准指标/产品加工技术标准指标',
            'column' => 'slPdList',
            'type' => 'List',
        ),
        'slPdQtyStdList ' => array(
            'name' => '卖家产品加工技术标准指标值List',
            'column' => 'slPdQtyStdList ',
            'type' => 'List',
        ),
        'slPdTncStdList' => array(
            'name' => '卖家产品加工质量标准指标值信息List',
            'column' => 'slPdTncStdList',
            'type' => 'List',
        ),
        'slPdPkgList' => array(
            'name' => '卖家产品包装标准信息',
            'column' => 'slPdPkgList',
            'type' => 'List',
        ),
        'slPdOrgStdList' => array(
            'name' => '卖家原种种源标准',
            'column' => 'slPdOrgStdList',
            'type' => 'List',
        ),
        'slPdFedStdList' => array(
            'name' => '卖家产品饲养标准',
            'column' => 'slPdFedStdList',
            'type' => 'List',
        ),
        'slPdGnqStdList' => array(
            'name' => '卖家产品通用质量标准',
            'column' => 'slPdGnqStdList',
            'type' => 'List',
        ),
        'slPdTspStdList' => array(
            'name' => '卖家产品通用质量标准',
            'column' => 'slPdTspStdList',
            'type' => 'List',
        ),
        'slPdSftStdList' => array(
            'name' => '卖家产品安全标准',
            'column' => 'slPdSftStdList',
            'type' => 'List',
        ),
    ),

    'slPdList' => array(
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'slPdId' => array(
            'name' => '卖家产品ID',
            'column' => 'slPdId',
            'type' => 'Integer',
        ),
        'prodEpId' => array(
            'name' => '生产商企业ID',
            'column' => 'prodEpId',
            'type' => 'Integer',
        ),
        'brandEpId' => array(
            'name' => '品牌商企业ID',
            'column' => 'brandEpId',
            'type' => 'Integer',
        ),
        'brandId' => array(
            'name' => '产品品牌ID',
            'column' => 'brandId',
            'type' => 'Integer',
        ),
        'pdClassesCode' => array(
            'name' => '产品类别',
            'column' => 'pdClassesCode',
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
        'distFlg' => array(
            'name' => '是否参与神农客分销，0:否，1:是',
            'column' => 'distFlg',
            'type' => 'String',
        ),
        'distmskFlg' => array(
            'name' => '是否参与美侍客分销，0:否，1:是',
            'column' => 'distmskFlg',
            'type' => 'String',
        ),
        'slQltStd' => array(
            'name' => '卖家产品质量标准',
            'column' => 'slQltStd',
            'type' => 'String',
        ),
        'slQltGradeCode' => array(
            'name' => '产品质量标准定级',
            'column' => 'slQltGradeCode',
            'type' => 'Integer',
        ),
        'qltNgReason' => array(
            'name' => '产品质量标准定级不通过理由',
            'column' => 'qltNgReason',
            'type' => 'String',
        ),
        'qltAuditStatus' => array(
            'name' => '产品质量标准定级状态',
            'column' => 'qltAuditStatus',
            'type' => 'Integer',
        ),
        'qltAuditor' => array(
            'name' => '产品质量标准定级人',
            'column' => 'qltAuditor',
            'type' => 'String',
        ),
        'qltAuditDate' => array(
            'name' => '产品质量标准定级日期',
            'column' => 'qltAuditDate',
            'type' => 'Datetime',
        ),
        'qltMonitorResult' => array(
            'name' => '产品质量标准定级监控人审核意见',
            'column' => 'qltMonitorResult',
            'type' => 'Integer',
        ),
        'qltMonitorAuditor' => array(
            'name' => '产品质量标准定级监控人',
            'column' => 'qltMonitorAuditor',
            'type' => 'String',
        ),
        'qltMonitorDate' => array(
            'name' => '产品质量标准定级监控人审核日期',
            'column' => 'qltMonitorDate',
            'type' => 'Datetime',
        ),
        'slTncStd' => array(
            'name' => '卖家产品技术标准',
            'column' => 'slTncStd',
            'type' => 'String',
        ),
        'slTncGradeCode' => array(
            'name' => '产品技术标准定级',
            'column' => 'slTncGradeCode',
            'type' => 'Integer',
        ),
        'tncNgReason' => array(
            'name' => '产品技术标准定级不通过理由',
            'column' => 'tncNgReason',
            'type' => 'String',
        ),
        'tncAuditStatus' => array(
            'name' => '产品技术标准定级状态',
            'column' => 'tncAuditStatus',
            'type' => 'Integer',
        ),
        'tncAuditor' => array(
            'name' => '产品技术标准定级人',
            'column' => 'tncAuditor',
            'type' => 'String',
        ),
        'tncAuditDate' => array(
            'name' => '产品技术标准定级日期',
            'column' => 'tncAuditDate',
            'type' => 'Datetime',
        ),
        'tncMonitorResult' => array(
            'name' => '产品技术标准定级监控人审核意见',
            'column' => 'tncMonitorResult',
            'type' => 'Integer',
        ),
        'tncMonitorAuditor' => array(
            'name' => '产品技术标准定级监控人',
            'column' => 'tncMonitorAuditor',
            'type' => 'String',
        ),
        'tncMonitorDate' => array(
            'name' => '产品技术标准定级监控人审核日期',
            'column' => 'tncMonitorDate',
            'type' => 'Datetime',
        ),
        'pdStatus' => array(
            'name' => '产品状态',
            'column' => 'pdStatus',
            'type' => 'String',
        ),
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),
    ),

    'slPdQtyStdList ' => array(
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'slPdId' => array(
            'name' => '卖家产品ID',
            'column' => 'slPdId',
            'type' => 'Integer',
        ),
        'standardId' => array(
            'name' => '产品标准ID',
            'column' => 'standardId',
            'type' => 'Integer',
        ),
        'qltStdItemId' => array(
            'name' => '质量标准项目ID',
            'column' => 'qltStdItemId',
            'type' => 'String',
        ),
        'isCatalog' => array(
            'name' => '是否为目录节点',
            'column' => 'isCatalog',
            'type' => 'String',
        ),
        'qltStdItemName' => array(
            'name' => '质量标准项目名',
            'column' => 'qltStdItemName',
            'type' => 'String',
        ),
        'qltStdVal1' => array(
            'name' => '神农客质量标准优良值',
            'column' => 'qltStdVal1',
            'type' => 'String',
        ),
        'qltStdVal2' => array(
            'name' => '神农客质量标准合格值',
            'column' => 'qltStdVal2',
            'type' => 'String',
        ),
        'qltStdVal3' => array(
            'name' => '神农客质量标准不合格值',
            'column' => 'qltStdVal3',
            'type' => 'String',
        ),
        'agreeFlg' => array(
            'name' => '卖家同意标志',
            'column' => 'agreeFlg',
            'type' => 'String',
        ),
        'slQltStdVal' => array(
            'name' => '卖家标准',
            'column' => 'slQltStdVal',
            'type' => 'String',
        ),
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),
    ),

    'slPdTncStdList' => array(
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'slPdId' => array(
            'name' => '卖家产品ID',
            'column' => 'slPdId',
            'type' => 'Integer',
        ),
        'standardId' => array(
            'name' => '产品标准ID',
            'column' => 'standardId',
            'type' => 'Integer',
        ),
        'tncStdItemId' => array(
            'name' => '技术标准项目ID',
            'column' => 'tncStdItemId',
            'type' => 'String',
        ),
        'isCatalog' => array(
            'name' => '是否为目录节点',
            'column' => 'isCatalog',
            'type' => 'String',
        ),
        'tncStdItemName' => array(
            'name' => '技术标准项目名称',
            'column' => 'tncStdItemName',
            'type' => 'String',
        ),
        'tncStdItemValue1' => array(
            'name' => '神农客技术标准项目值1',
            'column' => 'tncStdItemValue1',
            'type' => 'String',
        ),
        'tncStdItemValue2' => array(
            'name' => '神农客技术标准项目值2',
            'column' => 'tncStdItemValue2',
            'type' => 'String',
        ),
        'tncStdItemValue3' => array(
            'name' => '神农客技术标准项目值3',
            'column' => 'tncStdItemValue3',
            'type' => 'String',
        ),
        'stdDate' => array(
            'name' => '标准日期',
            'column' => 'stdDate',
            'type' => 'Datetime',
        ),
        'agreeFlg' => array(
            'name' => '卖家同意标志',
            'column' => 'agreeFlg',
            'type' => 'String',
        ),
        'slTncStdVal' => array(
            'name' => '卖家技术标准',
            'column' => 'slTncStdVal',
            'type' => 'String',
        ),
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),
    ),

    'slPdPkgList' => array(
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'slPdId' => array(
            'name' => '卖家产品ID',
            'column' => 'slPdId',
            'type' => 'Integer',
        ),
        'slPdPkgId' => array(
            'name' => '卖家产品包装ID',
            'column' => 'slPdPkgId',
            'type' => 'Integer',
        ),
        'standardId' => array(
            'name' => '产品标准ID',
            'column' => 'standardId',
            'type' => 'Integer',
        ),
        'pkgCode' => array(
            'name' => '包装编码',
            'column' => 'pkgCode',
            'type' => 'String',
        ),
        'prodEpId' => array(
            'name' => '生产商企业ID',
            'column' => 'prodEpId',
            'type' => 'Integer',
        ),
        'brandEpId' => array(
            'name' => '品牌商企业ID',
            'column' => 'brandEpId',
            'type' => 'Integer',
        ),
        'brandId' => array(
            'name' => '产品品牌ID',
            'column' => 'brandId',
            'type' => 'Integer',
        ),
        'pdClassesCode' => array(
            'name' => '产品类别',
            'column' => 'pdClassesCode',
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
        'inSglNw' => array(
            'name' => '内包装_单个产品规格净重',
            'column' => 'inSglNw',
            'type' => 'String',
        ),
        'inSglNwRange' => array(
            'name' => '内包装_单个产品规格净重误差范围',
            'column' => 'inSglNwRange',
            'type' => 'String',
        ),
        'inNw' => array(
            'name' => '内包装_净重',
            'column' => 'inNw',
            'type' => 'BigDecimal',
        ),
        'inNumber' => array(
            'name' => '内包装_个数',
            'column' => 'inNumber',
            'type' => 'String',
        ),
        'inSize' => array(
            'name' => '内包装_尺寸',
            'column' => 'inSize',
            'type' => 'String',
        ),
        'inMts' => array(
            'name' => '内包装_材质及技术标准',
            'column' => 'inMts',
            'type' => 'String',
        ),
        'outSpec' => array(
            'name' => '外包装_规格',
            'column' => 'outSpec',
            'type' => 'String',
        ),
        'outNw' => array(
            'name' => '外包装_净重',
            'column' => 'outNw',
            'type' => 'BigDecimal',
        ),
        'outGw' => array(
            'name' => '外包装_毛重',
            'column' => 'outGw',
            'type' => 'String',
        ),
        'outSize' => array(
            'name' => '外包装_尺寸',
            'column' => 'outSize',
            'type' => 'String',
        ),
        'outMts' => array(
            'name' => '外包装_材质及技术标准',
            'column' => 'outMts',
            'type' => 'String',
        ),
        'pkgTen' => array(
            'name' => '第十种包装信息',
            'column' => 'pkgTen',
            'type' => 'String',
        ),
        'outLength' => array(
            'name' => '外包装长',
            'column' => 'outLength',
            'type' => 'BigDecimal',
        ),
        'outWidth' => array(
            'name' => '外包装宽',
            'column' => 'outWidth',
            'type' => 'BigDecimal',
        ),
        'outHeight' => array(
            'name' => '外包装高',
            'column' => 'outHeight',
            'type' => 'BigDecimal',
        ),
        'outVolume' => array(
            'name' => '外包装体积',
            'column' => 'outVolume',
            'type' => 'BigDecimal',
        ),
        'auditStatus' => array(
            'name' => '审核状态',
            'column' => 'auditStatus',
            'type' => 'Integer',
        ),
        'auditResult' => array(
            'name' => '审核结果',
            'column' => 'auditResult',
            'type' => 'Integer',
        ),
        'auditResultDesc' => array(
            'name' => '审核结果说明'
        ,
            'column' => 'auditResultDesc',
            'type' => 'String',
        ),
        'auditor' => array(
            'name' => '审核人',
            'column' => 'auditor',
            'type' => 'String',
        ),
        'auditDate' => array(
            'name' => '审核日期',
            'column' => 'auditDate',
            'type' => 'Datetime',
        ),
        'monitorResult' => array(
            'name' => '监控人意见',
            'column' => 'monitorResult',
            'type' => 'Integer',
        ),
        'monitorAuditor' => array(
            'name' => '监控人',
            'column' => 'monitorAuditor',
            'type' => 'String',
        ),
        'monitorDate' => array(
            'name' => '监控人审核日期',
            'column' => 'monitorDate',
            'type' => 'Datetime',
        ),
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
        ),

    ),

    'slPdOrgStdList' => array(
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'slPdId' => array(
            'name' => '卖家产品ID',
            'column' => 'slPdId',
            'type' => 'Integer',
        ),
        'standardId' => array(
            'name' => '产品标准ID',
            'column' => 'standardId',
            'type' => 'Integer',
        ),
        'stdItemId' => array(
            'name' => '技术标准项目ID',
            'column' => 'stdItemId',
            'type' => 'String',
        ),
        'isCatalog' => array(
            'name' => '是否为目录节点',
            'column' => 'isCatalog',
            'type' => 'String',
        ),
        'stdItemName' => array(
            'name' => '技术标准项目名称',
            'column' => 'stdItemName',
            'type' => 'String',
        ),
        'slPdOrgStdLevList' => array(
            'name' => '卖家产品加工技术标准指标值',
            'column' => 'slPdOrgStdLevList',
            'type' => 'List',
        ),
    ),
    'slPdOrgStdLevList' => array(
        'stdItemValue1' => array(
            'name' => '神农客技术标准项目值1',
            'column' => 'stdItemValue1',
            'type' => 'String',
        ),
        'stdItemValue2' => array(
            'name' => '神农客技术标准项目值2',
            'column' => 'stdItemValue2',
            'type' => 'String',
        ),
        'stdItemValue3' => array(
            'name' => '神农客技术标准项目值3',
            'column' => 'stdItemValue3',
            'type' => 'String',
        ),
        'agreeFlg' => array(
            'name' => '卖家同意标志',
            'column' => 'agreeFlg',
            'type' => 'String',
        ),
    ),

    'slPdFedStdList' => array(
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'slPdId' => array(
            'name' => '卖家产品ID',
            'column' => 'slPdId',
            'type' => 'Integer',
        ),
        'standardId' => array(
            'name' => '产品标准ID',
            'column' => 'standardId',
            'type' => 'Integer',
        ),
        'stdItemId' => array(
            'name' => '技术标准项目ID',
            'column' => 'stdItemId',
            'type' => 'String',
        ),
        'isCatalog' => array(
            'name' => '是否为目录节点',
            'column' => 'isCatalog',
            'type' => 'String',
        ),
        'stdItemName' => array(
            'name' => '技术标准项目名称',
            'column' => 'stdItemName',
            'type' => 'String',
        ),
        'slPdFedStdLevList' => array(
            'name' => '卖家产品加工技术标准指标值',
            'column' => 'slPdFedStdLevList',
            'type' => 'List',
        ),
    ),
    'slPdFedStdLevList' => array(
        'stdItemValue1' => array(
            'name' => '神农客技术标准项目值1',
            'column' => 'stdItemValue1',
            'type' => 'String',
        ),
        'stdItemValue2' => array(
            'name' => '神农客技术标准项目值2',
            'column' => 'stdItemValue2',
            'type' => 'String',
        ),
        'stdItemValue3' => array(
            'name' => '神农客技术标准项目值3',
            'column' => 'stdItemValue3',
            'type' => 'String',
        ),
        'agreeFlg' => array(
            'name' => '卖家同意标志',
            'column' => 'agreeFlg',
            'type' => 'String',
        ),
    ),

    'slPdGnqStdList' => array(
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'slPdId' => array(
            'name' => '卖家产品ID',
            'column' => 'slPdId',
            'type' => 'Integer',
        ),
        'standardId' => array(
            'name' => '产品标准ID',
            'column' => 'standardId',
            'type' => 'Integer',
        ),
        'stdItemId' => array(
            'name' => '技术标准项目ID',
            'column' => 'stdItemId',
            'type' => 'String',
        ),
        'isCatalog' => array(
            'name' => '是否为目录节点',
            'column' => 'isCatalog',
            'type' => 'String',
        ),
        'stdItemName' => array(
            'name' => '技术标准项目名称',
            'column' => 'stdItemName',
            'type' => 'String',
        ),
        'slPdGnqStdLevList' => array(
            'name' => '卖家产品加工技术标准指标值',
            'column' => 'slPdGnqStdLevList',
            'type' => 'List',
        ),
    ),
    'slPdGnqStdLevList' => array(
        'stdItemValue1' => array(
            'name' => '神农客技术标准项目值1',
            'column' => 'stdItemValue1',
            'type' => 'String',
        ),
        'stdItemValue2' => array(
            'name' => '神农客技术标准项目值2',
            'column' => 'stdItemValue2',
            'type' => 'String',
        ),
        'stdItemValue3' => array(
            'name' => '神农客技术标准项目值3',
            'column' => 'stdItemValue3',
            'type' => 'String',
        ),
        'agreeFlg' => array(
            'name' => '卖家同意标志',
            'column' => 'agreeFlg',
            'type' => 'String',
        ),
    ),

    'slPdTspStdList' => array(
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'slPdId' => array(
            'name' => '卖家产品ID',
            'column' => 'slPdId',
            'type' => 'Integer',
        ),
        'standardId' => array(
            'name' => '产品标准ID',
            'column' => 'standardId',
            'type' => 'Integer',
        ),
        'stdItemId' => array(
            'name' => '技术标准项目ID',
            'column' => 'stdItemId',
            'type' => 'String',
        ),
        'isCatalog' => array(
            'name' => '是否为目录节点',
            'column' => 'isCatalog',
            'type' => 'String',
        ),
        'stdItemName' => array(
            'name' => '技术标准项目名称',
            'column' => 'stdItemName',
            'type' => 'String',
        ),
        'slPdTspStdLevList' => array(
            'name' => '卖家产品加工技术标准指标值',
            'column' => 'slPdTspStdLevList',
            'type' => 'List',
        ),
    ),
    'slPdTspStdLevList' => array(
        'stdItemValue1' => array(
            'name' => '神农客技术标准项目值1',
            'column' => 'stdItemValue1',
            'type' => 'String',
        ),
        'stdItemValue2' => array(
            'name' => '神农客技术标准项目值2',
            'column' => 'stdItemValue2',
            'type' => 'String',
        ),
        'stdItemValue3' => array(
            'name' => '神农客技术标准项目值3',
            'column' => 'stdItemValue3',
            'type' => 'String',
        ),
        'agreeFlg' => array(
            'name' => '卖家同意标志',
            'column' => 'agreeFlg',
            'type' => 'String',
        ),
    ),

    'slPdSftStdList' => array(
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
        ),
        'slPdId' => array(
            'name' => '卖家产品ID',
            'column' => 'slPdId',
            'type' => 'Integer',
        ),
        'standardId' => array(
            'name' => '产品标准ID',
            'column' => 'standardId',
            'type' => 'Integer',
        ),
        'stdItemId' => array(
            'name' => '技术标准项目ID',
            'column' => 'stdItemId',
            'type' => 'String',
        ),
        'isCatalog' => array(
            'name' => '是否为目录节点',
            'column' => 'isCatalog',
            'type' => 'String',
        ),
        'stdItemName' => array(
            'name' => '技术标准项目名称',
            'column' => 'stdItemName',
            'type' => 'String',
        ),
        'slPdSftStdLevList' => array(
            'name' => '卖家产品加工技术标准指标值',
            'column' => 'slPdSftStdLevList',
            'type' => 'List',
        ),
    ),
    'slPdSftStdLevList' => array(
        'stdItemValue1' => array(
            'name' => '神农客技术标准项目值1',
            'column' => 'stdItemValue1',
            'type' => 'String',
        ),
        'stdItemValue2' => array(
            'name' => '神农客技术标准项目值2',
            'column' => 'stdItemValue2',
            'type' => 'String',
        ),
        'stdItemValue3' => array(
            'name' => '神农客技术标准项目值3',
            'column' => 'stdItemValue3',
            'type' => 'String',
        ),
        'agreeFlg' => array(
            'name' => '卖家同意标志',
            'column' => 'agreeFlg',
            'type' => 'String',
        ),
    ),


);