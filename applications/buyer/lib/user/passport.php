<?php

// +----------------------------------------------------------------------
// | Date: 2016-3-9 上午11:30:41		start
// +----------------------------------------------------------------------
// | Author: sunjunfeng
// +----------------------------------------------------------------------
// | Action: 买手店登陆流程和逻辑处理
// +----------------------------------------------------------------------
// | Version: 
// +----------------------------------------------------------------------

class buyer_user_passport{
	
	public function __construct(&$app){
		vmc::singleton('base_session')->start();
	}
	
	
	/**
	 * 获取前台登录用户类型(用户名,邮箱，手机号码)
	 * @param unknown $login_account 登录账号
	 * @return string
	 */
	public function get_login_account_type($login_account){
		$login_type = 'local';
		if ($login_account && strpos($login_account, '@')) {
			$login_type = 'email';
			return $login_type;
		}
		if (preg_match('/^1[34578]{1}[0-9]{9}$/', $login_account)) {
			$login_type = 'mobile';
			return $login_type;
		}
		
		return $login_type;
	}
	
	
	/**
	 * 数据签名认证
	 * @param array $data		被认证的数据
	 * @return string				签名
	 */	
	public function data_auth_sign($data){
		/*数据类型检测*/
		if (!is_array($data)){
			$data = (array)$data;
		}
		ksort($data);	//排序
		$code	=	http_build_query($data);	//url编码并生产query字符串
		$sign	=	sha1($code);	//生成签名
		return $sign;
		
	}
	
	public function is_login(){
		$user = $_SESSION['buyer_auth'];
		if (empty($user)){
			return 0;
		}else {
			return $_SESSION['buyer_auth_sign'] == $this->data_auth_sign($user) ? $user['buyer_id'] : 0;
		}
		
	}
	
	
	/**
	 * 验证用户合法性
	 * @param unknown $login_name
	 * @param unknown $msg
	 */
	public function check_signup_account($login_name, &$msg){
		
	}
	
	
	/**
	 * 检查用户提交信息合法性
	 * @param unknown $data
	 * @param unknown $msg
	 */
	public function check_signup($data, &$msg){
		
	}
	
	
	
}