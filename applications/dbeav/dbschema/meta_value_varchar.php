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


 
$db['meta_value_varchar']=array (
  'columns' => 
  array (
    'mr_id' => 
    array (
      'type' => 'number',
      'required' => false,
      'pkey' => true,
      'comment' => 'meta注册主表id',
    ),
    'pk' => 
    array (
      'type' => 'number',
      'required' => true, 
      'pkey' => true,
      'comment' => '对应数据行的主键值', 
    ),
    'value' => 
    array (
      'type' => 'varchar(255) NOT NULL default \'\'',
      'required' => true,
      'comment' => 'meta值',
    ),
  ),
  'comment' => 'meta具体类型表(varchar类型)',
  'index' => 
  array (
    'ind_value' => 
    array (
      'columns' => 
      array (
        0 => 'value',
      ),
    ),
  ),
  'engine' => 'innodb',
  'version' => '$Rev: 40912 $',
);
