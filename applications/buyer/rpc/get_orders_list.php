<?php
/**
 * 最新的买手店退货订单---------------ISO151416
 */
$remote['buyer_get_orders_list'] = array(
    'url' => '/so/sdo/detail',
	'version'=>'v2',
    'request' => array(
        'param' => array(
            'name' => '参数',
            'column' => 'param',
            'type' => 'object',
            'default' => Array(),
        ),
    ),

    'param' => array(
        'buyersId' => array(
            'name' => '买手店ID',
            'column' => 'buyersId',
            'type' => 'String',
            'require' => true,
        ),
        'buyersCode' => array(
            'name' => '买手店CODE',
            'column' => 'buyersCode',
            'type' => 'String',
            'require' => true,
        ),
    ),

);