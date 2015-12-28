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



$db['ad'] = array(
    'columns' =>
    array(
        'id' => array(
            'type' => 'number',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'label' => ('id'),
            'comment' => ('id'),
        ),
        'ad_name' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'default' => '',
            'label' => ('广告名称'),
            'comment' => ('广告名称'),
        ),
        'page_id' => array(
            'type' => 'number',
            'default' => 0,
            'label' => ('所属页面'),
            'comment' => ('所属页面'),
        ),

        'position_id' => array(
            'type' => 'number',
            'required' => true,
            'label' => ('位置ID'),
            'comment' => ('位置ID'),
        ),
        'ad_type' => array(
            'type' => 'number',
            'required' => true,
            'label' => ('广告类型'),
            'comment' => ('广告类型'),
        ),
        'status' => array(
            'type' => 'bool',
            'label' => ('是否启用'),
            'comment' => ('是否启用'),
            'default' => 'true',
            
            'in_list' => true,
            'default_in_list' => true,
        ),
        'ad_content' => array(
            'type' => 'serialize',
            'label' => ('广告内容'),
            'comment' => ('广告内容'),
            'in_list' => true,
            'default_in_list' => true,
        ),
        'ad_setting' => array(
            'type' => 'serialize',
            'label' => ('广告设置'),
            'comment' => ('广告设置'),
            'in_list' => true,
            'default_in_list' => true,
        ),
        'ordernum' => array(
            'type' => 'number',
            'label' => ('排序'),
            'comment' => ('排序'),
            'default' => '0',
            'required' => true,
            'in_list' => true,
            'default_in_list' => true,
        ),
        'createtime' => array(
            'type' => 'time',
            'label' => ('添加时间'),
            'comment' => ('添加时间'),
            'required' => true,
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
);

