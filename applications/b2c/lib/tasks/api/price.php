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


class b2c_tasks_api_price extends base_task_abstract implements base_interface_task
{
    /**
     * 产品盘价查询 - IPD141111
     */
    public function exec($params = null)
    {
    	$rpc_request['pricePeriod'] = 16043;
    	//$rpc_request['pricePeriod'] = date('ym').ceil(date('j')/5);
    	$rpc_response = app::get('b2c')->rpc('select_price_offer')->request($rpc_request);
    	$rpc_data = $rpc_response['result']['productslist'];
    	$model = app::get('b2c')->model('products_price');
    	//$model->db->exec('DELETE FROM `vmc_b2c_products_price` WHERE price_period = '.date('ym').ceil(date('j')/5));
    	foreach ($rpc_data as $key=>$value){
    		foreach ($value['pricelist'] as $k=>$v){
    			$data = array();
    			$data['logi_area_code']	=	$value['logiAreaCode'];
    			$data['seller_code']	=	$value['slCode'];
    			$data['product_code']	=	substr($value['productCode'], 0, 9);
    			$data['level_code']		=	substr($value['productCode'], -1);
    			$data['price_period']	=	16043;
    			//$data['price_period']	=	date('ym').ceil(date('j')/5);
    			$model->save(array_merge($data,$v));
    		}
    	}
        return true;
    }
}
