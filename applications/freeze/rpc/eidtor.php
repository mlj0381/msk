<?php
$remote['freeze_editor'] = array(
    'url' => '/bs/slInfo/slSeller/newOrUpdate',
    'params' => array(
        '' => array(
            'name' => '买手店编码',
            'column' => 'slCode',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '管家账号',
            'column' => 'houseAccount',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '登录手机号码',
            'column' => 'houseTel',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '卖家显示名称',
            'column' => 'houseShowName',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '联系人姓名',
            'column' => 'houseContact',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '登录密码',
            'column' => 'accountPsd',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '认证状态',
            'column' => 'authStatus',
            'type' => 'Integer',
            'parent' => '',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '管家身份证号',
            'column' => 'slIdcard',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '国籍',
            'column' => 'slConFlg',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '大区编码',
            'column' => 'areaCode',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '物流区编码',
            'column' => 'lgcsAreaCode',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '省编码',
            'column' => 'provinceCode',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '地区编码',
            'column' => 'cityCode',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '区编码',
            'column' => 'districtCode',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '管家地址',
            'column' => 'houseAddress',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => true
        ),

        'result' => array(
            // 'buyerId' => // os id
        ),
    );