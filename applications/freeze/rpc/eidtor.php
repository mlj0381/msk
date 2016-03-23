<?php
$remote['freeze_editor'] = array(
	'url' => '/by/account/register',
	'params' => array(
		'member_id' => array(
			'name' => '登陆的用户ID',
			'column' => 'loginId',
			'type' => 'String',
			'parent' => '',
			'default' => '',
			'require'=> false // ture|false 注册|修改			
		),

		'param' => array(
			'name' => '参数',
			'column' => 'param',
			'type' => 'object'			
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
			'column' => 'accountName',
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
			'default' => 'msk',
			'require'=> true
		),
		'operator' => array(
			'name' => '操作者',
			'column' => 'updId',
			'type' => 'String',
			'parent' => 'param',
			'default' => '',
			'require'=> false
		),		
		'cate' => array(
			'name' => '参数',
			'column' => 'cateList',
			'type' => 'object',
			'parent' => 'param',
			'require' => true
		)
	),

	'cate' => array(
		'cate_name' => array(
			'name' => '分类名称',
			'column' => 'cateName',
			'type' => 'String',
			'parent' => 'param/cate',
			'default' => '',
			'require'=> false
		),
		'cate_id' => array(
			'name' => '分类ID',
			'column' => 'cateNo',
			'type' => 'String',
			'parent' => 'param/cate',
			'default' => '',
			'require'=> false
		)
	),

	'result' => array(
		// 'buyerId' => // os id
	),
);