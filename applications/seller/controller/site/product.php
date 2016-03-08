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
// | Description 商家店铺
// +----------------------------------------------------------------------

class seller_ctl_site_product extends seller_frontpage
{
    public function __construct(&$app){
        parent::__construct($app);
        $this->app = $app;
        $this->verify();
        $this->mStore = app::get('store')->model('store');
    }

    public function index(){
		die('test');
        //$this->output();
    }

	public function read()
	{	
		$store_product_list;
		$mStoreExtra = app::get('store')->model('extra');
		$store_product_list_file = $mStoreExtra->getRow('key,value,attach', array(
			'uid' => $this->store['store_id'],
			'type' => 'store',
			'key' => 'product_list'
		));		
		$objCsv = vmc::singleton('base_csv');		
		$store_product_list = $objCsv->import(ROOT_DIR . "/" . $store_product_list_file['attach']);
		
	}

	public function upload()
	{
	
	}

	public function edit()
	{
		
	}
	public function remove()
	{
	
	}
}