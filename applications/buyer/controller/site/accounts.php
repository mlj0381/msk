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
 * 买手店结算类
 * @author Administrator
 *
 */
class buyer_ctl_site_accounts extends buyer_frontpage{
	
	public function __construct(&$app){
		parent::__construct($app);
		$this->verify_buyer();
		//后面还需要什么............
	}

	
	/**
	 * 结算管理（list）
	 */
	public function index(){
		$this->output();
	}
	
	
	/**
	 * 结算明细（list+包括详细订单信息）
	 */
	public function details(){
		
	}
	
	
	
}