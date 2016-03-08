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



$db['pages'] = array(
    'columns' =>
    array(
        'pages_id' => array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => ('id'),
            'comment' => ('id'),
        ),
        'name' => array(
            'type' => 'varchar(100)',
            'label' => ('页面名称'),
            'comment' => ('页面名称'),
            'required' => true,
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
        ),      
        'last_modify' => array(
            'type' => 'last_modify',
            'label' => ('更新时间') ,
            'filtertype' => 'yes',
            'in_list' => true,
            'orderby' => true,
        ) ,
    ),
    'comment' => ('页面广告管理'),
);
