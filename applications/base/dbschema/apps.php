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


$db['apps'] = array(
  'columns' => array(
    'app_id' => array(
      'type' => 'varchar(32)',
      'required' => true,
      'default' => '',
      'pkey' => true,
      'label' => '程序ID(目录)',
      'hidden' => 1,
      'in_list' => true,
      'default_in_list' => false,
    ),
    'app_name' => array(
        'type' => 'varchar(50)',
        'label' => '应用程序名称',
        'is_title' => 1,
        'in_list' => true,
        'default_in_list' => 1,
      ),
    'debug_mode' => array(
        'type' => 'bool',
        'default' => 'false',
        'label' => '调试模式',
        'in_list' => true,
        'default_in_list' => false,
    ),
    'app_config' => array(
        'type' => 'text',
    ),
    'status' => array(
            'label' => '状态',
            'default' => 'uninstalled',
            'type' => array(
            'installed' => '已安装, 未启动',
            'resolved' => '已配置',
            'starting' => '正在启动',
            'active' => '运行中',
            'stopping' => '正在关闭',
            'uninstalled' => '尚未安装',
            'installing' => '正在安装',
            'broken' => '已损坏',
            'paused' => '已暂停',
      ),
      'in_list' => true,
      'default_in_list' => true,
    ),
    'webpath' => array(
     'type' => 'varchar(20)',
     'comment' => '远程地址',
     ),
    'description' => array('type' => 'varchar(255)',
    'width' => 300,
    'label' => '说明',
    'in_list' => true,
    'default_in_list' => 1,
    ),
    'local_ver' => array('type' => 'varchar(20)','width' => 100,'label' => '当前版本','in_list' => true,'default_in_list' => 1),
    'remote_ver' => array('type' => 'varchar(20)','width' => 100,'label' => '最新版本','in_list' => true,'default_in_list' => false),
    'author_name' => array('type' => 'varchar(100)','comment' => '作者名'),
    'author_url' => array('type' => 'varchar(100)','comment' => '作者url'),
    'author_email' => array('type' => 'varchar(100)','comment' => '作者邮件'),
    'dbver' => array('type' => 'varchar(32)','comment' => '目前安装版本'),
    'remote_config' => array('type' => 'serialize','comment' => '远程配置信息'),
  ),
  'unbackup' => true,
  'comment' => '系统应用表',
);
