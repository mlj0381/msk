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

class b2c_ctl_site_checkout extends b2c_frontpage
{
    public $title = '订单确认';
    public function __construct(&$app)
    {
        parent::__construct($app);
        $this->_response->set_header('Cache-Control', 'no-store');
        $this->buyer_id = vmc::singleton('buyer_user_object')->get_session();
        $this->buyer_id || $this->verify_member();
        //$this->app->member_id  已赋值
        $this->cart_stage = vmc::singleton('b2c_cart_stage');
        $this->cart_stage->set_member_id($this->buyer_id ?: $this->app->member_id);
        if(!$this->app->member_id) {
            $this->app->member_id = $this->member['member_id'];
        }
        $this->set_tmpl('checkout');
    }
    //checkout 主页
    public function index($fastbuy = false, $params)
    {

        $blank_url = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_cart',
            'act' => 'blank',
        ));
        $filter = array();
        $member_id = $this->app->member_id;
        if ($fastbuy !== false) {
            $filter['is_fastbuy'] = 'true';
        }
        $cart_result = $this->cart_stage->result($filter);
        if ($fastbuy !== false) {
            if ($this->cart_stage->is_empty($cart_result) || $cart_result['objects']['goods'][0]['disabled'] || $cart_result['objects']['goods'][0]['warning']) {
                $this->splash('error', '', '立即购买失败.'.$cart_result['objects']['goods'][0]['warning']);
            }
        } else {
            if ($this->cart_stage->is_empty($cart_result)) {
                $this->splash('error', '', '购物车为空!');
            }
        }
//        foreach ($cart_result['objects']['goods'] as $key => $value) {
//            if($value['quantity'] > $value['item']['product']['price_interval']){
//                $count_price[$key] = $value['quantity'] * $value['item']['product']['price_up'];
//            }else{
//                $count_price[$key] = $value['quantity'] * $value['item']['product']['price_dn'];
//            }
//        }

        if(count($count_price) > 0){
            $cart_amount = array_sum($count_price);
            $cart_result['cart_amount'] = $cart_amount;
            $cart_result['gain_score'] = $cart_amount;
        }
        $this->pagedata = vmc::singleton('b2c_checkout_stage')->check(array(
            'member_id' => $member_id,
            'cart_result' => $cart_result,
        ));
        if ($fastbuy !== false) {
            $this->pagedata['is_fastbuy'] = 'is_fastbuy';
        }
        $store_obj = vmc::singleton('store_store_object');
        foreach ($this->pagedata['cart_result']['objects']['goods'] as $key => $value) {
            $this->pagedata['cart_result']['objects']['goods'][$key]['store_info'] = $store_obj->store_info($value['store_id']);
        }
        $available_coupons = vmc::singleton('b2c_coupon_stage')->get_member_couponlist($member_id, $my_coupons);
        foreach ($cart_result['promotions']['order'] as $p) {
            if ($p['rule_type'] == 'coupon' && $available_coupons[$p['coupon_code']]) {
                $available_coupons[$p['coupon_code']]['in_cart'] = 'true';
            }
        }
        /**
         * 润和接口
         * 查看购买需求订单接口无
         * IBY121208 收货地址查询
         * IBY121208 更新收货地址
         * IBY121208 删除收货地址
         * IBY121209 收货时间查询
         * ISO151414 标准分销订单 分销买手囤货订单 第三方订单 第三方买手囤货订单
         * 查看购买需求订单接口无
         * 买手购买 不用收货地址，支付方式在线地付，发货时间等都无
         */
        $object_obj = vmc::singleton('buyer_user_object');
        $buyer_id = $object_obj->get_id();
        if(!$buyer_id)
        {
            $member = app::get('b2c')->model('members')->getRow('*',array('member_id'=>$member_id));
            $api_buyer_id = $member['buyer_id'];
            $buyer_code = $member['buyer_code'];
            $buyer_name = '1';
        }else{
            $buyer = app::get('buyer')->model('buyers')->getRow('*',array('buyer_id'=>$buyer_id));
            $api_buyer_id = $buyer['api_buyer_id'];
            $buyer_code = $buyer['buyer_code'];
            $buyer_name = $buyer['local'];
        }

        if(!$api_buyer_id && !$buyer_code)
        {
            $this->splash('error', '', '用户不存在');
        }
        $api_data = array(
            'districtCode' => $_SESSION['account']['addr'],
            'buyer_id' => $api_buyer_id,
            'buyer_code' => $buyer_code,
            'buyer_type' => '1',
            'buyer_name' => $buyer_name,
            'seller_name' => '1',
            'seller_code' => '1',
            'products' => array()
        );
        foreach($this->pagedata['cart_result']['objects']['goods'] as $product)
        {
            if(!empty($product['item']['product']['disabled']))
            {
                $data['bn'] = $product['item']['product']['bn'].'2';
                $data['name'] = substr($product['item']['product']['name'],0,15);
                $data['price'] = $product['item']['product']['price'];
                $data['quantity'] = $product['quantity'];
                $api_data['products'][] = $data;
            }
        }
        $result = app::get('b2c')->rpc('order_create')->request($api_data);

        if(!$result['result']['proCode'])
        {
            $this->splash('error', '', '需求订单下单失败!');
        }
        //购物需求订单编码 ，保存用户的session里面，下单时候需要使用单
        $_SESSION['account']['order_code'] = $result['result']['proCode'];
        $_SESSION['account']['api_buyer_id'] = $api_buyer_id;
        $_SESSION['account']['buyer_code'] = $buyer_code;
        //end

        $this->pagedata['order_from'] = $params['buyer'];
        $this->pagedata['manager'] = $params['manager'];
        $this->pagedata['buyer_id'] = $this->buyer_id;
        $this->pagedata['my_coupons'] = $my_coupons;
        $this->pagedata['my_av_coupons'] = $available_coupons;
        $this->pagedata['receiving'] = $this->app->getConf('receiving_time');
        $this->page('site/checkout/index.html');
    }
    /**
     * 快速购买.
     */
    public function fastbuy()
    {
        $this->index('is_fastbuy', $this->_request->get_get());
    }

    public function check($fastbuy = false)
    {
        $redirect = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_checkout',
        ));
        $filter = array();
        $member_id = $this->app->member_id;
        if ($fastbuy) {
            $filter['is_fastbuy'] = 'true';
        }
        $params = $this->_request->get_params(true);
        $cart_result = $this->cart_stage->result($filter);
        $params = array_merge($params, array(
            'member_id' => $member_id,
            'cart_result' => $cart_result,
            'ignore_return_cart_result' => true,
        ));
        $check_result = vmc::singleton('b2c_checkout_stage')->check($params);
        if ($params['cart_md5'] != $check_result['cart_md5']) {
            $this->splash('error', $redirect, '购物车发送变化！');
        }
        $this->splash('success', $redirect, $check_result);
    }
    public function payment($order_id, $flow_success = 0 , $new_payappid = false)
    {
        $redirect = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_member',
            'act' => 'orders',
        ));
        //判断是买手还是买家
        $object_obj = vmc::singleton('buyer_user_object');
        $buyer_id = $object_obj->get_id();
        if($buyer_id)
        {
            $redirect = $this->gen_url(array(
                'app' => 'buyer',
                'ctl' => 'site_goods',
                'act' => 'store',
            ));
        }
        $order = $this->app->model('orders')->dump($order_id);
        if (!$order) {
            $this->splash('error', $redirect, '未知订单信息');
        }
        if ($this->app->member_id != $order['member_id']) {
            $this->splash('error', $redirect, '非法操作');
        }
        if ($order['pay_status'] == '1' || $order['pay_status'] == '2' || $order['payed'] == $order['order_total']) {
            $this->splash('success', $redirect, '订单已付款！');
        }
        //变更支付方式
        if($new_payappid){
            if(!vmc::singleton('b2c_checkout_stage')->changepayment($order_id,$new_payappid,$error_msg)){
                $this->pagedata['changepayment_errormsg'] = $error_msg;
            }else{
                //order pay_app is  updated
                $order['pay_app'] = $new_payappid;
            }
        }
        $mdl_payapps = app::get('ectools')->model('payment_applications');
        $filter = array(
            'status' => 'true',
            'platform_allow' => array(
                'pc',
            ),
        );
        if ($order['is_cod'] == 'Y') {
            $filter['app_id'] = 'cod';
        }
        $payapps = $mdl_payapps->getList('*', $filter);
        $selected_payapp = $mdl_payapps->dump($order['pay_app']);
        $this->pagedata['order'] = $order;
        $this->pagedata['payapps'] = $payapps;
        $this->pagedata['selected_payapp'] = $selected_payapp;
        $this->pagedata['flow_success'] = $flow_success;
        //$this->set_tmpl('checkout');
        //$this->page('site/checkout/payment.html');
        $this->page('site/checkout/new_orderpay.html');
    }

    public function dopayment($order_id)
    {
        $redirect = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_member',
            'act' => 'orders',
        ));
//        if($this->app->model('orders')->update(array('pay_status' => '1'), array('order_id' => $order_id))){
//            $this->splash('success', $redirect, '支付成功');
//        }
//        $this->splash('error', $redirect, '支付失败');

        $obj_bill = vmc::singleton('ectools_bill');
        $mdl_bills = app::get('ectools')->model('bills');
        $order = $this->app->model('orders')->dump($order_id);
        if($order['pay_status'] == '1' || $order['pay_status'] == '2'){
            $this->splash('success', $redirect, '已支付');
        }
        if (in_array($order['pay_app'], array(
            'cod',
            'offline',
        ))) {
            $this->splash('error', $redirect, '不是在线支付方式');
        }
        if ($this->app->member_id != $order['member_id']) {
            $this->splash('error', $redirect, '非法操作');
        }
        //未交互过的账单复用

        $bill_sdf = array(
            'order_id' => $order['order_id'],
            'bill_type' => 'payment',
            'pay_mode' => 'online',
            'pay_object' => 'order',
            'money' => $order['order_total'] - $order['payed'],
            'member_id' => $order['member_id'],
            'status' => 'ready',
            'pay_app_id' => $order['pay_app'],
            'pay_fee' => $order['cost_payment'],
            'memo' => $order['memo'],
        );
        $exist_bill = $mdl_bills->getRow('*',$bill_sdf);
        //一天内重复利用原支付单据
        if ($exist_bill && !empty($exist_bill['bill_id']) && $exist_bill['createtime']+86400>time()) {
            $bill_sdf = array_merge($exist_bill, $bill_sdf);
        } else {
            $bill_sdf['bill_id'] = $mdl_bills->apply_id($bill_sdf);
        }
        $bill_sdf['return_url'] = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_checkout',
            'act' => 'payresult',
            'args' => array(
                $bill_sdf['bill_id'],
            ),
        ));
        try {
            if (!$obj_bill->generate($bill_sdf, $msg)) {
                $this->splash('error', $redirect, $msg);
            }
        } catch (Exception $e) {
            $this->splash('error', $redirect, $e->getMessage());
        }
        $get_way_params = $bill_sdf;
        if (!vmc::singleton('ectools_payment_api')->redirect_getway($get_way_params, $msg)) {
            $this->splash('error', $redirect, $msg);
        }
        //here we go to the platform
    }
    /**
     * 监测订单支付状态
     */
    public function paystatus($order_id){
        $mdl_orders = app::get('b2c')->model('orders');
        $order = $mdl_orders->getRow('member_id,pay_status',array('member_id'=>$this->app->member_id,'order_id'=>$order_id));
        if($order['member_id']!= $this->app->member_id){
            $this->splash('error','','非法操作!');
        }
        switch ($order['pay_status']) {
            case '1':
            case '2':
            //case '3':
                $this->splash('success','','已支付');
                break;

            default:
                $this->splash('error','','未支付');
                break;
        }
    }

    //支付回调
    public function payresult($bill_id)
    {
        $mdl_bills = app::get('ectools')->model('bills');
        $bill = $mdl_bills->dump($bill_id);
        if ($bill['member_id'] != $this->app->member_id) {
            $this->splash('error', $redirect, '非法操作');
        }
        $this->pagedata['bill'] = $bill;
        $this->pagedata['order'] = $this->app->model('orders')->dump($bill['order_id']);
        //$this->set_tmpl('checkout');
        $this->page('site/checkout/payresult.html');
    }
}
