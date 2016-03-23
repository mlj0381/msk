<?php
// 质量标准List
$remote['b2c_quality_standard'] = array(
	'requestCode' => 'IPD141112',
	'url' => '/pd/pd_tnc_std',	

	'request' => array(
		'member_id' => array(
			'name' => '登陆的用户ID',
			'column' => 'loginId',
			'type' => 'String',			
			'default' => '2',
			'require'=> true // ture|false 注册|修改			
		),
		'param' => array(
			'name' => '参数',
			'column' => 'param',
			'type' => 'object',
			'default' => Array(),
		)
	),

	'param' => array(
		'cate_1' => array(
			'name' => '类别编码',
			'column' => 'classesCode',
			'type' => 'String',			
			'default' => '01',
			'require'=> false // ture|false 注册|修改	
		),
		'cate_2' => array(
			'name' => '二级分类编码',
			'column' => 'machiningCode',
			'type' => 'String',			
			'default' => '1',
			'require'=> false // ture|false 注册|修改	
		),
		'goods_type' => array(
			'name' => '品种编码',
			'column' => 'breedCode',
			'type' => 'String',			
			'default' => '01',
			'require'=> false // ture|false 注册|修改	
		),
		'feature' => array(
			'name' => '产品特征编码',
			'column' => 'featureCode',
			'type' => 'String',			
			'default' => '01',
			'require'=> false // ture|false 注册|修改	
		),
	),
	'response' => array(	
		'tncStdItemId' => array(			
			'name' => '分类指标ID',
			'column' => 'quality_id',
			'type' => 'String'
		),
		'tncStdItemName' => array(
			'name' => '分类指标',
			'column' => 'name',
			'type' => 'String'			
		),
		'tncStdVal1' => array(
			'name' => '技术标准项目值1',
			'column' => 'value1',
			'type' => 'String'			
		),
		'tncStdVal2' => array(
			'name' => '技术标准项目值2',
			'column' => 'value2',
			'type' => 'String'
		),
		'tncStdVal3' => array(
			'name' => '技术标准项目值3',
			'column' => 'value3',
			'type' => 'String'
		)
	)
);