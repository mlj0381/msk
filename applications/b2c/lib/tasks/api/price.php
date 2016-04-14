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
    	
//     	$no_month = ceil(date('j')/7);
//     	if (date('w') < date('w', strtotime(date('Y-m-01')))){
//     		$no_month++;
//     	}
//     	$data['pricePeriod'] = 16042;//date('ym').$no_month;
    	$data['pricePeriod'] = date('ym').ceil(date('j')/5);
    	$rpc_response = app::get('b2c')->rpc('select_price_offer')->request($data);
    	$rpc_data = $rpc_response['result']['productslist'];
    	$model = app::get('b2c')->model('products_price');
    	$model->db->exec('TRUNCATE TABLE vmc_b2c_products_price');
    	foreach ($rpc_data as $key=>$value){
    		foreach ($value['pricelist'] as $k=>$v){
    			$data = array();
    			$data['logi_area_code']	=	$value['logiAreaCode'];
    			$data['seller_code']	=	$value['slCode'];
    			$data['product_code']	=	substr($value['productCode'], 0, 9);
    			$data['level_code']		=	substr($value['productCode'], -1);
    			$model->save(array_merge($data,$v));
    		}
    	}
        return true;
    }
}
