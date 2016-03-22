<?php
$remote['b2c_order_create'] = array(
	
	'url' => '/so/pro/new',	
	
	'params' => array(
		'member_id' => array(
			'name' => '登陆的用户ID',
			'column' => 'loginId',
			'type' => 'String',			
			'default' => '',
			'require'=> false // ture|false 注册|修改			
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
		'years' => array(
			'name' => '年月',
			'column' => 'years',
			'type' => 'date@yyyy-mm',
			'default' => '',
			'require'=> true
		),
		'region_id' => array(
			'name' => '账号',
			'column' => 'districtCode',
			'type' => 'String',
			'default' => '',
			'require'=> true
		),
		'status' => array(
			'name' => '密码',
			'column' => 'orderStatus',
			'type' => 'number',
			'default' => '1',
			'require'=> true
		),
		'goods' => array(
			'name' => '产品',
			'column' => 'products',
			'type' => 'list',
			'default' => '',
			'require'=> true
		),
		'address' => array(
			'name' => '收货地址',
			'column' => 'areaStr',
			'type' => 'object',			
			'default' => '',
			'require'=> true
		),
	),	
	'goods' => array(
		'goods_id' => array(
			'name' => '产品ID',
			'column' => 'pdCode',
			'type' => 'String',			
			'default' => '',
			'require'=> false
		),
		'goods_name' => array(
			'name' => '产品名称',
			'column' => 'pdName',
			'type' => 'String',		
			'default' => '',
			'require'=> false
		),
	),
	'address' => array(
		'id' => array(
			'name' => '收货ID',
			'column' => 'relaverId',
			'type' => 'String',			
			'default' => '',
			'require'=> false
		),
		'region_id' => array(
			'name' => '区域',
			'column' => 'relaverCode',
			'type' => 'String',			
			'default' => '',
			'require'=> false
		),
		'address' => array(
			'name' => '地址',
			'column' => 'relaverAddress',
			'type' => 'String',		
			'default' => '',
			'require'=> false
		),
		'mobile' => array(
			'name' => '手机',
			'column' => 'telNo',
			'type' => 'String',		
			'default' => '',
			'require'=> false
		),
	),
	
	'result' => array(
		// 'buyerId' => // os id
	),
);