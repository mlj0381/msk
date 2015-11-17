<?php

// +----------------------------------------------------------------------
// | VMCSHOP [V M-Commerce Shop]
// +----------------------------------------------------------------------
// | Copyright (c) vmcshop.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.vmcshop.com/licensed)
// +----------------------------------------------------------------------
// | Author: Shanghai ChenShang Software Technology Co., Ltd.
// +----------------------------------------------------------------------

/**
 *  getConf 默认值.
 */
$setting = array(
	'avatar_max_size' => array(
		'type' => 'number',
		'default' => get_cfg_var('upload_max_filesize') ? intval(get_cfg_var('upload_max_filesize')) : '5',
		'desc' => '头像上传大小限制(单位：MB)',
		'helpinfo'=>(get_cfg_var('upload_max_filesize') ? '<span class="text-danger">服务器当前限制'.get_cfg_var('upload_max_filesize').'</span>' : '')
	),
	// 店铺模板设置
	'store_template' => array(
		'default' => array(
			'index' => array(
				'label' => '首页',
				'modules' => array(
					0 => array(
						'label' => '幻灯',
						'type' => 'slider',
						'size' => '1920,600',
						'limit'=> 4,
						'items' => array(),
					),
					1 => array(
						'label' => '新品推荐',
						'type' => 'goods',
						'size' => '1920,600',
						'limit'=> 8,
						'items' => array(),
					),
					2 => array(
						'label' => 'banner1',
						'type' => 'image',
						'size' => '1920,600',
						'limit'=> 1,
						'items' => array(),
					),
					3 => array(
						'label' => '热门推荐',
						'type' => 'goods',
						'size' => '1920,600',
						'limit'=> 8,
						'items' => array(),
					),
					4 => array(
						'label' => 'banner2',
						'type' => 'image',
						'size' => '1920,600',
						'limit'=> 1,
						'items' => array(),
					),
					5 => array(
						'label' => '店铺推荐',
						'type' => 'goods',
						'size' => '1920,600',
						'limit'=> 8,
						'items' => array(),
					),
				),
			),
			'list' => array(
				'label' => '列表页',
				'modules' => array(
					0 => array(
						'label' => '横幅',
						'type' => 'image',
						'size' => '1920,600',
						'limit'=> 4,
						'items' => array(),
					),
					1 => array(
						'label' => '新品推荐',
						'type' => 'goods',
						'size' => '1920,600',
						'limit'=> 8,
						'items' => array(),
					),
				),
			),
		),
	),
	
);
