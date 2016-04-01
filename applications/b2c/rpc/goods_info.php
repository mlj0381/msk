<?
$remote['b2c_goods_info'] = array(
	'requestCode' => 'IPD141115',
	'url' => '/pd/pdBidInfo',	

	'request' => array(
		'member_id' => array(
			'name' => '登陆的用户ID',
			'column' => 'loginId',
			'type' => 'String',			
			'default' => '',
			'require'=> false // ture|false 注册|修改			
		),		
	),
	
	'response' => array(	
		'totalCount' => array(			
			'name' => '总记录',
			'column' => 'totalCount',
			'type' => 'number'
		),
		'totalPage' => array(
			'name' => '总页数',
			'column' => 'totalPage',
			'type' => 'number'			
		),
		'pageNo' => array(
			'name' => '当前页',
			'column' => 'page',
			'type' => 'String'			
		),
		'pdList' => array(
			'name' => '结果',
			'column' => 'goods',
			'type' => 'list'
		)				
	),

	'pdList' => array(
		'productCode' => array(
			'name' => '产品编码',
			'column' => 'bn',
			'type' => 'String'
		),
		'productName' => array(
			'name' => '产品编码',
			'column' => 'name',
			'type' => 'String'
		),
		'classesCode' => array(
			'name' => '产品名称',
			'column' => 'cat_1',
			'type' => 'String'
		),
		'machiningCode' => array(
			'name' => '分类编码',
			'column' => 'cat_2',
			'type' => 'String'
		),
		'breedCode' => array(
			'name' => '二级分类编码',
			'column' => 'breed_code',
			'type' => 'String'
		),
		'featureCode' => array(
			'name' => '产品品种编码',
			'column' => 'feature',
			'type' => 'String'
		),
		'weightCode' => array(
			'name' => '产品特征编码',
			'column' => 'weight',
			'type' => 'String'
		),
		'pkgCode' => array(
			'name' => '产品净重编码',
			'column' => 'pack',
			'type' => 'String'
		),
		'productSpec' => array(
			'name' => '包装规格',
			'column' => 'spec',
			'type' => 'String'
		),
		'netWeight' => array(
			'name' => '产品规格',
			'column' => 'net_weight',
			'type' => 'String'
		)			
	),
);