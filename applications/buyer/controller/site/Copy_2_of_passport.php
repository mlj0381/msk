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
class buyer_ctl_site_passport extends buyer_frontpage{
	
	public function __construct(&$app){
		parent::__construct($app);
		$this->passport_obj = vmc::singleton('buyer_user_passport');
		//后面还需要什么............
	}
	
	public function index(){
		$this->check_login();
		$this->login();
	}
	
	/**
	 * 成功页面跳转
	 */
	public function success(){
		echo 'success';exit;
		$this->page('site/passport/success.html');
	}
	
	
	/**
	 * 验证login
	 * @return boolean
	 */
	public function check_login(){
		$is_login = vmc::singleton('buyer_user_passport')->is_login();
		if (0 < $is_login){
            $redirect = $this->gen_url(array(
                'app' => 'buyer',
                'ctl' => 'site_buyer',
                'act' => 'index',
            ));
            $this->splash('success', $redirect, '已经是登陆状态！');exit;
        }
		return false;
	}
	
	/**
	 * 登陆页面
	 */
	public function login(){	
		$this->check_login();
		
		if ($_POST){
			$params = utils::_filter_input($_POST);
			unset($_POST);
			if (empty($params['vcode'])){
				$this->splash('error', '', '验证码不能为空!');
			}
			if (!base_vcode::verify('passport', $params['vcode'])){
				$this->splash('error', '', '验证码错误！');
			}
			
			$username = $params['uname'];
			$password = $params['password'];
			$mdl_buyers = $this->app->model('buyers');
			//获取buyer_id,account/buyer_uname,给出要显示的账号（用户名or手机号orEmail）
			$userdata = $mdl_buyers->get_buyer_account($username);
			if (!$userdata){
				$this->splash('error', '', '用户名不存在！');
			}
			$check_password = $this->app->model('buyers')->check_password($userdata['buyer_id'], $password);
			
			if ($check_password){
				$this->app->model('buyers')->autologin($userdata);
				$this->set_cookie('UNAME', $userdata['account']);
				$this->set_cookie('SELLER_IDENT', $userdata['buyer_id']);	
				
				$redirect = $this->gen_url(array(
						'app' => 'buyer',
						'ctl' => 'site_buyer',
						'act' => 'index',
				));
				$this->splash('success', $redirect, '登陆成功！');
			}else {
				//这个需要给login页面还是false
				$redirect = $this->gen_url(array(
						'app' => 'buyer',
						'ctl' => 'site_passport',
						'act' => 'login',
				));
				$this->splash('error', $redirect, '用户名或者密码错误！');
			}
		}else {
		
			$this->set_tmpl('passport');
			$this->page('site/passport/login.html');
		}

		
	}
	
	
	
	
	/**
	 * 检测登陆状态
	 */
// 	public function check_login(){
// 		//vmc::singleton('buyer_user_passport')->check();
// 		//vmc::service('cc')->check();
// 		$mdl_buyers = $this->app->model('buyers');
// 		var_dump($mdl_buyers);exit;
// 		var_dump($mdl_buyers->get_buyer_account('sunjunfeng@163.com'));
// 		exit;
// 		if ($_POST){
			
// 			//这边定义的买手店登陆$_post['username'];
			
			
// 		}else {
			
// 		}
// 		return true;
// 		return false;
		
// 	}
	
	
	
	
	/**
	 * 买手店注册
	 * @param unknown $forward
	 */
	public function signup(){
		vmc::singleton('base_session')->start();
		$forward = $this->app->model('buyers')->get_schedule($_SESSION['buyer_auth']['buyer_id']);
		
		switch ($forward){
			case '1':
				$tpl = 'signup_baseInfo';
				break;
			case '2':
				$tpl = 'signup_complete';
				break;
			default:
				$tpl = 'signup_buyerInfo';
				break;	
		}
		$this->set_tmpl('passport');
        $this->page('site/passport/' . $tpl . '.html');
        
	}
	
	/**
	 * 注册步骤
	 * @param unknown $post
	 * @param unknown $forward
	 */
	public function _signup(){
		$params = utils::_filter_input($_POST);
		unset($_POST);
		$this->check_login_name($params['login_name']);
		if ($params['login_password'] != $params['psw_confirm']){
			$this->splash('error', '', '两次填写密码不一致');
		}
		$this->is_exists_mobile($params['mobile']);
		$this->signup();
		
	}
	
	
	/**
	 * 买手店注册
	 * @param unknown $post
	 * @param unknown $signup_url
	 */
	private function _signup_account($post, $signup_url){
		//复用这个方法=====》》》》》》is_exists_mobile
		
	}
	
	/**
	 * 检测用户名
	 * 用户名格式错误或者长度超过要求
	 * 用户名已经被注册过了
	 */
	public function check_login_name($checkuname){
		$mdl_buyer = $this->app->model('buyers');
		$buyer_data = $mdl_buyer->get_buyer_account($checkuname);
		if ($buyer_data){
			$this->splash('error', '', '用户名存在');
		}else {
			return ;
		}
	}
	
	
	/**
	 * 前台手机号检测
	 * 判断是否填写为空或者格式错误或者错误手机号
	 * 判断是否已经使用或者黑名单等等
	 */
	public function is_exists_mobile($mobile = NULL){
		if ($mobile == null){
			$mobile = $_POST['mobile'];
		}
		if (empty($mobile)){
			$this->splash('error', '', '手机号不能为空');
		}
		
		$mobile_type = vmc::singleton('buyer_user_passport')->get_login_account_type($mobile);
		if($mobile_type != 'mobile'){
			$this->splash('error', '', '请填写正确的手机号');
		}
		
		$is_register_mobile = $this->app->model('buyers')->is_exists_mobile($mobile);
		if($is_register_mobile){
			$this->splash('error', '', '该手机号已被使用');
		}
		
	}
	
	
	/**
	 * 发送短信验证码
	 */
	public function send_vcode_sms($type = 'signup'){
		//这个是否用到reids或者KVStore 确定临时存储时间

		$mobile = trim($_POST['mobile']);
		
		if (!$this->passport_obj->check_signup_account($mobile, $msg)) {
			$this->splash('error', null, $msg);
		}
		if ($msg != 'mobile') {
			$this->splash('error', null, '错误的手机格式');
		}
		$uvcode_obj = vmc::singleton('buyer_user_vcode');
		$vcode = $uvcode_obj->set_vcode($mobile, $type, $msg);
		$this->splash('success', $vcode, '短信已发送');
		if ($vcode) {
			//发送验证码 发送短信
			$data['vcode'] = $vcode;
			if (!$uvcode_obj->send_sms($type, (string)$mobile, $data)) {
				$this->splash('error', null, '短信发送失败');
			}
		} else {
			$this->splash('failed', null, $msg);
		}
		$this->splash('success', null, '短信已发送');
		
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
	public function logout($forward){
		vmc::singleton('base_session')->start();
		$_SESSION['buyer_auth']			=	null;
		$_SESSION['buyer_auth_sign']	=	null;
		$_COOKIE['UNAME']				=	null;
		if (!$forward) {
			$forward = $this->gen_url(array(
					'app' => 'buyer',
					'ctl' => 'site_passport',
					'full' => 'login',
			));
		}
		$this->splash('success', $forward, '退出登录成功');
	}
	
	/**
	 * 请求接口
	 * 商家入驻第一步通过以后的API
	 * 给用户注册以后选择买手店等四种类型的时候请求
	 */
	public function get_request(){
		$method = strtolower($_SERVER['REQUEST_METHOD']);
		if ($method == 'post'){
			$request_data = file_get_contents('php://input');
			if ($request_data == JSON_ERROR_NONE){
				$filter_data = strtr(trim($request_data), array("\r"=>'',"\n"=>''));
				$arr_data = json_decode($filter_data, TRUE);
				if ($arr_data['password'] == $arr_data['psw_confirm'] && $arr_data['login_name'] && $arr_data['mobile'] && $arr_data['password']){
					$check_exist_name	=	$this->app->model('buyers')->get_buyer_account($arr_data['login_name']);
					$check_exist_mobile	=	$this->app->model('buyers')->get_buyer_account($arr_data['mobile']);
					if ($check_exist_name == FALSE && $check_exist_mobile == FALSE){
						$login_type = vmc::singleton('buyer_user_passport')->get_login_account_type($arr_data['login_name']);
						$buyer_data['account']	=	$arr_data['login_name'];
						switch ($login_type){
							case 'local':
								break;
							case 'email':
								$buyer_data['email']	=	$arr_data['login_name'];
								break;
							case 'mobile':
								$buyer_data['mobile']	=	$arr_data['login_name'];
								break;
							default:
								return ;
							}
						$buyer_data['regtime'] = $buyer_data['updatetime'] = time();
						$db = vmc::database();
						$db->beginTransaction();
						//这个插入pam_buyers表
						$check_data['login_account']	=	$buyer_pm_data['login_account']	=	$buyer_data['account'];
						$buyer_pm_data['login_type']	=	$login_type;
						$check_data['createtime']		=	$buyer_pm_data['createtime']	=	time();
						$check_data['login_password']	=	$arr_data['password'];
						$buyer_pm_data['login_password']=	pam_encrypt::get_encrypted_password($arr_data['password'], 'buyer',$check_data);
						if (!$this->app->model('buyers')->save($buyer_data)){
							$db->rollback();
						}
						$buyer_pm_data['buyer_id']	=	$buyer_data['buyer_id'];
						if (!app::get('pam')->model('buyers')->save($buyer_pm_data)){
							$db->rollback();
						}
						$db->commit();
					}
				}
			}
		}
	}
	
	
	
}