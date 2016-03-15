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
 * 冻品管家类
 * @author Administrator
 *
 */
class buyer_ctl_site_manager extends buyer_frontpage{
	
	public function __construct(&$app){
		parent::__construct($app);
		$this->verify_buyer();
		//后面还需要什么............
	}
	
	
	/**
	 * 冻品管家管理（list）
	 */
	public function index(){
		echo '冻品管家管理';
	}
	
	
	/**
	 * 管家注册（有下一步）
	 */
	public function manager_signup(){
		echo '管家注册';
	}
	
	
	/**
	 * 管家资质信息（包括：基本信息+工作履历）
	 */
	public function certification(){
		echo '管家资质信息';
	}
	
	
	/**
	 * 所有业绩列表（里面加的有查询和js）
	 */
	public function feat(){
		echo '业绩查询';
	}
	
	
}