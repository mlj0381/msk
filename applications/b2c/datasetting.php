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
             'name' => '大促会',
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
        array(
            'name' => '店铺1',
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
        array(
            'name' => '店铺2',
            'url' => array(
                'app' => 'store',
                'ctl' => 'site_store',
                'act' => 'index',
                'args' => array(
                    '2',//storeid
                ),
            ),
            'image_id' =>'',
        ),
        array(
            'name' => '店铺3',
            'url' => array(
                'app' => 'store',
                'ctl' => 'site_store',
                'act' => 'index',
                'args' => array(
                    '3',//storeid
                ),
            ),
            'image_id' =>'',
        ),
        array(
            'name' => '店铺4',
            'url' => array(
                'app' => 'store',
                'ctl' => 'site_store',
                'act' => 'index',
                'args' => array(
                    '4',//storeid
                ),
            ),
            'image_id' =>'',
        ),
        array(
            'name' => '店铺5',
            'url' => array(
                'app' => 'store',
                'ctl' => 'site_store',
                'act' => 'index',
                'args' => array(
                    '5',//storeid
                ),
            ),
            'image_id' =>'',
        ),
        array(
            'name' => '店铺6',
            'url' => array(
                'app' => 'store',
                'ctl' => 'site_store',
                'act' => 'index',
                'args' => array(
                    '6',//storeid
                ),
            ),
            'image_id' =>'',
        ),
        array(
            'name' => '店铺7',
            'url' => array(
                'app' => 'store',
                'ctl' => 'site_store',
                'act' => 'index',
                'args' => array(
                    '7',//storeid
                ),
            ),
            'image_id' =>'',
        ),
        array(
            'name' => '店铺8',
            'url' => array(
                'app' => 'store',
                'ctl' => 'site_store',
                'act' => 'index',
                'args' => array(
                    '8',//storeid
                ),
            ),
            'image_id' =>'',
        ),
    ),
    'filter' => array(
        'brand' => array(
            'type' => 'brand',
            'item' => array(
                array(
                    'name' => '神龙客',
                    'id' => '1',
                ),
                array(
                    'name' => '多鲜乐',
                    'id' => '2',
                ),
                array(
                    'name' => '美侍客',
                    'id' => '3',
                ),
            ),
        ),
        'price' => array(
            'type' => 'price',
            'item' => array(
                array(
                    'name' => '0-40',
                    'id' => '1',
                ),
                array(
                    'name' => '41-100',
                    'id' => '2',
                ),
                array(
                    'name' => '100-200',
                    'id' => '3',
                ),
                array(
                    'name' => '200-400',
                    'id' => '4',
                ),
                array(
                    'name' => '400以上',
                    'id' => '5',
                ),
            ),
        ),
        'origin' => array(
            'type' => 'origin',
            'item' => array(
                array(
                    'name' => '上海',
                    'id' => '1',
                ),
                array(
                    'name' => '河南',
                    'id' => '2',
                ),
                array(
                    'name' => '广东',
                    'id' => '3',
                ),
                array(
                    'name' => '天津',
                    'id' => '4',
                ),
                array(
                    'name' => '湖北',
                    'id' => '5',
                ),
            ),
        ),
        'weight' => array(
            'type' => 'weight',
            'item' => array(
                array(
                    'name' => '0-5KG',
                    'id' => '1',
                ),
                array(
                    'name' => '5-10KG',
                    'id' => '2',
                ),
                array(
                    'name' => '10-20KG',
                    'id' => '3',
                ),
                array(
                    'name' => '20KG以上',
                    'id' => '4',
                ),
            ),
        ),
    ),
    'cat' => array(
        //一级分类
        array(
            'name' => '鸡肉类',
            'id' => '1',
            'order' => '0',
            'has_children' => true,
            'parent_id' => '0',
        ),
        array(
            'name' => '鸭肉类',
            'id' => '2',
            'order' => '0',
            'has_children' => true,
            'parent_id' => '0',
        ),
        array(
            'name' => '猪肉类',
            'id' => '3',
            'order' => '0',
            'has_children' => true,
            'parent_id' => '0',
        ),
        array(
            'name' => '牛羊肉类',
            'id' => '4',
            'order' => '0',
            'has_children' => true,
            'parent_id' => '0',
        ),
        //end 一级分类
        //二级分类
        array(
            'name' => '原料/白条',
            'id' => '5',
            'order' => '0',
            'has_children' => true,
            'parent_id' => '1',
        ),
        array(
            'name' => '原料/分割品',
            'id' => '6',
            'order' => '0',
            'has_children' => true,
            'parent_id' => '1',
        ),
        //end二级分类
        //三级分类
        array(
            'name' => '鸡肉',
            'id' => '7',
            'order' => '0',
            'has_children' => true,
            'parent_id' => '5',
        ),
        array(
            'name' => '鸡肉',
            'id' => '8',
            'order' => '0',
            'has_children' => true,
            'parent_id' => '6',
        ),
        //end 三级分类
    ),

 );
