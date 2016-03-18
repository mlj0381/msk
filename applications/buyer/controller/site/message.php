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
 * 消息中心类
 * @author Administrator
 *
 */
class buyer_ctl_site_message extends buyer_frontpage{
	
	public $titel = '消息中心';
	
	public function __construct(&$app){
		parent::__construct($app);
		$this->verify_buyer();
		//后面还需要什么............
	}
	
	
	/**
	 * 站内消息
	 */
	public function index(){
		//全部消息-买家来信-订单
		$this->menuSetting = 'message';
		$this->output();
	}
	
	
	/**
	 * 发送站内消息
	 */
	public function send_message(){
		$this->menuSetting = 'message';
		$this->output();
	}
	
	
}