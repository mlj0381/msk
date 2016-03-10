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


 

$db['regions']=array (
    'columns' =>
    array (
        'region_id' =>
        array (
            'type' => 'int unsigned',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            
            'comment' => '区域序号',
        ),
        'local_name' =>
        array (
            'type' => 'varchar(50)',
            'required' => true,
            'default' => '',
            'label'=>'地区名称',
            'width'=>100,
            'default_in_list'=>true,
            'in_list'=>true,
            
        ),
        'package' =>
        array (
            'type' => 'varchar(20)',
            'required' => true,
            'default' => '',
            'label'=>'数据包',
            'width'=>100,
            'default_in_list'=>true,
            'in_list'=>true,
            
            'comment' => '地区包的类别, 中国/外国等. 中国大陆的编号目前为mainland',
        ),
        'p_region_id' =>
        array (
            'type' => 'int unsigned',
            
            'comment' => '上一级地区的序号',
        ),
        'region_path' =>
        array (
            'type' => 'varchar(255)',
            'width'=>300,
            
            'comment' => '序号层级排列结构',
        ),
        'region_grade' =>
        array (
            'type' => 'number',
            
            'comment' => '地区层级',
        ),
        'p_1' =>
        array (
            'type' => 'varchar(50)',
            
            'comment' => '额外参数1',
        ),
        'p_2' =>
        array (
            'type' => 'varchar(50)',
            
            'comment' => '额外参数2',
        ),
        'ordernum' =>
        array (
            'type' => 'number',
            'editable' => true,
            'comment' => '排序',
        ),
        'disabled' =>
        array (
            'type' => 'bool',
            'default' => 'false',
            
        ),
        'type' =>
            array (
                'type' => 'number',
                'label' => '地区类型', // 0 三级联动 1 仓库地址
                'comment' => '地区类型',
                'default' => 0,
            ),
    ),
    'index' =>
  array (
    'ind_p_regions_id' =>
    array (
        'columns' =>
        array (
          0 => 'p_region_id',
          1 => 'region_grade',
          2 => 'local_name',
        ),
        'prefix' => 'unique',
    ),
  ),
    'comment' => '地区表',
);
