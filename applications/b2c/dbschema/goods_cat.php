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


$db['goods_cat'] = array(
  'columns' => array(
    'cat_id' => array(
      'type' => 'number',
      'required' => true,
      'pkey' => true,
      'extra' => 'auto_increment',
      'label' => ('分类ID'),
    ),
    'parent_id' => array(
      'type' => 'number',
      'label' => ('父类ID'),
      'required' => true,
      'default' => 0,
    ),
    'cat_path' => array(
      'type' => 'varchar(100)',
      'default' => ',',
      'label' => '路径',
    ),
    'has_children' => array(
        'type' => 'bool',
        'default' => 'false',
        'required' => true,
        'label' => '是否存在子类' ,
    ) ,
    'cat_name' => array(
      'type' => 'varchar(100)',
      'is_title'=>true,
      'required' => true,
      'default' => '',
      'label' => ('分类名称'),
    ),
    'gallery_setting' => array(
        'type' => 'serialize',
        'label' => ('分类设置'),
        'deny_export' => true,
    ),
    'p_order' => array(
      'type' => 'number',
      'label' => ('同级排序'),
      'default' => 0,
    ),
    'addon' => array(
      'type' => 'longtext',
      'comment' => ('附加项'),
    ),
    'last_modify' => array(
      'type' => 'last_modify',
      'label' => ('更新时间'),
    ),
    'disabled' => array(
      'type' => 'bool',
      'default' => 'false',
      'required' => true,
      'label' => ('是否屏蔽（true：是；false：否）'),
    ),
  ),
  'index' => array(
    'ind_cat_path' => array(
      'columns' => array(
        0 => 'cat_path',
      ),
    ),
    'ind_disabled' => array(
      'columns' => array(
        0 => 'disabled',
      ),
    ),
    'ind_last_modify' => array(
      'columns' => array(
        0 => 'last_modify',
      ),
    ),
  ),
  'comment' => ('商品分类表'),
);
