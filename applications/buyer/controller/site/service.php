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
 * 客户服务类
 * @author Administrator
 *
 */
class buyer_ctl_site_service extends buyer_frontpage{
	
	public function __construct(&$app){
		parent::__construct($app);
		$this->verify_buyer();
		//后面还需要什么............
	}
	
	
	/**
	 * 退货管理
	 */
	public function cancel_goods(){
		$this->output();
	}
	
	
	/**
	 * 退款管理
	 */
	public function refund(){
		$this->output();
	}
	
	
	/**
	 * 售后管理
	 */
	public function customer(){
		$this->output();
	}
	
	/**
	 * 违规处理
	 */
	public function out(){
		$this->output();
	}
	
	
	/**
	 * 举报管理
	 */
	public function report(){
		$this->output();
	}
	
	
	/**
	 * 咨询回复
	 */
	public function consult(){
		$this->output();
	}
	
}