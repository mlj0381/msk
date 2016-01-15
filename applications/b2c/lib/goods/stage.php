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


class b2c_goods_stage
{
    private $member_id = false;
    public function __construct($app)
    {
        $this->app = $app;
        $this->mdl_products = app::get('b2c')->model('products');
        $this->mdl_goods = app::get('b2c')->model('goods');
    }
    public function set_member($member_id)
    {
        $user_object = vmc::singleton('b2c_user_object');
        $this->member_info = $user_object->get_member_info($member_id);
        if ($this->member_info['member_id']) {
            $this->member_id = $this->member_info['member_id'];
        }
    }

    /*丰富商品基础信息*/
    public function gallery(&$goods_list)
    {
        $goods_list = utils::array_change_key($goods_list, 'goods_id');
        $gids = array_keys($goods_list);
        $mdl_products = app::get('b2c')->model('products');
        $products = $this->mdl_products->getList('*', array(
            'goods_id' => $gids,
            'marketable' => 'true',
        ), 0, -1, 'goods_id,is_default');
        $products = utils::array_change_key($products, 'goods_id', 1);
        //满意度平均值
        $goods_avg_mark = app::get('b2c')->model('goods_mark')->avg_mark($gids);

        if ($this->member_id) {
            $lv_discount = $this->member_info['lv_discount'];
            if (isset($lv_discount) ||  $lv_discount > 1 || $lv_discount < 0) {
                $lv_discount = 1;
            }
        }
        foreach ($products as $k => $v) {
            if (is_array($v)) {
                $goods_list[$k]['product'] = $v[0];
            } else {
                $goods_list[$k]['product'] = $v;
            }
            //商品评分
            $goods_list[$k]['mark_star'] = isset($goods_avg_mark[$k]) ? $goods_avg_mark[$k]['num'] : 5;

            // if ($goods_list[$k]['product'] && !empty($goods_list[$k]['product']['image_id'])) {
            //     $goods_list[$k]['image_default_id'] = $goods_list[$k]['product']['image_id'];
            // }else{
            //     $goods_list[$k]['product']['image_id'] = $goods_list[$k]['image_default_id'];
            // }

            if ($lv_discount) {
                //会员价
                $goods_list[$k]['product']['buy_price'] = $goods_list[$k]['product']['member_lv_price'] = $lv_discount * $goods_list[$k]['product']['price'];
            } else {
                $goods_list[$k]['product']['buy_price'] = $goods_list[$k]['product']['price'];
            }
            //促销
            $goods_list[$k]['product']['promotion'] = $this->promotion($k,$goods_list[$k]['product']['buy_price']);
            //列表页单品多样展示
            if (isset($goods_list[$k]['goods_setting']['list_extension']) && is_array($v)) {
                array_shift($v);
                $tmp_extension = $v;
                foreach ($tmp_extension as $extension) {
                    if (in_array($extension['product_id'], $goods_list[$k]['goods_setting']['list_extension']) && $goods_list[$k]['product']['product_id'] != $extension['product_id']) {
                        if ($lv_discount) {
                            //会员价
                                $extension['buy_price'] = $extension['member_lv_price'] = $lv_discount * $extension['price'];
                        } else {
                            $extension['buy_price'] = $extension['price'];
                        }
                        $extension['promotions'] = $this->promotion($k,$extension['buy_price']);
                        $goods_list[$k]['product']['list_extension'][] = $extension;
                    }
                }
            }
        }
        //格式化商品列表数据
        foreach ($goods_list as $key => &$value) {
            $this->_format($value);
        }
    }
    /**
     * 根据分类获得筛选项
     */
    public function screening_data_by_cat($cat_id){
        //分类
        $mdl_gcat = app::get('b2c')->model('goods_cat');
        if ($cat_list = $mdl_gcat->get_tree($cat_id?$cat_id:0)) {
            $_return['cat_id']['title'] = '一级分类';
            foreach ($cat_list as $value) {
                $_return['cat_id']['options'][$value['cat_id']] = $value['cat_name'];
            }
        }
        // $filter = array();
        //
        // if ($cat_id) {
        //     $filter['cat_id'] = $mdl_gcat->get_all_children_id($cat_id);
        // }
        //
        // $gprops_arr = app::get('b2c')->model('goods')->lw_getList('brand_id,type_id,cat_id', $filter);
        // foreach ($gprops_arr as $arr) {
        //     $type_id_arr[] = $arr['type_id'];
        //     $brand_id_arr[] = $arr['brand_id'];
        // }
        // //品牌
        // if ($brands = app::get('b2c')->model('brand')->getList('brand_id,brand_name', array(
        //     'brand_id' => $brand_id_arr,
        //     'disabled' => 'false',
        // ))) {
        //     $_return['brand_id']['title'] = '品牌';
        //     foreach ($brands as $key => $value) {
        //         $_return['brand_id']['options'][$value['brand_id']] = $value['brand_name'];
        //     }
        // }
        // //扩展属性
        // if ($type_id_arr) {
        //     foreach ($type_id_arr as $type_id) {
        //         $type_info = app::get('b2c')->model('goods_type')->dump2(array(
        //             'type_id' => $type_id,
        //         ));
        //         $props = $type_info['props'];
        //         foreach ($props as $key => $prop) {
        //             $_return['p_'.$key]['title'] = $prop['name'];
        //             $_return['p_'.$key]['options'] = $prop['options'];
        //         }
        //     }
        // }

        return $_return;
    }
    /**
     * 根据品牌获得筛选项
     */
    public function screening_data_by_brand($brand_id){
        $filter = array();
        if ($brand_id) {
            $filter['brand_id'] = $brand_id;
        }
        $gprops_arr = app::get('b2c')->model('goods')->lw_getList('brand_id,type_id', $filter);
        $type_id_arr = array_keys(utils::array_change_key($gprops_arr, 'type_id'));
        //扩展属性
        if ($type_id_arr) {
            foreach ($type_id_arr as $type_id) {
                $type_info = app::get('b2c')->model('goods_type')->dump2(array(
                    'type_id' => $type_id,
                ));
                $props = $type_info['props'];
                foreach ($props as $key => $prop) {
                    $_return['p_'.$key]['title'] = $prop['name'];
                    $_return['p_'.$key]['options'] = $prop['options'];
                }
            }
        }

        return $_return;
    }
    /**
     * 根据关键词获得筛选项
     */
    public function screening_data_by_keywords($keywords){

    }

    /**
     * 获得商品及默认货品详情.
     *
     * @param $pkey string|int g+商品id 或  货品id
     * @param &$msg string 错误反馈
     */
    public function detail($pkey, &$msg)
    {
        if (!$pkey) {
            $msg = '缺少参数';

            return false;
        }

        if (substr($pkey, 0, 1) == 'g') {
            //传入了商品ID
            $data_detail = $this->mdl_goods->dump(substr($pkey, 1), '*', 'default');
            foreach ($data_detail['product'] as $key => $product) {
                if ($product['is_default'] == 'true') {
                    $current_product = $product;
                    break;
                }
            }
            if (!isset($current_product)) {
                $current_product = current($data_detail['product']);
            }
        } else {

            //任务传入了货品ID
            $product = $this->mdl_products->dump($pkey);

            $data_detail = $this->mdl_goods->dump($product['goods_id'], '*', 'default');
            $current_product = $data_detail['product'][$pkey];
        }

        if (!$data_detail || !$current_product) {
            $msg = 'NOT FOUND';

            return false;
        }

        //获得扩展属性
        $mdl_gtype = $this->app->model('goods_type');
        $gtype_obj = $mdl_gtype->dump($data_detail['type']['type_id']);
        foreach ($gtype_obj['props'] as $key => $value) {
            if (!$data_detail['props']['p_'.$key]['value']) {
                continue;
            }
            $prop = array(
                'label' => $value['name'],
            );
            if ($value['type'] == 'select') {
                $prop['value'] = $value['options'][$data_detail['props']['p_'.$key]['value']];
            } else {
                $prop['value'] = $data_detail['props']['p_'.$key]['value'];
            }
            $props[] = $prop;
        }
        $data_detail['props'] = $props;

        $current_product_sprc_desc = explode(':::', $current_product['spec_desc']);
        $spec_options = false;
        if ($data_detail['spec_desc'] && count($data_detail['spec_desc']) > 0) {
            var_dump($data_detail['spec_desc']);
            foreach ($data_detail['spec_desc']['v'] as $key => $value) {
                unset($data_detail['spec_desc']['v'][$key]);
                foreach (explode(',', $value) as $value) {
                    $data_detail['spec_desc']['v'][$key][$value] = array(
                        'label' => $value,
                    );
                }
            }
        }
        
        foreach ($data_detail['product'] as $key => $product) {
            /*规格选项计算 BEGIN*/
            $spec_desc_arr = explode(':::', $product['spec_desc']);
            $diff_spec = array_diff_assoc($spec_desc_arr, $current_product_sprc_desc);
            if (count($diff_spec) == 1) {
                $data_detail['spec_desc']['v'][key($diff_spec) ][current($diff_spec) ]['product_id'] = $product['product_id'];
                $data_detail['spec_desc']['v'][key($diff_spec) ][current($diff_spec) ]['sku_bn'] = $product['bn'];
                $data_detail['spec_desc']['v'][key($diff_spec) ][current($diff_spec) ]['marketable'] = $product['marketable'];
                if ($data_detail['goods_setting'] && $data_detail['goods_setting']['spec_info_vimage'] && $data_detail['goods_setting']['spec_info_vimage'] == $data_detail['spec_desc']['t'][key($diff_spec)]) {
                    $data_detail['spec_desc']['v'][key($diff_spec) ][current($diff_spec) ]['p_image_id'] = $product['image_id'];
                }
            }
            if (count($diff_spec) == 0) {
                foreach ($current_product_sprc_desc as $key => $value) {
                    $data_detail['spec_desc']['v'][$key][$value]['product_id'] = $product['product_id'];
                    $data_detail['spec_desc']['v'][$key][$value]['sku_bn'] = $product['bn'];
                    $data_detail['spec_desc']['v'][$key][$value]['marketable'] = $product['marketable'];
                    $data_detail['spec_desc']['v'][$key][$value]['current'] = 'true';
                    if ($data_detail['goods_setting'] && $data_detail['goods_setting']['spec_info_vimage'] && $data_detail['goods_setting']['spec_info_vimage'] == $data_detail['spec_desc']['t'][$key]) {
                        $data_detail['spec_desc']['v'][$key][$value]['p_image_id'] = $product['image_id'];
                    }
                }
            }
            /*规格选项计算 END*/
        }
        //var_dump($data_detail['spec_desc']['t'], $data_detail['spec_desc']['v']);
        //只给当前货品数据
        $data_detail['product'] = $current_product;

        //默认图
        $product_image_id = $data_detail['product']['image_id'];
        if ($data_detail['product'] && $product_image_id) {
            foreach ($data_detail['images'] as $k => $i) {
                if ($i['image_id'] == $product_image_id) {
                    unset($data_detail['images'][$k]);
                }
            }
            array_unshift($data_detail['images'], array('image_id' => $product_image_id));
            $data_detail['image_default_id'] = $product_image_id;
        } else {
            $data_detail['images'] = array_values($data_detail['images']);
        }

        //会员价计算
        if ($this->member_id) {
            $lv_discount = $this->member_info['lv_discount'];
            if (isset($lv_discount) ||  $lv_discount > 1 || $lv_discount < 0) {
                $lv_discount = 1;
            }
            $data_detail['product']['buy_price'] = $data_detail['product']['member_lv_price'] = $lv_discount * $data_detail['product']['price'];
        } else {
            $data_detail['product']['buy_price'] = $data_detail['product']['price'];
        }

        //商品满意度星级
        $goods_avg_mark = app::get('b2c')->model('goods_mark')->avg_mark($data_detail['goods_id']);
        $data_detail['mark_star'] = isset($goods_avg_mark[$data_detail['goods_id']]) ? $goods_avg_mark[$data_detail['goods_id']]['num'] : 5;

        return $data_detail;
    }

    /**
     * 获得某商品促销当前可用促销信息.
     *
     * @param $goods_id 商品ID
     * @param $price 商品当前成交价（促销优惠计算前，即 销售价*会员折扣)
     */
    public function promotion($goods_id, $price = false)
    {
        $current_member_lv_id = $_COOKIE['MEMBER_LEVEL_ID'];
        if(!$current_member_lv_id){
            $current_member_lv_id = '-1';
        }
        if($price){
            $sale_arr = array(
                'item' => array('product' => array('buy_price' => $price)),
                'quantity' => 1,
            );
        }
        $mdl_goods_promotion_ref = app::get('b2c')->model('goods_promotion_ref');
        $now = time();
        $plist = $mdl_goods_promotion_ref->getList('*', array(
            'goods_id' => $goods_id,
            'status' => 'true',
            'from_time|lthan' => $now,
            'to_time|bthan' => $now,
        ), 0, -1, 'sort_order ASC');
        $plist = utils::array_change_key($plist, 'rule_id');

        foreach ($plist as $key => $value) {
            if(!in_array($current_member_lv_id,explode(',',$value['member_lv_ids']))){
                $plist[$key]['disabled'] = 'true';
                continue;
            }
            if($value['stop_rules_processing'] == 'true'){
                break;
            }
            if (!is_array($value['action_solution'])) {
                $value['action_solution'] = unserialize($value['action_solution']);
            }
            $solution_class = key($value['action_solution']);
            $solution_ins = new $solution_class;
            if(isset($sale_arr)){
                $arr_info = array();
                $solution_ins->apply($sale_arr, current($value['action_solution']),$arr_info);
                $plist[$key]['save'] = vmc::singleton('ectools_math')->formatNumber($solution_ins->getSave(), app::get('ectools')->getConf('site_decimal_digit_count'), app::get('ectools')->getConf('site_decimal_digit_count'));
            }
            $plist[$key]['tag'] = $solution_ins->desc_tag;
            $plist[$key]['now'] = $now;
            unset($plist[$key]['action_solution']);
            unset($plist[$key]['free_shipping']);
            unset($plist[$key]['sort_order']);
        }
        $return = array('plist' => array(),'sale_price' => $sale_arr['item']['product']['buy_price']);
        if($return['sale_price'] && ($return['sale_price']>=$price || $return['sale_price']<0)){
            $return['sale_price'] = null;
        }
        foreach ($plist as $key => $value) {
            if($value['disabled'] == 'true'){
            }else{
                $return['plist'][]=$value;
            }
        }
        return $return;
    }

    /**
     * 格式化列表.
     */
    private function _format(&$item, $router_app = 'site')
    {
        foreach ($item as $key => &$value) {
            switch ($key) {
                case 'product':
                    $this->_format($value);
                    break;
                case 'list_extension':
                foreach ($value as &$item) {
                    $this->_format($item);
                }
                    break;
                case 'product_id':
                $item['item_url'] = app::get($router_app)->router()->gen_url(array('full' => 'true', 'app' => 'b2c', 'ctl' => 'site_product', 'args' => array($item[$key])));
                    break;
                case 'image_default_id':
                case 'image_id':
                    $item['image'] = base_storager::image_path($value, 'm');
                    break;
                case 'cat_id':

                    $item['category'] = app::get('b2c')->model('goods_cat')->getRow('cat_id as id,cat_name', array('cat_id' => $value));
                    break;
                case 'brand_id':
                    $item['brand'] = app::get('b2c')->model('brand')->getRow('brand_id as id,brand_name,brand_initial,brand_logo,brand_country', array('brand_id' => $value));
                    if($item['brand']){
                        $item['brand']['brand_logo_image'] = base_storager::image_path($item['brand']['brand_logo']);
                        $item['brand']['brand_country_flag'] = vmc::get_app_statics_host_url().'/misc/flags/'.$item['brand']['brand_country'].'.png';
                    }
                    break;
                    case 'price':
                    case 'mktprice':
                    case 'member_lv_price':
                    case 'buy_price':
                    $item[$key] = vmc::singleton('ectools_math')->formatNumber($value, app::get('ectools')->getConf('site_decimal_digit_count'), app::get('ectools')->getConf('site_decimal_digit_count'));
                    break;
            }
        }
        $this->_hidden($item);
    }
    /**
     * 隐藏列表数据.
     */
    private function _hidden(&$item)
    {
        $hidden = array(
            'brand_id',
            'cat_id',
            'goods_setting',
            'last_modify',
            'type_id',
            'disabled',
            'downtime',
            'is_default',
            'marketable',
            'spec_desc',
            'uptime',
        );
        foreach ($item as $key => &$value) {
            if (is_string($key)&& in_array($key, $hidden)) {
                unset($item[$key]);
            }
            if (is_array($value)) {
                $this->_hidden($value);
            }
        }
    }
}
