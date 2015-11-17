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

/**
 *  外来数据配置
 */
 $setting = array(
     'city' => array(
         array(
             'name' => '北京',
             'default' => '1',//默认城市
             'id' => '1',
         ),
         array(
             'name' => '上海',
             'id' => '2',
         )
     ),
     'webnav' => array(
         array(
             'name' => '新品惠',
             'url' => '',
         ),
         array(
             'name' => '新品惠',
             'url' => '',
         )
     ),
     'slider' => array(
         array(
             'url' => array(
                  'app' => 'site',
                  'ctl' => 'index',
                  'act' => 'index',
               ),
             'image_id' => 'fafaf366eaefd8a22e69851ebc30a02dc8b3cd52',
         ),
         array(
             'url' => array(
                  'app' => 'site',
                  'ctl' => 'index',
                  'act' => 'index',
               ),
             'image_id' => '4f7b766e1cc62bd67b2adf8edce90df791f76c46',
         ),
         array(
             'url' => array(
                  'app' => 'site',
                  'ctl' => 'index',
                  'act' => 'index',
               ),
             'image_id' => '5a102e5e42ccda868671320889fe1873a231b187',
         ),
     ),
    //  'nav' => array(
    //      array(
    //          'name' => '所有产品分类',
    //          'url' => array(
    //             'app' => 'site',
    //             'ctl' => 'index',
    //             'act' => 'index',
    //          ),
    //      ),
    //      array(
    //          'name' => '首页',
    //          'url' => array(
    //             'app' => 'b2c',
    //             'ctl' => 'site_list',
    //             'act' => 'index',
    //          ),
    //      ),
    //      array(
    //          'name' => '新品惠',
    //          'url' => array(
    //             'app' => 'site',
    //             'ctl' => 'site_promotion',
    //             'act' => 'index',
    //          ),
    //      ),
    //      array(
    //          'name' => '聚划算',
    //          'url' => array(
    //             'app' => 'site',
    //             'ctl' => 'site_promotion',
    //             'act' => 'index',
    //          ),
    //      ),
    //  ),
    'floor' => array(
        array(
            'type' => 'china_food',
            'name' => '中餐食材',
            'item' => array(
                array(
                    'default' => '1',
                    'url' => array(
                        'app' => 'b2c',
                        'ctl' => 'site_product',
                        'act' => 'index',
                        'args' => array(
                            '25', '1',//product_id  seller_id
                        ),
                    ),
                    'image_id' => '69443bbc9329413cddc5080ef5d5bb59',
                    'price' => '99.00',
                    'name' => '神龙客精品五花肉',
                ),
                array(
                    'url' => array(
                        'app' => 'b2c',
                        'ctl' => 'site_product',
                        'act' => 'index',
                        'args' => array(
                            '45', '1',//product_id  seller_id
                        ),
                    ),
                    'image_id' => '69443bbc9329413cddc5080ef5d5bb59',
                    'price' => '99.00',
                    'name' => '神龙客精品五花肉',
                ),
                array(
                    'url' => array(
                        'app' => 'b2c',
                        'ctl' => 'site_product',
                        'act' => 'index',
                        'args' => array(
                            '37', '1',//product_id  seller_id
                        ),
                    ),
                    'image_id' => 'ccf9923ad28aa1dd608e9d4df3bcd045',
                    'price' => '419.00',
                    'name' => '神龙客精品五花肉',
                ),
                array(
                    'url' => array(
                        'app' => 'b2c',
                        'ctl' => 'site_product',
                        'act' => 'index',
                        'args' => array(
                            '37', '1',//product_id  seller_id
                        ),
                    ),
                    'image_id' => '9ca95ad385eaf776ae5d9c3e8c10ee12',
                    'price' => '99.00',
                    'name' => '神龙客精品五花肉',
                ),
                array(
                    'url' => array(
                        'app' => 'b2c',
                        'ctl' => 'site_product',
                        'act' => 'index',
                        'args' => array(
                            '25', '1',//product_id  seller_id
                        ),
                    ),
                    'image_id' => 'd63a67731c62829909b55a730f24a55b',
                    'price' => '680.00',
                    'name' => '神龙客精品五花肉',
                ),
                array(
                    'url' => array(
                        'app' => 'b2c',
                        'ctl' => 'site_product',
                        'act' => 'index',
                        'args' => array(
                            '1', '1',//product_id  seller_id
                        ),
                    ),
                    'image_id' => '9150f7e6f2bf2a5876779f254403cd52',
                    'price' => '4988.00',
                    'name' => '神龙客精品五花肉',
                ),
                array(
                    'url' => array(
                        'app' => 'b2c',
                        'ctl' => 'site_product',
                        'act' => 'index',
                        'args' => array(
                            '46', '1',//product_id  seller_id
                        ),
                    ),
                    'image_id' => '8d2a0be90a514ecb51ca01b843142b82',
                    'price' => '2999.00',
                    'name' => '神龙客精品五花肉',
                ),
                array(
                    'url' => array(
                        'app' => 'b2c',
                        'ctl' => 'site_product',
                        'act' => 'index',
                        'args' => array(
                            '125', '1',//product_id  seller_id
                        ),
                    ),
                    'image_id' => '8a7f5ca8819a286a2d314a253e3cc8ab',
                    'price' => '149.00',
                    'name' => '神龙客精品五花肉',
                ),
                array(
                    'url' => array(
                        'app' => 'b2c',
                        'ctl' => 'site_product',
                        'act' => 'index',
                        'args' => array(
                            '126', '1',//product_id  seller_id
                        ),
                    ),
                    'image_id' => '8cb3b3b84e1eba26e7e5748514590ed5',
                    'price' => '239.00',
                    'name' => 'Gap多选色全棉纯色舒适休闲短裤',
                ),
            ),
        ),
    ),
    'store' => array(
        'name' => '沙县小吃',
        'url' => array(
            'app' => 'store',
            'ctl' => 'site_store',
            'act' => 'index',
            'args' => array(
                '1',//storeid
            ),
        ),
        'image_id' =>'',
    ),
 );
