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


/********这个稍后放到admin文件夹*******************************************/
/**
 * 买手店信息管理
 * @author Administrator
 *
 */
class buyer_ctl_site_buyer extends buyer_frontpage{
	
	public function __construct(&$app){
		parent::__construct($app);
		//后面还需要什么............
	}
	
	
	public function index(){
		$this->output();
	}
	
	
	/**
	 * 买手店修改自己的信息
	 */
	public function edit(){
		
	}
	
	/**
	 * 买手店邀请冻品管家
	 */
	public function invite_manager(){
		//这里要不要做个通过手机号获取连接或者邀请码
		
	}
	
	
	/**
	 * 获取对应冻品管家列表
	 * 信息包括冻品管家和买手店的结算管理
	 */
	public function get_manager_list(){
		
	}
	
	
	/**
	 * 获取邀请未通过的冻品管家
	 */
	public function get_unmanager_list(){
		
	}
	
	
	
	
}