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
 * PC端 购物车控制器类
 * 主要完成购物车相关操作及操作结果的反馈,页面间引导.
 */
class b2c_ctl_site_cart extends b2c_frontpage {

    public $title = '我的购物车';

    public function __construct(&$app) {
        parent::__construct($app);
        $this->_response->set_header('Cache-Control', 'no-store');
        vmc::singleton('base_session')->start();
        $this->blank_url = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_cart',
            'act' => 'blank',
        ));
        $this->cart_stage = vmc::singleton('b2c_cart_stage');
        $this->buyerId = vmc::singleton('buyer_user_object')->get_session();
        if(!$this->buyerId){
            $this->verify_member();
            if ($this->app->member_id = vmc::singleton('b2c_user_object')->get_member_id()) {
                $this->pagedata['member_id'] = $this->app->member_id;
            }
        }
        $this->cart_stage->set_member_id($this->buyerId ?: $this->app->member_id);
    }

    //购物车主页
    public function index() {
        /**
         * 润和接口
         * 查看购买需求订单接口无
         * 删除购买需求订单接口无
         */
        /*
        $cart_api = vmc::singleton('b2c_source_cart');
        $goods_api = vmc::singleton('b2c_source_goods');
        $params = array(
            'member_id' => $this->member['member_id'],
            'label' => '', //购物车大促会，全部商品
            );
        $cart_list = $cart_api->read_cart($params); //购物车中的商品
        */
        $result = $this->cart_stage->result();
        $this->_priceCount($result);
        if ($this->cart_stage->is_empty($result)) {
            $this->splash('error', $this->blank_url);
        }
        if ($this->_request->is_ajax()) {
            //迷你购物车使用
            $this->splash('success', '', $result);
        }
        
        //添加大促会，神龙客商品
        $cart_all = array(
            'beauty' => $result,//美侍客
            'big' => array(),//大促会
            'god' => array(),//神龙客
        );
        foreach($cart_all as $value){
            $cart_all['cart_count'] += (int)$value['goods_count'];
            $cart_all['finally_cart_amount'] += (int)$value['finally_cart_amount'];
        }
        $this->pagedata['cart_all'] = $cart_all;
        $this->set_tmpl('cart');
        $this->page('site/cart/index.html');
    }

    //购物车页面查询商品推荐内容

    //空购物车提示页
    public function blank() {
        $this->set_tmpl('cart');
        $this->page('site/cart/blank.html');
    }

    //向购物车添加商品
    public function add($product_id, $store_id, $num) {
        /**
         * 润和接口
         * ISO151401 创建购买需求订单
         */
        $params = $this->_request->get_params(true);
        $product_id = ($product_id ? $product_id : $params['product_id']);
        $store_id = ($store_id ? $store_id : $params['store_id']);
        $num = ($num ? $num : $params['num']);
        if (!$num) {
            $num = 1;
        }
        if (!$product_id || !$num || $num < 1 || !is_numeric($store_id)) {
            $this->splash('error', '', '参数错误!');
        }
        $object = array(
            'goods' => array(
                'product_id' => $product_id,
                'num' => $num,
                'store_id' => $store_id,
                'type' => $this->buyerId ? '1' : '0',
            ),
        );
        //加入购物车产生需求
        $result = vmc::singleton('b2c_source_cart')->add_cart($object);
        $ident = $this->cart_stage->add('goods', $object, $msg);
        if (!$ident) {
            $this->splash('error', '', $msg);
        }
        $forward = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_cart',
            'act' => 'addtocart',
            'args' => array(
                $ident,
            ),
        ));
        if ($this->_request->is_ajax()) {
            //异步加入购物车反馈
            $this->splash('success', $forward, $this->cart_stage->currency_result());
        }
        $this->splash('success', $forward);
    }

    //成功加入购物车后
    public function addtocart($ident) {
        /**
         * 润和接口
         * 查看购买需求订单接口无
         */
        $exist_cart = $this->cart_stage->result();
        if ($this->cart_stage->is_empty($exist_cart)) {
            $this->splash('error', $this->blank_url, '购物车为空！');
        }
        foreach ($exist_cart['objects']['goods'] as $k => $object) {
            if ($object['obj_ident'] == $ident) {
                if (!$object['warning'] && $object['disabled'] == 'true') {
                    $exist_cart['objects']['goods'][$k]['disabled'] = 'false';
                    break;
                }
            }
        }
        $this->_priceCount($exist_cart);
        $this->pagedata['cart_result'] = $exist_cart;
        $this->pagedata['last_add'] = $ident;
        $this->set_tmpl('addtocart');
        $this->page('site/cart/addtocart.html');
    }

    /**
     * 价盘 购物车 价格计算
     * @params $cartList 购物车信息列表
     **/
    private function _priceCount(&$cartList)
    {
        foreach ($cartList['objects']['goods'] as $key => &$goods)
        {
            foreach($goods['item']['product']['interval']['num_dn'] as $k => $v)
            {
                if($v > $goods['quantity'])
                {
                    $goods['item']['product']['buy_price'] = $goods['type'] == '1' ?
                        ((float)$goods['item']['product']['interval']['price'][$k - 1] * (float)$goods['item']['product']['interval']['discount'][$k - 1]) / 100 : $goods['item']['product']['interval']['price'][$k - 1];
                    break;
                }
                $goods['item']['product']['buy_price'] = $goods['item']['product']['interval']['price'][$k];
                $goods['item']['product']['buy_price'] = $goods['type'] == '1' ?
                    ((float)$v['price'] * (float)$v['discount']) / 100 : $v['price'];
            }
            $price[$key] = $goods['item']['product']['buy_price'] * $goods['quantity'];
        }
        if ($price) {
            $count_price = array_sum($price);
            $cartList['gain_score'] = $count_price;
            $cartList['cart_amount'] = $count_price;
            $exist_cart['finally_cart_amount'] = $count_price;
        }
    }

    public function fastbuy($product_id, $store_id, $num) {
        $agent = $this->_request->get_get();
        $params = $this->_request->get_params(true);
        $product_id = ($product_id ? $product_id : $params['product_id']);
        $num = ($num ? $num : $params['num']);
        if (!$num) {
            $num = 1;
        }
        if (!$product_id || !$num || $num < 1) {
            $this->splash('error', '', '参数错误!');
        }
        $object = array(
            'goods' => array(
                'product_id' => $product_id,
                'num' => $num,
                'store_id' => $store_id,
                'type' => $this->buyerId ? '1' : '0',
                'from_type' => empty($agent) ? 0 : 1,
            ),
        );
        $ident = $this->cart_stage->add('goods', $object, $msg, true); //fastbuy
        if (!$ident) {
            $this->splash('error', '', $msg);
        }
        $forward = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_checkout',
            'act' => 'fastbuy',
        )) . '?' . http_build_query($agent);
        $this->splash('success', $forward);
    }

    //更新购物车
    public function update($ident, $num) {
        $params = $this->_request->get_params(true);
        $obj_ident = ($ident ? $ident : $params['ident']);
        $num = ($num ? $num : $params['num']);
        $cart_result = $this->cart_stage->update('goods', $obj_ident, $num, $msg);
        $forward = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_cart',
        ));
        if (!$cart_result) {
            $this->splash('error', $forward, $msg);
        }
        $cart_result = $this->cart_stage->currency_result($filter = null, $cart_result);
        $this->splash('success', $forward, $cart_result);
    }

    //编辑购物车商品项
    public function edit() {

    }

    // 删除&购物车商品、清空购物车
    public function remove($ident = false) {
        $params = $this->_request->get_params(true);
        $obj_ident = ($ident ? $ident : $params['ident']);
        if (is_array($obj_ident)) {
            foreach ($obj_ident as $ident) {
                $this->cart_stage->delete('goods', $ident);
            }
        } else {
            $this->cart_stage->delete('goods', $ident);
        }
        $cart_result = $this->cart_stage->currency_result();
        if ($this->cart_stage->is_empty($cart_result)) {
            $this->splash('error', $this->blank_url, '购物车为空');
        }
        $forward = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_cart',
        ));
        $this->splash('success', $forward, $cart_result);
    }

    // 移到收藏夹
    public function mv2fav($arg_ident = false) {
        $params = $this->_request->get_params(true);
        $obj_ident = ($arg_ident ? $arg_ident : $params['ident']);
        if (!is_array($obj_ident)) {
            $obj_ident = array($obj_ident);
        }
        foreach ($obj_ident as $ident) {
            list($ot, $product_id) = explode('_', $ident);
            $product = app::get('b2c')->model('products')->getRow('goods_id', array('product_id' => $product_id));
            if (app::get('b2c')->model('member_goods')->add_fav($this->app->member_id, $product['goods_id'])) {
                $this->cart_stage->delete($ot, $ident);
            } else {
                $this->splash('error', array('app' => 'b2c', 'ctl' => 'site_cart'), '移到收藏夹失败!' . $msg);
            }
        }
        $cart_result = $this->cart_stage->currency_result();
        if ($this->cart_stage->is_empty($cart_result)) {
            $this->splash('error', $this->blank_url, '购物车为空');
        }
        $this->splash('success', array('app' => 'b2c', 'ctl' => 'site_cart'), $cart_result);
    }

    //使用优惠券
    public function use_coupon($is_fastbuy = false) {
        $params = $this->_request->get_params(true);
        $added_obj_ident = $this->cart_stage->add('coupon', array('coupon' => $params['coupon']), $msg, $is_fastbuy);
        if (!$added_obj_ident) {
            $this->splash('error', '', $msg);
        } else {
            /*
             * 当优惠券成功进入购物车时，并不代表该优惠券可用
             * 以确认优惠券是否满足促销条件，若不满足，需要从购物车删除优惠券，并提示顾客
             */
            if ($is_fastbuy) {
                $filter['is_fastbuy'] = 'true'; //在立即购买结算流程中使用优惠券
            } else {
                $filter = null;
            }
            /*
             * 当调用cart_stage result 方法时，内部已经完成促销计算，对于不能使用的优惠券，会直接标记
             */
            $cart_result = $this->cart_stage->result($filter);
            foreach ($cart_result['objects']['coupon'] as $key => $coupon) {
                if ($coupon['params']['warning'] && $coupon['params']['code'] == $params['coupon']) {
                    $this->cart_stage->delete('coupon', $coupon['obj_ident'], $is_fastbuy);
                    $this->splash('error', '', $coupon['params']['warning']);
                    break;
                }
            }
            $cart_result['new_cart_md5'] = utils::array_md5($cart_result);
        }
        //使用成功，需要返回最新购物车

        $this->splash('success', '', $cart_result);
    }

    //移除优惠券
    public function remove_coupon($is_fastbuy = false) {
        if ($is_fastbuy) {
            $filter['is_fastbuy'] = 'true'; //在立即购买结算流程中使用优惠券
        } else {
            $filter = null;
        }
        $params = $this->_request->get_params(true);
        $this->cart_stage->delete('coupon', $params['obj_ident'], $is_fastbuy);
        $cart_result = $this->cart_stage->result($filter);
        $cart_result['new_cart_md5'] = utils::array_md5($cart_result);

        //用于直接在购物车取消优惠券
        if (!$this->_request->is_ajax()) {
            $this->redirect(array(
                'app' => 'b2c',
                'ctl' => 'site_cart',
            ));
        }
        $this->splash('success', '', $cart_result);
    }

    //禁用购物车项
    public function disabled($ident = false) {
        $params = $this->_request->get_params(true);
        if ($ident && !isset($params['ident'])) {
            $params['ident'] = $ident;
        }
        $_SESSION['CART_DISABLED_IDENT'] = array_merge($_SESSION['CART_DISABLED_IDENT'], $params['ident']);
        $forward = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_cart',
        ));
        $cart_result = $this->cart_stage->currency_result();
        $this->splash('success', $forward, $cart_result);
    }

    //激活购物车项
    public function enabled($ident = false) {
        $params = $this->_request->get_params(true);
        if ($ident && !isset($params['ident'])) {
            $params['ident'] = $ident;
        }
        $_SESSION['CART_DISABLED_IDENT'] = array_diff($_SESSION['CART_DISABLED_IDENT'], $params['ident']);
        $forward = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_cart',
        ));
        $cart_result = $this->cart_stage->currency_result();
        $this->splash('success', $forward, $cart_result);
    }

}
