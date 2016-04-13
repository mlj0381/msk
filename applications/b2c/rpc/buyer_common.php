<?php
/**
 * 查询公共买家池买家信息---------------IBS2101108
 */
$remote['b2c_buyer_common'] = array(
    'url' => '/bs/slInfo/searchBuyer',
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
        ),
    ),

    'param' => array(
        'pageCount' => array(
            'name' => '每页显示的条数',
            'column' => 'pageCount',
            'type' => 'Integer',
            'require' => false,
        ),
        'pageNo' => array(
            'name' => '页数',
            'column' => 'pageNo',
            'type' => 'Integer',
            'require' => false,
        ),
        'provinceCode' => array(
            'name' => '省编码',
            'column' => 'provinceCode',
            'type' => 'String',
            'require' => false,
        ),
        'cityCode' => array(
            'name' => '地区编码',
            'column' => 'cityCode',
            'type' => 'String',
            'require' => false,
        ),
        'districtCode' => array(
            'name' => '区编码',
            'column' => 'districtCode',
            'type' => 'String',
            'require' => false,
        ),
        'buyerAddr' => array(
            'name' => '买家地址',
            'column' => 'buyerAddr',
            'type' => 'String',
            'require' => false,
        ),
        'salesTargetType' => array(
            'name' => '销售对象类型',
            'column' => 'salesTargetType',
            'type' => 'String',
            'require' => false,
        ),
        'classCode' => array(
            'name' => '产品类别编码',
            'column' => 'classCode',
            'type' => 'String',
            'require' => false,
        ),
    ),

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
            'column' => 'slBuyerList',
            'type' => 'List',
        ),
        'byBuyerSalestargetList' => array(
            'name' => '买家产品销售对象表',
            'column' => 'byBuyerSalestargetList',
            'type' => 'List',
        ),
        'byBuyerPdClaList' => array(
            'name' => '买家经营产品类别表',
            'column' => 'byBuyerPdClaList',
            'type' => 'List',
        ),
    ),
    'slBuyerList' => array(
        'buyerId' => array(
            'name' => '买家ID',
            'column' => 'buyerId',
            'type' => 'String',
        ),
        'buyerCode' => array(
            'name' => '买家编码',
            'column' => 'buyerCode',
            'type' => 'String',
        ),
        'buyerName' => array(
            'name' => '买家名',
            'column' => 'buyerName',
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
            'name' => '地区编码',
            'column' => 'cityCode',
            'type' => 'String',
        ),
        'cityName' => array(
            'name' => '地区名',
            'column' => 'cityName',
            'type' => 'String',
        ),
        'districtCode' => array(
            'name' => '区编码',
            'column' => 'districtCode',
            'type' => 'String',
        ),
        'districtName' => array(
            'name' => '区名',
            'column' => 'districtName',
            'type' => 'String',
        ),
        'buyerAddr' => array(
            'name' => '买家地址',
            'column' => 'address',
            'type' => 'String',
        ),
        'busiTel' => array(
            'name' => '买家联系电话',
            'column' => 'mobile',
            'type' => 'String',
        ),
    ),
    'byBuyerSalestargetList' => array(
        'salesTargetType' => array(
            'name' => '销售对象类型',
            'column' => 'salesTargetType',
            'type' => 'String',
        ),
        'salesTargetName' => array(
            'name' => '销售对象名称',
            'column' => 'salesTargetName',
            'type' => 'String',
        ),
    ),
    'byBuyerPdClaList' => array(
        'classCode' => array(
            'name' => '产品类别编码',
            'column' => 'classCode',
            'type' => 'String',
        ),
        'className' => array(
            'name' => '产品类别名称',
            'column' => 'className',
            'type' => 'String',
        ),
    ),

);