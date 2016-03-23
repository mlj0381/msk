<?php
/**
 * 编辑买手冻品管家的买家信息---------------IBS2101106
 */
$remote['freeze_editorbuyer'] = array(
    'url' => '/bs/slInfo/slExclusive/newOrUpdate',

    'params' => array(
        '' => array(
            'name' => '1:专属买家、2：抢单买家',
            'column' => 'buyerFlag',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '买手店编码',
            'column' => 'slCode',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '管家账号',
            'column' => 'houseAccount',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '买家编码',
            'column' => 'buyerid',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '开始日时',
            'column' => 'startTime',
            'type' => 'datetime',
            'parent' => '',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '申请日时',
            'column' => 'applyTime',
            'type' => 'datetime',
            'parent' => '',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '申请状态',
            'column' => 'applyStatus',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '认证方式',
            'column' => 'applySide',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => true
        ),
        '' => array(
            'name' => '  版本号',
            'column' => 'ver',
            'type' => 'Integer',
            'parent' => '',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '  删除标志',
            'column' => 'delFlg',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => false
        ),
        '' => array(
            'name' => '创建者ID/更新者ID',
            'column' => 'loginId',
            'type' => 'String',
            'parent' => '',
            'default' => '',
            'require' => false
        ),
    ),

    'result' => array(
        // 'buyerId' => // os id
    ),
);