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
 * 买手店商品管理类
 * @author Administrator
 *
 */
class buyer_ctl_site_goods extends buyer_frontpage{
	
	public function __construct(&$app){
		parent::__construct($app);
		$this->verify_buyer();
		//后面还需要什么............
	}
	
	
	/**
	 * 出货管理
	 */
	public function index(){
		
		$this->output();
	}
	
	
	/**
	 * 订单详情（单个订单的详情）
	 */
	public function order_details(){
		echo '订单详情';
	}
	
	
	/**
	 * 已购买商品
	 */
	public function stock(){
		$this->output();
	}
	
	/**
	 * 库存管理
	 */
	public function repertory(){
		$this->output();
	}
	
	
}