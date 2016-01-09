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
$db['attr'] = array(
    'columns' => array(
        'id' => array(
            'type' => 'number',
            'extra' => 'auto_increment',
            'pkey' => true,
            'required' => true,
            'label' => '属性id',
            'comment' => '属性id',
        ),
        
         'name' => array(
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '属性名称',
             'default' => '',
            'comment' => '属性名称',
        ),
        
        'seller_id' => array(
            'type' => 'number',
            'required' => true,
            'label' => '所属商家',
            'comment' => '所属商家',
        ),
        'extra' => array(
            'type' => 'serialize',
            'required' => true,
            'label' => '属性信息',
            'comment' => '属性信息',
        ),
        'attr_type' => array(
            'type' => array(
                'member' => '买家属性',
                'seller' => '卖家属性',
            ),
            'default' => 'member',
            'label' => ('属性类型'),
            'commit' => ('属性类型'),
            'required' => true,
        ),
        'createtime' => array(
            'type' => 'time',
            'required' => true,
            'label' => '创建时间',
            'comment' => '创建时间',
        ),
        
        
        'last_modify' => array(
            'type' => 'last_modify',
            'label' => ('修改时间') ,
            'filtertype' => 'yes',
            'in_list' => true,
            'orderby' => true,
        ) ,
    )
);

