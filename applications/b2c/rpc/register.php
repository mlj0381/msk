<?php

$remote['seller_register'] = array(
	'params' => array(
		'member_id' => array(
			'name' => '登陆的用户ID',
			'column' => 'loginId',
			'type' => 'String',
			'parent' => '',
			'default' => '',
			'require'=> false // ture|false 注册|修改			
		),
		'mobile' => array(
			'name' => '手机',
			'column' => 'telNo',
			'type' => 'String',
			'parent' => 'param',
			'default' => '',
			'require'=> true
		),
		'account' => array(
			'name' => '账号',
			'accountName' => 'telNo',
			'type' => 'String',
			'parent' => 'param',
			'default' => '',
			'require'=> false
		),

		'password' => array(
			'name' => '密码',
			'column' => 'accountPass',
			'type' => 'md5',
			'parent' => 'param',
			'default' => '',
			'require'=> false
		),

		'source' => array(
			'name' => '来源',
			'column' => 'registerSource',
			'type' => 'String',
			'parent' => 'param',
			'default' => '',
			'require'=> false
		),

		'operator' => array(
			'name' => '操作者',
			'column' => 'updId',
			'type' => 'String',
			'parent' => 'param',
			'default' => '',
			'require'=> false
		)		
	),

	'result' => array(
		// 'buyerId' => 
	),
);