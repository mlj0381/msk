<?php
class base_user_object{
	
	public $app_id; 		//APP ID
	public $pk_id; 			//主键ID
	public $pam_table;  	//登入信息表名
	public $account_table;	//用户表名

	public function __construct(&$app){
		//如果有自动登录，设置session过期时间，单位：分
		vmc::singleton('base_session')->start();
	
		$this->app_id 		 = $app->app_id === 'b2c' ? 'member' : $app->app_id;
		$this->pk_id 		 = $this->get_session()[$this->app_id . '_id']?:0 ; 
		$this->pam_table 	 = $this->app_id . 's';
		$this->account_table = $this->app_id . 's';

		if($_COOKIE['AUTO_LOGIN']){
			$minutes = 7*24*60;//7天
			vmc::singleton('base_session')->set_sess_expires($minutes);
			vmc::singleton('base_session')->set_cookie_expires($minutes);
			$this->cookie_expires = $minutes;
		}
		
		
	}	
	
	/**
	 * 检查是否登入
	 * @return boolean 
	 */
	public function is_login(){
	
		if($this->get_session())
			return true;
		else
			return false;
	}
	
	/**
	 * 获取登入账户的ID
	 * @return array || boolean
	 */
	public function get_id(){
		return $_SESSION['account'][$this->app_id . '_id'] ?: false;
	}
	
	/**
	 * 获取会员登录session seller_id
	 * @return array || boolean
	 */
	public function get_session(){
		if($_SESSION['account'][$this->app_id . '_id']){
			return $_SESSION['account'];
		}else{
			return false;
		}
	}

	/**
	 * 设置会员登录session seller_id
	 * @return null
	 */
	public function set_session($data){
		$_SESSION['account'] = [
				 $this->app_id . '_id' => $data[$this->app_id . '_id']
		];
	}
	/**
	 * 查询用户的扩展信息和账户信息
	 * @return array
	 */
	public function get_info(){
		$data = array();
		/* 查询扩展信息 */
		$user_model 		= app::get($this->app_id)->model($this->account_table);
		$data['account']	= $user_model->getRow('*',array( $this->app_id . '_id' => $this->pk_id ));
		/* 查询账户信息 */
		$pam_user_model 	= app::get('pam')->model($this->pam_table);
		$data['pam'] 		=  $pam_user_model->getRow('*',array( $this->app_id . '_id' => $this->pk_id ));
		return $data;
	}
	
	
	
	
	
	
	
	
}