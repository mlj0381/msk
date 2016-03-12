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
 * 买手店验证类
 * @author Administrator
 *
 */
class buyer_ctl_site_copypassport extends site_controller{
	
	public function __construct(&$app){
		parent::__construct($app);
		//后面还需要什么............
	}
	
	/**
	 * action 入口
	 */
	public function index(){
		$this->check_login();
		$this->login();
	}
	
	
	/**
	 * 检测登陆状态
	 */
	public function check_login(){
		//vmc::singleton('buyer_user_passport')->check();
		//vmc::service('cc')->check();
		$mdl_buyers = $this->app->model('buyers');
		var_dump($mdl_buyers->get_buyer_account('sunjunfengc@163.com'));
		exit;
		if ($_POST){
			
			//这边定义的买手店登陆$_post['username'];
			
			
		}else {
			
		}
		return true;
		return false;
		
	}
	
	
	/**
	 * 登入
	 */
	public function login(){
		
		//再次检测
		//model操作等等
		//页面传参
		
		$this->page('buyer/passport/login.html');
		
	}
	
	
	/**
	 * 买手店注册
	 * @param unknown $forward
	 */
	public function signup($forward){
		$this->title = '注册成为买手店';
		//检查是否登录，如果已登录则直接跳转到会员中心
		//这个是否需要
		$this->check_login();
		$this->set_forward($forward); //设置登录成功后跳转
		
		if ($_POST){
			$this->_signup($_POST, $forward);
		}
		
		switch ($forward){
            case '1':
                $tpl = 'xxx';
                break;
            case '2':
                $tpl = 'xxx';
                break;
            case '3':
                $tpl = 'xxx';
                break;
            default:
                $tpl = 'xxx';
                break;
        }
        $this->page('site/passport/' . $tpl . '.html');
        
	}
	
	/**
	 * 注册步骤
	 * @param unknown $post
	 * @param unknown $forward
	 */
	private function _signup($post, $forward){
		$redirect = $this->gen_url(array(
				'app' => 'buyer',
				'ctl' => 'site_passport',
				'act' => 'signup',
				'args' => array($forward),
		));
		$return = false;
		switch ($forward){
			
		}
		
	}
	
	
	/**
	 * 检测用户名
	 * 用户名格式错误或者长度超过要求
	 * 用户名已经被注册过了
	 */
	public function check_login_name(){
		
	}
	
	
	/**
	 * 前台手机号检测
	 * 判断是否填写为空或者格式错误或者错误手机号
	 * 判断是否已经使用或者黑名单等等
	 */
	public function is_exists_mobile(){
		
	}
	
	
	/**
	 * 发送短信验证码
	 */
	public function send_vcode_sms(){
		//这个是否用到reids或者KVStore 确定临时存储时间
		
	}
	
	
	/**
	 * 验证码
	 */
	public function vcode_verify(){
	
	}
	
	
	/**
	 * 重置密码
	 * 可能用户已经注册，但是忘记了密码
	 * 忘记密码必须重新验证信息方可重置
	 */
	public function reset_password(){
		
	}
	
	
	/**
	 * 退出登陆
	 */
	public function logout(){
		
	}
	
	
}