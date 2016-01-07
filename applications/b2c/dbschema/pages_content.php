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



$db['pages_content'] = array(
    'columns' =>
    array(
        'content_id' => array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => ('id'),
            'comment' => ('id'),
        ),
		'pages_id' => array(
            'type' => 'table:pages',
            'default' => 0,
            'required' => true,
            'label' => ('所属页面'),
			'in_list' => true,
            'default_in_list' => false,
        ),
		'position_id' => array(
            'type' => 'table:pages_position',
            'default' => 0,
            'required' => true,
            'label' => ('广告位'),
			'comment' => ('广告位'),
			'in_list' => true,
            'default_in_list' => false,
        ),
		'store_id' => array(
            'type' => 'table:store@store',
            'default' => 0,
            'required' => true,
            'label' => ('店铺'),
        ),
        'title' => array(
            'type' => 'varchar(100)',
            'label' => ('标题'),
            'comment' => ('标题'),
            'required' => true,
            'in_list' => true,
            'default_in_list' => true,
        ),
		'url' => array(
            'type' => 'varchar(255)',
            'label' => ('链接'),
            'comment' => ('链接'),
            'required' => true,
            'in_list' => true,
            'default_in_list' => true,
        ),
		'image_id' => array(
			'type' => 'table:image@image',
			'required' => true,
			'default' => '',
			'label' => '图片',
			'comment' => '图片ID',
			'in_list' => true,
            'default_in_list' => true,
        ),
		'extra' => array(
            'type' => 'serialize',
            'comment' => ('扩展') ,
        ),
		'type' => array(
           'type' => array(
                '0' => ('普通'),
                '1' => ('图片'),
				'2' => ('商品'),
            ),
            'label' => ('类型'),
            'comment' => ('类型'),
            'required' => true,
            'default' => '0',
            'in_list' => true,
            'default_in_list' => true,
			'filtertype' => 'yes',
        ),
		'detail' => array(
            'type' => 'text',
			'label' => ('内容'),			
        ),
		'status' => array(
			'type' => array(
                '0' => ('正常'),
                '1' => ('关闭'),
            ),			
			'label' => ('状态'),
            'comment' => ('启用状态'),
            'required' => true,
            'default' => '0',
            'in_list' => true,
            'default_in_list' => true,
			'filtertype' => 'yes',
        ),
		'create_time' => array (
			  'type' => 'time',
			  'label' => ('创建时间'),
			  'width' => 110,			 
			  'in_list' => true,
		),
		'start_time' => array (
			  'type' => 'time',
			  'label' => ('开始时间'),
			  'in_list' => false,
		),
		'end_time' => array (
			  'type' => 'time',
			  'label' => ('结束时间'),
			  'in_list' => false,
		),
		'ordernum' => array(
            'type' => 'number',
            'required' => true,
            'default' => 0,
            'label' => '排序' ,
			'comment' => ('排序'),
			'in_list' => true,
            'default_in_list' => true,
			'orderby' => true,
        ),
        'last_modify' => array(
            'type' => 'last_modify',
            'label' => ('更新时间') ,
            'filtertype' => 'yes',
            'in_list' => true,
            'orderby' => true,
        ),
    ),
    'comment' => ('页面广告'),
);
