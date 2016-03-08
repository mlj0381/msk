<?php
$db['map']=array (
    'columns' =>
    array (
        'id' =>
        array (
            'type' => 'int unsigned',
            'required' => true,
            'pkey' => true,
            'extra' => 'auto_increment',
            'comment' => '地图id',
        ),
        'title' =>
        array (
            'type' => 'varchar(50)',
            'required' => true,
            'label' => '标题',
            'comment' => '标题',
        ),
        'url' =>
        array (
            'type' => 'varchar(100)',
            'default' => '',
            'label' => '地址',
            'comment' => '地址',
        ),
        'ordernum' =>
        array (
            'type' => 'int unsigned',
            'default' => 0,
            'label' => '排序',
            'comment' => '排序',
        ),
        'pid' =>
        array (
            'type' => 'int unsigned',
            'required' => true,
            'default' => 0,
            'label' => '父id',
            'comment' => '父id',
        ),
        'createtime' =>
        array (
            'type' => 'time',
            'comment' => '更新时间',
        ),
    ),
    'comment' => '站点地图表',
);


