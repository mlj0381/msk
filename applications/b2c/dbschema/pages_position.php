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



$db['pages_position'] = array(
    'columns' =>
    array(
        'position_id' => array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => ('id'),
            'comment' => ('id'),
			'in_list' => true,
            'default_in_list' => true,
        ),
        'name' => array(
            'type' => 'varchar(100)',
            'label' => ('位置名称'),
            'comment' => ('位置名称'),
            'required' => true,
            'in_list' => true,
            'default_in_list' => true,
        ),		
		'pages_id' => array(
            'type' => 'table:pages',
            'default' => 0,
            'required' => true,
            'label' => ('所属页面'),
			'filtertype' => 'yes',
			'in_list' => true,
            'default_in_list' => true,
			'orderby' => true,
        ),
		'multi' => array(
           'type' => array(
                '0' => ('单个'),
                '1' => ('多个'),
            ),
            'label' => ('内容'),
            'comment' => ('多内容'),
            'required' => true,
            'default' => '0',
            'in_list' => false,
            'default_in_list' => false,
        ),
		'count' => array(   
			'type' => 'number',
            'label' => ('数量'),
            'comment' => ('数量'),         
            'default' => 0,
            'in_list' => true,
			'default_in_list' => true,
        ),
        'width' => array(   
            'type' => 'number',
            'label' => ('宽度'),
            'comment' => ('宽度'),         
            'default' => 100,
            'in_list' => true,
            'default_in_list' => true,
        ),
        'height' => array(   
            'type' => 'number',
            'label' => ('高度'),
            'comment' => ('宽度'),         
            'default' => 100,
            'in_list' => true,
            'default_in_list' => true,
        ),
		'plat' => array(
           'type' => array(
                '0' => ('商城'),
                '1' => ('店铺'),
            ),
            'label' => ('平台'),
            'comment' => ('平台'),
            'required' => true,
            'default' => '0',
            'in_list' => true,
            'default_in_list' => true,
			'filtertype' => 'yes',
        ),
		'type' => array(
           'type' => array(
                '0' => ('普通'),
                '1' => ('幻灯'),
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
		'ordernum' => array(
            'type' => 'number',
            'required' => true,
            'default' => 0,
            'label' => '排序',
			'in_list' => false,
            'default_in_list' => false,
			'orderby' => true,
        ),
        'last_modify' => array(
            'type' => 'last_modify',
            'label' => ('更新时间') ,
            'in_list' => false,
            'orderby' => true,
        ),
    ),
    'comment' => ('页面广告位'),
);
