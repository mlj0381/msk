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
$db['settled_info'] = array(
    'columns' => array(
        'company_id' => array(
            'type' => 'number',
            'required' => true,
            'label' => '公司ID',
            'pkey' => true,
            'extra' => 'auto_increment',
            'in_list' => true,
            'comment' => '公司ID',
        ),
        /*代理型、OEM型共有字段 begin*/
        'food_permission' => array(
            'type' => 'char(32)',
            'default' => '',
            'label' => '食品流通许可证',
            'comment' => '食品流通许可证',
        ),
        'food_time' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '食品流通许可证有效期',
            'comment' => '食品流通许可证有效期',
        ),
        'food_image' => array(
            'type' => 'char(32)',
            'default' => '',
            'label' => '食品流通许可证图片',
            'comment' => '食品流通许可证图片',
        ),
        /* 代理型、OEM型共有字段 end*/
        /* 代理型特有字段 begin*/
        'agent_delegate' => array(
            'type' => 'varchar(100)',
            'default' => '',
            'label' => '代理授权单位',
            'comment' => '代理授权单位',
        ),
        'agent_time' => array(
            'type' => 'serialize',
            'default' => '',
            'label' => '代理授权期限',
            'comment' => '代理授权期限',
        ),
        'agent_image' => array(
            'type' => 'char(32)',
            'default' => '',
            'label' => '代理授权图片',
            'comment' => '代理授权图片',
        ),
        /* 代理型特有字段 end*/
        
        /* OME型特有字段 begin*/
        'ome_delegate' => array(
            'type' => 'varchar(100)',
            'default' => '',
            'label' => 'OME授权单位',
            'comment' => 'OME授权单位',
        ),
         'ome_callback' => array(
            'type' => 'varchar(100)',
            'default' => '',
            'label' => 'OME被授权单位',
            'comment' => 'OME被授权单位',
        ),
        'ome_image' => array(
            'type' => 'char(32)',
            'default' => '',
            'label' => 'OME授权图片',
            'comment' => 'OME授权图片',
        ),
        /* OME型特有字段 end*/
        
        /*以下为三种卖家身份共有字段*/
        'seller_id' => array(
            'type' => 'table:sellers',
            'required' => true,
            'label' => '所属商家',
            'comment' => '所属商家'
        ),
        'checkin' => array(
            'type' => array(
                '0' => '审核中',
                '1' => '通过',
                '-1' => '拒绝'
            ),
            'default' => '0',
            'required' => true,
            'label' => '审核状态',
            'comment' => '审核状态'
        ),
       'license' => array(
           'type' => 'table:license',
           'label' => '营业执照',
           'comment' => '营业执照',
       ),
       'settled_plan' => array(
           'type' => 'number',
           'label' => '入驻进度',
           'comment' => '入驻进度',
           'required' => true,
           'default' => 0,
       ),
        'seller_id' => array(
            'type' => 'number',
            'required' => true,
            'default' => 0,
            'label' => '商家',
            'searchtype' => 'has',
            'in_list' => true,
            'default_in_list' => true,
            'order' => '1',
            'comment' => '商家',
        ),
        'no_pass' => array(
            'type' => 'text',
            'default' => '',
            'label' => '未通过原因',
            'comment' => '未通过原因'
        ),
        'createtime' => array(
            'type' => 'time',
            'required' => true,
            'label' => '创建时间',
            'comment' => '创建时间'
        ),
        /*共有字段 end */           
    ),
    'index' => array(
        'ind_seller' => array(
            'columns' => array(
                0 => 'seller_id',
            ),
            'prefix' => 'unique',
        ),
        'ind_createtime' => array(
            'columns' => array(
                0 => 'createtime',
            ),
        ),
        'ind_checkin' => array(
            'columns' => array(
                0 => 'checkin',
            ),
        ),
    ),
    'engine' => 'innodb',
    'comment' => '卖家入驻申请信息表',
);
