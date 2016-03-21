<?php
$dbdata['account_register'] = array(

    'label' => '买家账号注册',
    'comment' => '根据买家账号名，密码以及手机号，注册买家',

    'columns' => array(
        'siteCode'=> array(
            'type'=> 'Integer',
            'required' => 'Y',
            'default' => '',
            'comment' => '客户端系统编号：参见“附_系统列表”',
        ),

        'auth'=> array(
            'type'=> 'String',
            'required' => 'Y',
            'default' => '',
            'comment' => '分配给各个平台的身份识别码',
        ),

        'loginId'=> array(
            'type'=> 'String',
            'required' => 'N',
            'default' => '',
            'comment' => '登陆的用户ID',
        ),

        'param'=> array(
            'type'=> 'array',
            'param'=> array(
                'telNo'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '手机号，用户手机号为必填',
                ),
                'accountName'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '账号名，若不填，则以手机号存入DB',
                ),
                'accountPass'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '账号密码，若不填，则以手机号存入DB',
                ),
                'registerSource'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '注册来源',
                ),
                'updId'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '更新者ID',
                ),
            ),
            'comment' => '业务参数',
        ),
    ),
);       


$dbdata['account_login'] = array(

    'label' => '买家账号登录',
    'comment' => '通过买家账号和密码或者手机号和密码登录 登录成功，获得买家ID',

    'columns' => array(
        'siteCode'=> array(
            'type'=> 'Integer',
            'required' => 'Y',
            'default' => '',
            'comment' => '客户端系统编号：参见“附_系统列表”',
        ),

        'auth'=> array(
            'type'=> 'String',
            'required' => 'Y',
            'default' => '',
            'comment' => '分配给各个平台的身份识别码',
        ),

        'loginId'=> array(
            'type'=> 'String',
            'required' => 'N',
            'default' => '',
            'comment' => '登陆的用户ID',
        ),

        'param'=> array(
            'type'=> 'array',
            'param'=> array(
                'accountName'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '买家账号或者手机号',
                ),
                'accountPass'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '密码',
                ),
            ),//Object
            'comment' => '业务参数',
        ),
    ),
);


$dbdata['buyerInfo_update'] = array(

    'label' => '更新买家基本信息',
    'comment' => '通过买家ID更新买家基本信息',

    'columns' => array(
        'siteCode'=> array(
            'type'=> 'Integer',
            'required' => 'Y',
            'default' => '',
            'comment' => '客户端系统编号：参见“附_系统列表”',
        ),

        'auth'=> array(
            'type'=> 'String',
            'required' => 'Y',
            'default' => '',
            'comment' => '分配给各个平台的身份识别码',
        ),

        'loginId'=> array(
            'type'=> 'String',
            'required' => 'N',
            'default' => '',
            'comment' => '登陆的用户ID',
        ),

        'param'=> array(
            'type'=> 'array',
            'param'=> array(
                'buyerId'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '买家ID',
                ),
                'buyerCode'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '买家编码',
                ),
                'buyerName'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '买家名称',
                ),
                'buyerAddr'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '买家地址',
                ),
                'superiorId'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '所属ID',
                ),
                'buyerWebsite'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '买家网站',
                ),
                'buyerWechat'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '买家微信公众号',
                ),
                'storeNo'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '店铺号',
                ),
                'storeArea'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '店铺面积',
                ),
                'busiTel'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '营业电话',
                ),
                'employeesNum'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '员工人数',
                ),
                'paymentType'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '习惯支付方式',
                ),
                'planOrderGap'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '计划订货间隙',
                ),
                'planOrderNum'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '计划订货量',
                ),
                'actualOrderGap'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '实际订货间隙',
                ),
                'actualOrderNum'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '实际订货量',
                ),
                'marketingsStatus'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '上线状态',
                ),
                'updId'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '更新者ID',
                ),
            ),//Object
            'comment' => '业务参数',
        ),
    ),
);  


$dbdata['pdClassification_update'] = array(

    'label' => '更新买家经营产品类别',
    'comment' => '通过买家ID更新买家经营产品类别',

    'columns' => array(
        'siteCode'=> array(
            'type'=> 'Integer',
            'required' => 'Y',
            'default' => '',
            'comment' => '客户端系统编号：参见“附_系统列表”',
        ),

        'auth'=> array(
            'type'=> 'String',
            'required' => 'Y',
            'default' => '',
            'comment' => '分配给各个平台的身份识别码',
        ),

        'loginId'=> array(
            'type'=> 'String',
            'required' => 'N',
            'default' => '',
            'comment' => '登陆的用户ID',
        ),

        'param'=> array(
            'type'=> 'array',
            'param'=> array(
                'buyerId'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '买家ID',
                ),
                'classCode'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '产品类别编码',
                ),
                'className'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '产品类别名称',
                ),
                'updId'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '更新者ID',
                ),
            ),//Object
            'comment' => '业务参数',
        ),
    ),
);


$dbdata['salesTarget_update'] = array(

    'label' => '更新买家销售对象',
    'comment' => '通过买家ID更新买家销售对象',

    'columns' => array(
        'siteCode'=> array(
            'type'=> 'Integer',
            'required' => 'Y',
            'default' => '',
            'comment' => '客户端系统编号：参见“附_系统列表”',
        ),

        'auth'=> array(
            'type'=> 'String',
            'required' => 'Y',
            'default' => '',
            'comment' => '分配给各个平台的身份识别码',
        ),

        'loginId'=> array(
            'type'=> 'String',
            'required' => 'N',
            'default' => '',
            'comment' => '登陆的用户ID',
        ),

        'param'=> array(
            'type'=> 'array',
            'param'=> array(
                'buyerId'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '买家ID',
                ),
                'salesTargetType'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '销售对象类型',
                ),
                'salesTargetName'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '销售对象名称',
                ),
                'updId'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '更新者ID',
                ),
            ),//Object
            'comment' => '业务参数',
        ),
    ),
);


$dbdata['licence_update'] = array(

    'label' => '更新证照信息',
    'comment' => '通过买家ID更新证照信息',

    'columns' => array(
        'siteCode'=> array(
            'type'=> 'Integer',
            'required' => 'Y',
            'default' => '',
            'comment' => '客户端系统编号：参见“附_系统列表”',
        ),

        'auth'=> array(
            'type'=> 'String',
            'required' => 'Y',
            'default' => '',
            'comment' => '分配给各个平台的身份识别码',
        ),

        'loginId'=> array(
            'type'=> 'String',
            'required' => 'N',
            'default' => '',
            'comment' => '登陆的用户ID',
        ),

        'param'=> array(
            'type'=> 'array',
            'param'=> array(
                'buyerId'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '买家ID',
                ),
                'licName'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '营业执照名称',
                ),
                'licNumber'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '营业执照号码',
                ),
                'legalName'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '法定代表人姓名',
                ),
                'legalLicType'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '法定代表人类型',
                ),
                'legalLicNumber'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '法定代表人号码',
                ),
                'updId'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '更新者ID',
                ),
            ),//Object
            'comment' => '业务参数',
        ),
    ),
);


$dbdata['pictures_update'] = array(

    'label' => '更新证照图片',
    'comment' => '通过买家ID更新证照图片',

    'columns' => array(
        'siteCode'=> array(
            'type'=> 'Integer',
            'required' => 'Y',
            'default' => '',
            'comment' => '客户端系统编号：参见“附_系统列表”',
        ),

        'auth'=> array(
            'type'=> 'String',
            'required' => 'Y',
            'default' => '',
            'comment' => '分配给各个平台的身份识别码',
        ),

        'loginId'=> array(
            'type'=> 'String',
            'required' => 'N',
            'default' => '',
            'comment' => '登陆的用户ID',
        ),

        'param'=> array(
            'type'=> 'array',
            'param'=> array(
                'buyerId'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '买家ID',
                ),
                'picLicensePath'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '营业执照图片地址',
                ),
                'picOrgStructurePath'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '组织机构代码证图片',
                ),
                'picTaxRegistrationPath'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '税务登记证图片',
                ),
                'picFoodCirculationPath'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '食品流通许可证图片',
                ),
                'picCertPath'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '法定代表人证件图片',
                ),
                'updId'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '更新者ID',
                ),
            ),//Object
            'comment' => '业务参数',
        ),
    ),
);


$dbdata['employee_update'] = array(

    'label' => '更新雇员信息',
    'comment' => '通过买家ID更新雇员信息',

    'columns' => array(
        'siteCode'=> array(
            'type'=> 'Integer',
            'required' => 'Y',
            'default' => '',
            'comment' => '客户端系统编号：参见“附_系统列表”',
        ),

        'auth'=> array(
            'type'=> 'String',
            'required' => 'Y',
            'default' => '',
            'comment' => '分配给各个平台的身份识别码',
        ),

        'loginId'=> array(
            'type'=> 'String',
            'required' => 'N',
            'default' => '',
            'comment' => '登陆的用户ID',
        ),

        'param'=> array(
            'type'=> 'array',
            'param'=> array(
                'buyerId'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '买家ID',
                ),
                'employeeType'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '类型',
                ),
                'employeeName'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '姓名',
                ),
                'employeeTel'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '手机号',
                ),
                'employeeQq'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => 'QQ号',
                ),
                'employeeWechat'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '微信号',
                ),
                'busCardFlg'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '有无名片照',
                ),
                'contactPerson'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '是否联络人',
                ),
                'purchase'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '是否采购人',
                ),
                'receivePerson'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '是否收货人',
                ),
                'updId'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '更新者ID',
                ),
            ),//Object
            'comment' => '业务参数',
        ),
    ),
);


$dbdata['receiveAddr_update'] = array(

    'label' => '更新收货地址',
    'comment' => '通过买家ID更新收货地址',

    'columns' => array(
        'siteCode'=> array(
            'type'=> 'Integer',
            'required' => 'Y',
            'default' => '',
            'comment' => '客户端系统编号：参见“附_系统列表”',
        ),

        'auth'=> array(
            'type'=> 'String',
            'required' => 'Y',
            'default' => '',
            'comment' => '分配给各个平台的身份识别码',
        ),

        'loginId'=> array(
            'type'=> 'String',
            'required' => 'N',
            'default' => '',
            'comment' => '登陆的用户ID',
        ),

        'param'=> array(
            'type'=> 'array',
            'param'=> array(
                'buyerId'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '买家ID',
                ),
                'receiveAddr'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '收货地址',
                ),
                'updId'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '更新者ID',
                ),
            ),//Object
            'comment' => '业务参数',
        ),
    ),
);


$dbdata['receiveTime_update'] = array(

    'label' => '更新收货时间',
    'comment' => '通过买家ID更新收货时间',

    'columns' => array(
        'siteCode'=> array(
            'type'=> 'Integer',
            'required' => 'Y',
            'default' => '',
            'comment' => '客户端系统编号：参见“附_系统列表”',
        ),

        'auth'=> array(
            'type'=> 'String',
            'required' => 'Y',
            'default' => '',
            'comment' => '分配给各个平台的身份识别码',
        ),

        'loginId'=> array(
            'type'=> 'String',
            'required' => 'N',
            'default' => '',
            'comment' => '登陆的用户ID',
        ),

        'param'=> array(
            'type'=> 'array',
            'param'=> array(
                'buyerId'=> array(
                    'type'=> 'String',
                    'required' => 'Y',
                    'default' => '',
                    'comment' => '买家ID',
                ),
                'timeDescribe'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '时间描述',
                ),
                'updId'=> array(
                    'type'=> 'String',
                    'required' => 'N',
                    'default' => '',
                    'comment' => '更新者ID',
                ),
            ),//Object
            'comment' => '业务参数',
        ),
    ),
);
