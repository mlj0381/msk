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

/*
 * 地区表--专门提供给buyer使用的编码
 */
$db['area'] = array(
    'columns' => array(
        'area_id' => array(
            'type' => 'number',
            'required' => true,
        	'comment' => '地区ID',
        ),
    		
        'area_name' => array(
            'type' => 'char(32)',
            'required' => true,
            'default' => '',
            'comment' => '地区名称',
        ),
      ),
    'comment' => '地区表',
);
