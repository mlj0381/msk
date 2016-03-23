<?php
/**
 * 编辑冻品管家信息---------------IBS2101104
 */
$remote['freeze_editor'] = array(
    'url' => '/bs/slInfo/slSeller/newOrUpdate',

    'params' => array(
        'member_id' => array(
            'name' => '登陆的用户ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require'=> false
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
        'buyer_code' => array(
            'name' => '买手店编码',
            'column' => 'slCode',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        'login_account' => array(
            'name' => '管家账号',
            'column' => 'houseAccount',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        'mobile' => array(
            'name' => '登录手机号码',
            'column' => 'houseTel',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        'buyer_name' => array(
            'name' => '卖家显示名称',
            'column' => 'houseShowName',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        'name' => array(
            'name' => '联系人姓名',
            'column' => 'houseContact',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        'login_password' => array(
            'name' => '登录密码',
            'column' => 'accountPsd',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        'auth_status' => array(
            'name' => '认证状态',
            'column' => 'authStatus',
            'type' => 'Integer',
            'default' => '',
            'require' => false
        ),
        'ID' => array(
            'name' => '管家身份证号',
            'column' => 'slIdcard',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        'nationality' => array(
            'name' => '国籍',
            'column' => 'slConFlg',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        'area_code' => array(
            'name' => '大区编码',
            'column' => 'areaCode',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        'logistics_code' => array(
            'name' => '物流区编码',
            'column' => 'lgcsAreaCode',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        'province_code' => array(
            'name' => '省编码',
            'column' => 'provinceCode',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        'city_code' => array(
            'name' => '地区编码',
            'column' => 'cityCode',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        'district_code' => array(
            'name' => '区编码',
            'column' => 'districtCode',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        'manage_area' => array(
            'name' => '管家地址',
            'column' => 'houseAddress',
            'type' => 'String',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '管家介绍',
            'column' => 'houseIntroduce',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '级别',
            'column' => 'houseClass',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '管家分类',
            'column' => 'houseCategory',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '管家分类基本',
            'column' => 'HOUSE_CATEGORY0',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '管家分类分销',
            'column' => 'HOUSE_CATEGORY1',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '管家分类菜场',
            'column' => 'HOUSE_CATEGORY2',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '管家分类团膳',
            'column' => 'HOUSE_CATEGORY3',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '管家分类火锅',
            'column' => 'HOUSE_CATEGORY4',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '管家分类中餐',
            'column' => 'HOUSE_CATEGORY5',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '管家分类西餐',
            'column' => 'HOUSE_CATEGORY6',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '管家分类小吃烧烤',
            'column' => 'HOUSE_CATEGORY7',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '管家分类加工厂',
            'column' => 'HOUSE_CATEGORY8',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '等级',
            'column' => 'grade',
            'type' => 'Integer',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '创建者ID/更新者ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '删除标志',
            'column' => 'delFlg',
            'type' => 'String',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer',
            'default' => '',
            'require' => false
        ),
        'list_1' => array(
            'name' => '经营区域List',
            'column' => 'slAreaList',
            'type' => 'list',
            'default' => '',
            'require' => false
        ),
        'list_2' => array(
            'name' => '',
            'column' => 'housePdList',
            'type' => 'list',
            'default' => '',
            'require' => false
        ),
    ),

    'list_1' => array(
        '' => array(
            'name' => '经营区域ID',
            'column' => 'slAreaId',
            'type' => 'Integer',
            'default' => '',
            'require'=> false
        ),
        '' => array(
            'name' => '物流区编码',
            'column' => 'lgcsAreaCode',
            'type' => 'String',
            'default' => '',
            'require'=> false
        ),
        '' => array(
            'name' => '省编码',
            'column' => 'provinceCode',
            'type' => 'String',
            'default' => '',
            'require'=> false
        ),
        '' => array(
            'name' => '地区编码',
            'column' => 'cityCode',
            'type' => 'String',
            'default' => '',
            'require'=> false
        ),
        '' => array(
            'name' => '区编码',
            'column' => 'districtCode',
            'type' => 'String',
            'default' => '',
            'require'=> false
        ),
        '' => array(
            'name' => '经营地址',
            'column' => 'address',
            'type' => 'String',
            'default' => '',
            'require'=> false
        ),
    ),

    'list_2' => array(
        '' => array(
            'name' => '管家管理产品ID',
            'column' => 'pdId',
            'type' => 'Integer',
            'default' => '',
            'require'=> false
        ),
        '' => array(
            'name' => '产品类别',
            'column' => 'pdClassesCode',
            'type' => 'String',
            'default' => '',
            'require'=> false
        ),
        '' => array(
            'name' => '产品二级分类编码',
            'column' => 'machiningCode',
            'type' => 'String',
            'default' => '',
            'require'=> false
        ),
        '' => array(
            'name' => '产品品种',
            'column' => 'pdBreedCode',
            'type' => 'String',
            'default' => '',
            'require'=> false
        ),
        '' => array(
            'name' => '产品特征',
            'column' => 'pdFeatureCode',
            'type' => 'String',
            'default' => '',
            'require'=> false
        ),
    ),

    'result' => array(
            // 'buyerId' => // os id
    ),
);