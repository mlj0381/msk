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




class b2c_mdl_products extends dbeav_model{

    function __construct($app){
        parent::__construct($app);
        //使用meta系统进行存储
        $this->use_meta();
    }

    public function goods_detail()
    {
        $seller_api = vmc::singleton('seller_source_product');
        if(method_exists($seller_api, 'request')){
            //return $seller_api->request($params);
        }else{
            //没定义接口调用本地数据
        }
    }

    /**
     * 通过货品信息和数量获取货品价格
     * @param unknown $request
     * price_period		周期	(默认now) eg:16043
     * product_code		货品code eg:012040201
     * logi_area_code	地区编码	eg:上海:41
     * seller_code		卖家code eg:7010900167
     * level_code       货品等级code (默认2)eg:A2:2
     * amount			数量 (默认1)
     * 
     * 
     */
    public function get_product_price($request){
    	if ($request['product_code'] && $request['logi_area_code']){
    		if (empty($request['price_period']))	$request['price_period'] = date('ym').ceil(date('j')/5);
    		if (empty($request['level_code']))		$request['level_code'] = 2;
    		
    		if (empty($request['amount']) || intval($request['amount']) < 0){
    			$request['boxMin'] = 1;
    			$request['amount'] = 1;
    		}else {
    			$request['boxMin|sthan'] = (int)$request['amount'];
    		}
    		if (empty($request['seller_code']))		unset($request['seller_code']);
    		$price_list = $this->app->model('products_price')->getRow('priceOfBox', $request, array('priceOfBox','ASC'));
    		return $price_list['priceOfBox']*$request['amount'];
    	}else {
    		return null;
    	}
    		
    }


}
