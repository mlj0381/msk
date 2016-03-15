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

class buyer_mdl_buyers extends dbeav_model{
	
	/**
	 * 查询出buyer_id
	 * 通过用户名、手机号、email做判断然后查询buyer_id
	 * @param unknown $username
	 * @return void|number (int)
	 */
	public function  get_buyer_account($username){
		$login_type = vmc::singleton('buyer_user_passport')->get_login_account_type($username);
		if ($login_type){
			$where['login_type']		=	$login_type;
			$where['login_account']		=	$username;
			$where['type']		=	1;
			$date = app::get('pam')->model('sellers')->getRow('seller_id',$where);
			if ($date){
				$date['buyer_id'] = (int)$date['seller_id'];
				$date['login_account'] = $username;
			}
			return $date;
		}
	}
	
	//验证密码的
	public function check_password($buyer_id, $password){
		$mdl_pm_buyers = app::get('pam')->model('sellers');
		$check_data = $mdl_pm_buyers->getRow('login_account,createtime,password_account,login_password',array('seller_id'=>$buyer_id));
		$use_pass_data['login_name'] = $check_data['password_account'];
		$use_pass_data['createtime'] = $check_data['createtime'];
		if ($check_data['login_password'] == pam_encrypt::get_encrypted_password($password, 'seller',$use_pass_data)){
			return true;
		}else {
			return false;
		}
	}
	
	
	/**
	 * 登陆成功处理机制buyer_id,account/buyer_uname
	 * @param unknown $userdata  buyer_id,mobile
	 */
	public function autologin($userdata){
		//这里是否需要修改最后一次登陆IP
		//是否需要最后一次登陆时间
		vmc::singleton('base_session')->start();
		$mdl_pm_buyers = app::get('pam')->model('sellers');
		$createtime = $mdl_pm_buyers->getRow('createtime',array('seller_id'=>$userdata['buyer_id']));
		$auth = array(
			'buyer_id'		=>	$userdata['buyer_id'],
			'account'		=>	$userdata['login_account'],
			'createtime'	=>	(int)$createtime['createtime'],
		);
		$_SESSION['buyer_auth']			=	$auth;
		$_SESSION['buyer_auth_sign']	=	vmc::singleton('buyer_user_passport')->data_auth_sign($auth);
		
	}
	
	/**
	 * 买手店数据插入到数据库
	 * @param unknown $data
	 */
	public function save_buyer_data($request){
		//获取用户注册信息
		$log_data = app::get('pam')->model('sellers')->getRow('login_account,login_type,createtime',array('seller_id'=>$request['buyer_id']));
		
		//这个判断数据库表buyer_buyers是否存在buyer_id对应的记录
		if ($this->app->model('buyers')->getRow('buyer_id',array('buyer_id'=>$request['buyer_id']))){
			return false;
		}
		$request[$log_data['login_type']] = $log_data['login_account'];
		$request['sex'] = (int)$request['sex'];
		$request['buyer_type'] = (int)$request['buyer_type'];
		$request['area'] = $request['consignor']['area'];
		$request['regtime'] = $request['createtime'] = $log_data['createtime'];
		if ($this->app->model('buyers')->save($request)){
			vmc::singleton('base_session')->start();
			$_SESSION['account'] = NULL;
			$userdata = array(
				'buyer_id' => $request['buyer_id'],
				'login_account' => $log_data['login_account'],
			);
			$this->autologin($userdata);
			return TRUE;
		}
		return FALSE;
		
	}
	
	
	
	public function get_schedule($buyer_id){
		$data = $this->getRow('schedule',array('buyer_id' => (int)$buyer_id));
		return  $data['schedule']; 
	}
	
	public function is_exists_mobile($mobile){
		return $this->getRow('buyer_id',array('mobile'=>trim($mobile)));
	}
	
	public function reset_password($user_id,$old_password,$new_password){
		$mdl_pm_sellers = app::get('pam')->model('sellers');
		$check_data = $mdl_pm_sellers->getRow('login_account,createtime,password_account,login_password',array('seller_id'=>$user_id));
		
		$use_pass_data['login_name'] = $check_data['password_account'];
		$use_pass_data['createtime'] = $check_data['createtime'];
		if (pam_encrypt::get_encrypted_password($old_password, 'seller',$use_pass_data) == $check_data['login_password']){
			$reset['login_password'] = pam_encrypt::get_encrypted_password($new_password, 'seller',$use_pass_data);
			if ($mdl_pm_sellers->update($reset,array('seller_id'=>$user_id))){
				vmc::singleton('base_session')->start();
				vmc::singleton('buyer_user_object')->set_session();
				//修改成功
				return 'success';
			}else {
				//修改失败
				return 'no';
			}
		}else {
			//旧密码错误
			return 'error';
		}
		
		
	}
	
	
}