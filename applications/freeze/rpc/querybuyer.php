<?php
/**
 * 查询买手冻品管家的买家信息---------------IBS2101107
 */
$remote['freeze_querybuyer'] = array(
    'url' => '/bs/slInfo/slExclusive/search',
    'request' => array(
        'member_id' => array(
            'name' => '登陆的用户ID',
            'column' => 'loginId',
            'type' => 'String',
            'default' => '',
            'require' => false
        ) ,
        'param' => array(
            'name' => '参数',
            'column' => 'param',
            'type' => 'object',
            'default' => Array() ,
            //'require'=> true

        ) ,
    ) ,
    'param' => array(
        'houseCode' => array(
            'name' => '管家编码',
            'column' => 'houseCode',
            'type' => 'String',
            'default' => '',
            'require' => false
        ) ,
        'slCode' => array(
            'name' => '卖家编码',
            'column' => 'slCode',
            'type' => 'String',
            'default' => '',
            'require' => false
        ) ,
        'buyerId' => array(
            'name' => '买家编码',
            'column' => 'buyerId',
            'type' => 'String',
            'default' => '',
            'require' => false
        ) ,
        'buyerFlag' => array(
            'name' => '1:专属买家、2：抢单买家',
            'column' => 'buyerFlag',
            'type' => 'String',
            'default' => '',
            'require' => false
        ) ,
        'pageCount' => array(
            'name' => '每页显示的页数',
            'column' => 'pageCount',
            'type' => 'String',
            'default' => '',
            'require' => false
        ) ,
        'pageNo' => array(
            'name' => '页数',
            'column' => 'pageNo',
            'type' => 'String',
            'default' => '',
            'require' => false
        ) ,
        'applyStatus' => array(
            'name' => '申请状态',
            'column' => 'applyStatus',
            'type' => 'String',
            'require' => false
        ) ,
    ) ,
    'response' => array(
        'totalCount' => array(
            'name' => '总条数',
            'column' => 'count',
            'type' => 'String',
            'require' => false,
        ),
        'totalPage' => array(
            'name' => '总页数',
            'column' => 'total_page',
            'type' => 'String',
            'require' => false,
        ),
        'pageNo' => array(
            'name' => '当前页数',
            'column' => 'pageNo',
            'type' => 'String',
            'require' => false,
        ),
        'slBuyerList' => array(
            'name' => '买手买家列表',
            'coloumn' => 'slBuyerList',
            'type' => 'List',
        ) ,
    ) ,
    'slBuyerList' => array(
        'buyerFlag' => array(
            'name' => '1:专属买家、2：抢单买家',
            'column' => 'buyerFlag',
            'type' => 'String'
        ) ,
        'slCode' => array(
            'name' => '买手店ID',
            'column' => 'slCode',
            'type' => 'String'
        ) ,
        'houseCode' => array(
            'name' => '管家ID',
            'column' => 'houseCode',
            'type' => 'String'
        ) ,
        'buyerId' => array(
            'name' => '买家ID',
            'column' => 'buyer_id',
            'type' => 'String'
        ) ,
        'buyerCode' => array(
            'name' => '买家编码',
            'column' => 'buyerCode',
            'type' => 'String'
        ) ,
        'buyerName' => array(
            'name' => '买家名',
            'column' => 'buyerName',
            'type' => 'String'
        ) ,
        'lgcsAreaCode' => array(
            'name' => '物流区编码',
            'column' => 'lgcsAreaCode',
            'type' => 'String'
        ) ,
        'lgcsAreaName' => array(
            'name' => '物流区名',
            'column' => 'lgcsAreaName',
            'type' => 'String'
        ) ,
        'provinceCode' => array(
            'name' => '省编码',
            'column' => 'provinceCode',
            'type' => 'String'
        ) ,
        'provinceName' => array(
            'name' => '省名',
            'column' => 'provinceName',
            'type' => 'String'
        ) ,
        'cityCode' => array(
            'name' => '地区编码名',
            'column' => 'cityCode',
            'type' => 'String'
        ) ,
        'cityName' => array(
            'name' => '地区名',
            'column' => 'cityName',
            'type' => 'String'
        ) ,
        'districtCode' => array(
            'name' => '区编码名',
            'column' => 'districtCode',
            'type' => 'String'
        ) ,
        'districtName' => array(
            'name' => '区名',
            'column' => 'districtName',
            'type' => 'String'
        ) ,
        'buyerAddr' => array(
            'name' => '买家地址',
            'column' => 'address',
            'type' => 'String'
        ) ,
        'busiTel' => array(
            'name' => '买家联系电话',
            'column' => 'busiTel',
            'type' => 'String'
        ) ,
        'startTime' => array(
            'name' => '开始日时',
            'column' => 'startTime',
            'type' => 'datetime'
        ) ,
        'endTime' => array(
            'name' => '结束日时',
            'column' => 'endTime',
            'type' => 'datetime'
        ) ,
        'applyTime' => array(
            'name' => '申请日时',
            'column' => 'applyTime',
            'type' => 'datetime'
        ) ,
        'applyStatus' => array(
            'name' => '申请状态',
            'column' => 'applyStatus',
            'type' => 'String'
        ) ,
        'applySide' => array(
            'name' => '认证方式',
            'column' => 'applySide',
            'type' => 'String'
        ) ,
        'ver' => array(
            'name' => '版本号',
            'column' => 'ver',
            'type' => 'Integer'
        ) ,
    ) ,
);