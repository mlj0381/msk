<?php

// +----------------------------------------------------------------------
// | Date: 2016-3-8 下午1:44:46		start
// +----------------------------------------------------------------------
// | Author: sunjunfeng
// +----------------------------------------------------------------------
// | Action: 买手店通行证（验证 注册 登陆）
// +----------------------------------------------------------------------
// | Version: 
// +----------------------------------------------------------------------

class buyer_ctl_site_passport extends site_controller{
	
	public function __construct(&$app){
		parent::__construct($app);
		//后面还需要什么............
	}
	
	public function signup($forward){
		$this->title = '注册成为买手店';
		//检查是否登录，如果已登录则直接跳转到会员中心
		//这个是否需要
		$this->check_login();
		$this->set_forward($forward); //设置登录成功后跳转
		
		if ($_POST){
			
		}
	}
	
	private function _signup($post, $forward){
		
	}
	
	
	
}