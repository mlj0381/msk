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
 * 买手店信息管理
 * @author Administrator
 *
 */
class buyer_ctl_site_buyer extends buyer_frontpage{
	
	public $titel = '个人中心';
	
	public function __construct(&$app){
		parent::__construct($app);
		$this->verify_buyer();
		//后面还需要什么............
	}
	
	
	public function index($status){
		//'args'=>$status;
        $this->output();
	}
	
	
	/**
	 * 买手店信息
	 * 包括信息修改、绑定和保存
	 */
	public function buyer_info(){
		//用户名、手机号、邮箱、主销品类（选择的列表）
		//负责人信息->姓名、手机号、邮箱、身份证、身份证照片、QQ、微信
		//绑定手机号修改邮箱
		$this->menuSetting = 'account';
		$this->output();
	}
	
	
	/**
	 * 密码修改
	 */
	public function reset_password(){
		//echo '修改密码->旧密码-新密码-确认新密码';
		if ($_POST){
			$params = utils::_filter_input($_POST);
			unset($_POST);
			vmc::singleton('base_session')->start();
			$user_id = vmc::singleton('buyer_user_object')->get_session();
			if ($params['new_password'] != $params['confirm_password']){
				$this->splash('error', '', '两次输入的新密码不一致！');
			}
			$status = $this->app->model('buyers')->reset_password($user_id,$params['old_password'],$params['new_password']);
			
			switch ($status){
				case 'success':
					$msg = '新密码设置成功！';
					$url = $this->gen_url(array(
							'app' => 'buyer',
							'ctl' => 'site_passport',
							'act' => 'login',
					));
					break;
				case 'no':
					$msg = '新密码设置失败！';
					$url = '';
					break;
				case 'error':
					$msg = '旧密码输入错误！';
					$url = '';
					break;
			}
			$this->splash(($status == 'no') ? 'error' :$status, $url, $msg);
			
		}
		$this->menuSetting = 'account';
		$this->output();
	}
	
	/**
	 * 账户安全
	 */
	public function buyer_security(){
		$this->menuSetting = 'account';
		$this->output();
	}
	
	/**
	 * 基本资料
	 */
	public function basic_info(){
		$this->menuSetting = 'account';
		$this->output();
	}
	
	
	/**
	 * 修改手机
	 */
	public function update_mobile(){
		$this->menuSetting = 'account';
		$this->output();
	}
	
	
	/**
	 * 修改email
	 */
	public function update_email(){
		$this->menuSetting = 'account';
		$this->output();
	}
	
	
	/**
	 * 修改email提示
	 */
	public function update_email_hint(){
		$this->menuSetting = 'account';
		$this->output();
	}
	
	
	/**
	 * 重置提示
	 */
	public function reset_hint(){
		$this->menuSetting = 'account';
		$this->output();
	}
	
	
	/**
	 * 绑定手机
	 */
	public function bind_mobile(){
		$this->menuSetting = 'account';
		$this->output();
	}
	
	
	/**
	 * 绑定提示
	 */
	public function bind_hint(){
		$this->menuSetting = 'account';
		$this->output();
	}
	
	
	/**
	 * 身份认证
	 */
	public function ident_auth(){
		$this->menuSetting = 'account';
		$this->output();
	}
	
	/**
	 * 认证提示
	 */
	public function ident_auth_hint(){
		$this->menuSetting = 'account';
		$this->output();
	}
	
	
	/**
	 * 添加密保
	 */
	public function add_security(){
		$this->menuSetting = 'account';
		$this->output();
	}
	
	
}