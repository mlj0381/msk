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


class b2c_ctl_site_product extends b2c_frontpage {

    public $title = '商品详情';

    public function __construct($app) {
        parent::__construct($app);

        $this->goods_stage = vmc::singleton('b2c_goods_stage');
        if ($this->app->member_id = vmc::singleton('b2c_user_object')->get_member_id()) {
            $this->goods_stage->set_member($this->app->member_id);
        }
    }

    public function get_goods_orders()
    {
    	$params = $_POST;
    	
    	$goods_data = $this->app->model('products')->getRow('goods_id,bn',array('product_id'=>$params['product_id']));
    	$goods_data['goods_id'] = 8;
    	
    	//成交记录
    	$goods_order_list = $this->app->model('orders')->get_goods_order($goods_data['goods_id'], $params['time_type'] ?: '1', $offset=0, $set=2);
    	foreach ($goods_order_list as &$v){
    		$v['last_modified'] = date('Y-m-d H:i:s',$v['last_modified']);
    	}
    	$this->splash('success', '', $goods_order_list);
    }
    
    public function index($typ) {
        //获取参数 货品ID
        $params = $this->_request->get_params();
        //调用接口 2015/12/9
        //$data_detail = $this->app->model('products')->goods_detail($params[0]);
        //>>
        if (empty($params)){
        	$params = json_decode($_POST['parms_post'],true);
        }
        
        $data_detail = $this->goods_stage->detail($params[0], $msg); //引用传递
        if (!$data_detail) {
            vmc::singleton('site_router')->http_status(404);
            $this->splash('error', null, $msg);
        }
        
        //通过vmc_b2c_products 表获取goods_id 和 bn
        $products_data = $this->app->model('products')->getRow('goods_id,bn',array('product_id'=>$params[0]));
        //调用接口获取四级分类和五级分类
        $response = $this->app->rpc('goods_info')->request($data=array());
        $data_detail_response = utils::array_change_key($response['result']['goods'], 'bn')[$products_data['bn']];
        //这个是data_detail拼接
        $data_detail['name'] = str_replace('/'," ",$data_detail_response['name']);
        //一级
        $data_detail['classesCode'] = $data_detail_response['cat_1'];
        //二级
        $data_detail['machiningCode'] = $data_detail_response['cat_2'];
        //三级
        $data_detail['breedCode'] = $data_detail_response['breed_code'];
        $data_detail['featureCode'] = $data_detail_response['feature'];
        $data_detail['gradeCode'] = 'A2';
        $data_detail['deliver_fee'] = '0';
        /*******************这个需要获取物流区地址：目前写死了************************************/
        $data_detail['logiAreaCode'] = '41';
        $price_response = $this->app->rpc('select_product_price')->request($data_detail, false);
        $data_detail['pricelist'] = $price_response['result'][0]['pricelist'];

        $data_detail['feature_data_list'] = $this->app->rpc('select_product_cat4')->request($data_detail, false)['result'];
        //var_dump($data_detail['feature_data_list']);exit;
        foreach ($data_detail['feature_data_list'] as $key=>$value){
        	$data_detail['featureCode'] = $value['featureCode'];
        	$weight_data[$key] = $this->app->rpc('select_product_cat5')->request($data_detail, false)['result'];
        }
       
        //包装规格  $data[0];
        $data_detail['weight_data_list'] = array_filter(array_unique($weight_data));
        
        //var_dump($data_detail);exit;
        
        $this->pagedata['buyer_id'] = vmc::singleton('buyer_user_object')->get_session();
        $this->pagedata['data_detail'] = $data_detail;
        $this->pagedata['store_id'] = $params[1];
        $store_obj = vmc::singleton('store_store_object');
        $this->pagedata['store_info'] = $store_obj->store_info($params[1]);
        //设置模板
        if ($data_detail['goods_setting']['site_template']) {
            //设置模板页
            $this->set_tmpl_file($data_detail['goods_setting']['site_template']);
        }
        $this->pagedata['from_type'] = $this->_request->get_get();//买手或是冻品管家分销
        $this->pagedata['buy_items'] = $this->_buy_items($data_detail['goods_id']);
        $this->pagedata['goods_path'] = $this->app->model('goods')->getPath($data_detail['goods_id']);
        
        //成交记录
        $goods_order_list = $this->app->model('orders')->get_goods_order($goods_id=8, $_POST['time_type'] ?: '1', $offset=0, $set=2);
        $this->pagedata['goods_order_list'] = $goods_order_list;
        $this->pagedata['product_id'] = $params[0];
        $this->_set_seo($data_detail);
        $this->page('site/product/index.html');
    }

    //商品查询成交记录
    private function _buy_items($goods_id){
        //得到商品id
        $order_items = $this->app->model('order_items')->getList('*', array('goods_id' => $goods_id));
        $mdl_order = $this->app->model('orders');
       // $mdl_member = $this->app->model('members'); 显示登录名
        $mdl_member = app::get('pam')->model('members');
        foreach($order_items as &$value){
            $member = $mdl_order->getRow('member_id, createtime', array('order_id' => $value['order_id']));
            $value['createtime'] = $member['createtime'];
            $value['member_info'] = $mdl_member->getRow('login_account, member_id', array('member_id' => $member['member_id']));
            $value['member_info']['login_account'] = substr_replace($value['member_info']['login_account'], '****', 2, 5);
        }
        return $order_items;
    }

    /* 设置详情页SEO --start */

    public function _set_seo($goods_detail) {
        $seo_info = $goods_detail['seo_info'];
        if (!is_array($seo_info)) {
            $seo_info = unserialize($seo_info);
        }
        if (!empty($seo_info['seo_title']) || !empty($seo_info['seo_keywords']) || !empty($seo_info['seo_description'])) {
            $this->title = $seo_info['seo_title'];
            $this->keywords = $seo_info['seo_keywords'];
            $this->description = $seo_info['seo_description'];
        } else {
            $this->setSeo('site_product', 'index', $this->generate_seo_data($goods_detail));
        }
    }

    /**
     * 组织SEO数据，更换动态占位符 ENV_key.
     */
    public function generate_seo_data($goods_detail) {
        $keywords = '';
        if (isset($goods_detail['keywords'])) {
            foreach ($goods_detail['keywords'] as $key => $value) {
                $keywords .= $value['keyword'] . ',';
            }
        }
        $tags = array();
        if (isset($goods_detail['tag'])) {
            foreach ($goods_detail['tag'] as $key => $value) {
                $tags[] = $key;
            }
            $tags = app::get('desktop')->model('tag')->getList('tag_name', array('tag_id' => $tags));
            $tags = utils::array_change_key($tags, 'tag_name');
            $tags = array_keys($tags);
        }

        return array(
            'goods_name' => $goods_detail['name'] . '_' . $goods_detail['product']['spec_info'],
            'goods_brand' => $goods_detail['brand']['brand_name'],
            'goods_bn' => $goods_detail['product']['bn'],
            'goods_cat' => $goods_detail['category']['cat_name'],
            'goods_intro' => $goods_detail['brief'],
            'goods_barcode' => $goods_detail['product']['barcode'],
            'goods_keywords' => $keywords,
            'goods_tags' => implode(',', $tags),
        );
    }

    public function stock_confirm()
    {
        $args = $_POST;
        $sku = $args['sku'];
        if(!$sku){
            $this->failure('缺少参数');
        }
        $_echo = array();
        $sku_bn = explode(',', $sku);
        if (count($sku_bn) > 0) {
            $result = app::get('b2c')->model('stock')->getList('sku_bn,warehouse,quantity-freez_quantity as num', array(
                'sku_bn' => $sku_bn,
            ));
            $_echo = utils::array_change_key($result, 'sku_bn');
        }
        $this->splash('success', '',$_echo);
    }

    //商品详情页评论显示
    public function comment($goods_id, $page = 1){
        $mdl_comment = $this->app->model('member_comment');
        $this->_response->set_header('Cache-Control', 'no-store');
        $limit = 20;
        $filter = array(
            'goods_id' => $goods_id,
            'display' => 'true'
        );
        $comment_list = $mdl_comment->groupList('*', $filter, ($page - 1) * $limit, $limit, '', 'goods_id');
        $comment_list = $mdl_comment->memberGroup($comment_list);
        $count = $mdl_comment->count($filter);
        $this->pagedata['comment_list'] = $comment_list;
        $this->pagedata['comment_count'] = $count;
        $this->pagedata['pager'] = array(
            'total' => ceil($count / $limit),
            'current' => $page,
            'link' => array(
                'app' => 'b2c',
                'ctl' => 'site_product',
                'act' => 'comment',
                'args' => array(
                    $goods_id,
                    ($token = time()),
                ),
            ),
            'token' => $token,
        );
        $this->display('site/comment/list.html');
    }
}
