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
		$this->buyer_id = vmc::singleton('buyer_user_object')->get_id();
		$this->member_id = vmc::singleton('buyer_user_object')->get_session()['member'];
		//后面还需要什么............
	}
	
	
	public function index(){
		$this->pagedata['data'] = $this->app->model('buyers')->getRow('*',array('buyer_id'=>$this->buyer_id));
		$this->output();
	}
	
	
	/**
	 * 买手店信息
	 * 包括信息修改、绑定和保存
	 */
	public function buyer_info($action = false){
		//用户名、手机号、邮箱、主销品类（选择的列表）
		//负责人信息->姓名、手机号、邮箱、身份证、身份证照片、QQ、微信
		//绑定手机号修改邮箱
		
		$this->menuSetting = 'account';
		//$buyer_id = vmc::singleton('buyer_user_object')->get_session();
		if ($action == 'update' && $_POST){
			$redirect = $this->gen_url(array(
					'app' => 'buyer',
					'ctl' => 'site_buyer',
					'act' => 'buyer_info',
			));
			$params = utils::_filter_input($_POST);
			unset($_POST);
			
			/**
			 * 更新店铺信息---也即是调用编辑buyer基本信息接口
			 * 
			 */

			$data = app::get('pam')->model('members')->getRow('login_account,login_password,password', array('member_id'=>$this->member_id));
			$basic_data = $this->app->model('buyers')->getRow('*', array('buyer_id'=>$this->buyer_id));
			if ($this->app->model('buyers')->update($params, array('buyer_id' => $this->buyer_id))){
				if ($this->app->model('buyers')->getRow('buyer_code', array('buyer_id' => $this->buyer_id))['buyer_code']){
					$this->rpc_update_data($params);
				}else {
					$region = $basic_data['area'];
					$area_result = app::get('ectools')->model('regions')->region_decode($region);
					$request = array(
							'slAccount'=>array(
									'login_account'	=>$data['login_account'],
									'phone'		=>$basic_data['mobile'],
									'local'			=>$basic_data['local'],
									'name'			=>$basic_data['name'],
									'password'		=>$data['password'],
									'authStatus'	=>2,
							),
							'slSeller'=>array(
									'login_account'	=>$data['login_account'],
									'slConFlg'		=>'1',//生产国籍
									'areaCode'		=>'1',//大区编码
									'lgcsAreaCode'	=>$area_result['province']['code'] ?: '09',//物流区编码
									'provinceCode'	=>$area_result['province']['code'] ?: '09',//省编码
									'cityCode'		=>$area_result['city']['code'] ?: '09',//地区编码
									'districtCode'	=>$area_result['district']['code'] ?: '09',//区编码
									'slMainClass'	=>4,//卖家主分类
									'snkFlg'		=>'0',//神农客标志
									'selfFlg'		=>'0',//自产型卖家标志
									'agentFlg'		=>'0',//代理型卖家标志
									'oemFlg'		=>'0',//OEM型卖家标志
									'buyerFlg'		=>'1',//买手型卖家标志
							),
							'slBuyerShop'=>array(
									'card_id'	=>$basic_data['card_id'],
									'slSort'	=>2,
									'addr'		=>$basic_data['addr'],
									'flag1'		=> $params['sex']==1 ?'0':'1',
							),
							'slShopInfo'=>array(
									'store_name'=>$params['store_name'],
									'store_logo'=>$params['store_logo'],
									'managingCharact1'=>$params['operate_feature'],
							),
					);
				}
				$this->app->rpc('edit_buyer_info')->request($request, false);
				$buyer_info_response = $this->app->rpc('select_buyer_info')->request($data, false);
				if ($buyer_code = $buyer_info_response['result']['buyershopList'][0]){
					app::get('pam')->model('buyers')->update(array('buyer_code'=>$buyer_code['buyer_code']), array('buyer_id'=>$this->buyer_id));
					$this->app->model('buyers')->update(array('buyer_code'=>$buyer_code['buyer_code'], 'api_buyer_id'=>$buyer_code['buyer_codedis'], 'shop_id'=>$buyer_code['shop_id']), array('buyer_id'=>$this->buyer_id));
				}
				$this->splash('success', $redirect, '店铺信息更新成功！');
			}else {
				$this->splash('error', $redirect, '店铺信息更新失败！');
			}	
		}
		$this->pagedata['buyer_info'] = $this->app->model('buyers')->getRow('*', array('buyer_id' => $this->buyer_id));	
		$this->output();
	}
	
	
	/**
	 * 密码修改
	 */
	public function reset_password(){
		//echo '修改密码->旧密码-新密码-确认新密码';
		if ($_POST){
			$redirect = $this->gen_url(array(
					'app' => 'buyer',
					'ctl' => 'site_buyer',
					'act' => 'reset_password',
			));
			$params = utils::_filter_input($_POST);
			unset($_POST);
			if ($params['new_password'] != $params['confirm_password']){
				$this->splash('error', $redirect, '两次输入的新密码不一致！');
			}			
			/***
			 * 修改密码----调用buyer查询和编辑接口
			 */
			$status = $this->app->model('buyers')->reset_password($this->member_id, $params['old_password'],$params['new_password']);
			switch ($status){
				case 'success':
					$msg = '新密码设置成功！';
					break;
				case 'no':
					$msg = '新密码设置失败！';
					break;
				case 'error':
					$msg = '旧密码输入错误！';
					break;
			}
			$this->splash(($status == 'no') ? 'error' :$status, $redirect, $msg);
			
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
	public function basic_info($action = false){
		$this->menuSetting = 'account';
		//$buyer_id = vmc::singleton('buyer_user_object')->get_session();
		
		/**
		 * 编辑buyer基本信息接口
		 * 
		 * 
		 */
		if ($action == 'update' && $_POST){
			$redirect = $this->gen_url(array(
					'app' => 'buyer',
					'ctl' => 'site_buyer',
					'act' => 'basic_info',
			));
			$params = utils::_filter_input($_POST);
			unset($_POST);
			if(strlen($params['card_id']) != 18){
				$this->splash('error', $redirect, '身份证填写错误！');
			}
			if (strlen((int)$params['qq']) < 5 && strlen((int)$params['qq'] >13)){
				$this->splash('error', $redirect, 'QQ号格式或位数错误！');
			}
			if ($this->app->model('buyers')->update($params, array('buyer_id' => $this->buyer_id))){
				if ($this->app->model('buyers')->getRow('buyer_code', array('buyer_id' => $this->buyer_id))['buyer_code']){
					$this->rpc_update_data($params);
				}
				$this->splash('success', $redirect, '基本信息更新成功！');
			}else {
				$this->splash('error', $redirect, '基本信息更新失败！');
			}	
		}
		
		/***
		 * 查询buyer基本信息接口
		 * 
		 */
		$this->pagedata['basic_info'] = $this->app->model('buyers')->getRow('*', array('buyer_id' => $this->buyer_id));
		$this->pagedata['login'] = app::get('pam')->model('members')->getRow('login_account',array('member_id' => $this->member_id));
		$this->output();
	}
	
	
	/**
	 * 修改手机
	 */
	public function update_mobile(){
		$this->menuSetting = 'account';
		$this->pagedata['info'] = $this->app->model('buyers')->getRow('local,mobile', array('buyer_id' => $this->buyer_id));
		$this->output();
	}
	
	
	/**
	 * 修改email
	 */
	public function update_email(){
		$redirect = $this->gen_url(array('app'=>'buyer', 'ctl'=>'site_buyer', 'act'=>'update_email'));
		if ($_POST){
			$params = utils::_filter_input($_POST);
			unset($_POST);
			if ($params['old_email'] == $params['email']) {
				$this->splash('error', $redirect, '原始邮箱和新邮箱一致，无需修改！');
			}
			if (!$this->app->model('buyers')->getRow('email', array('email'=>$params['email']))){
				$this->app->model('buyers')->update($params,array('buyer_id'=>$this->buyer_id));
				$this->rpc_update_data($params);
				$this->splash('success', $redirect, '新邮箱修改成功！');
			}else {
				$this->splash('error', $redirect, '你的新邮箱已经被注册！');
			}
		}
		$this->pagedata['buyer_info'] = $this->app->model('buyers')->getRow('email', array('buyer_id' => $this->buyer_id));
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
	
	public function rpc_update_data($update_params){
		$data = app::get('pam')->model('members')->getRow('login_account,login_password,password', array('member_id'=>$this->member_id));
		$basic_data = $this->app->model('buyers')->getRow('*', array('buyer_id'=>$this->buyer_id));
		$params = array_merge($data, $basic_data);
		$region = $basic_data['area'];
		$area_result = app::get('ectools')->model('regions')->region_decode($region);
		$request = array(
				'slAccount'=>array(
						'buyer_code'	=>$params['buyer_code'],
						'login_account'	=>$params['login_account'],
						'phone'		=>$params['phone'],
						'local'			=>$update_params['local'] ?:$params['local'],
						'name'			=>$update_params['name'] ?:$params['name'],
						'password'		=>$params['password'],
						'authStatus'	=>2,
				),
				'slSeller'=>array(
						'buyer_code'	=>$params['buyer_code'],
						'login_account'	=>$params['login_account'],
						'slConFlg'		=>'1',//生产国籍
						'areaCode'		=>'1',//大区编码
						'lgcsAreaCode'	=>$area_result['province']['code']?:'01',//物流区编码
						'provinceCode'	=>$area_result['province']['code']?:'01',//省编码
						'cityCode'		=>$area_result['city']['code']?:'01',//地区编码
						'districtCode'	=>$area_result['district']['code']?:'01',//区编码
						'slMainClass'	=>4,//卖家主分类
						'snkFlg'		=>'0',//神农客标志
						'selfFlg'		=>'0',//自产型卖家标志
						'agentFlg'		=>'0',//代理型卖家标志
						'oemFlg'		=>'0',//OEM型卖家标志
						'buyerFlg'		=>'1',//买手型卖家标志
						'qq'			=>$params['qq'] ?:$update_params['qq'],
						'wechat'		=>$params['wechat'] ?:$update_params['wechat'],
						'email'			=>$params['email'] ?:$update_params['email'],
				),
				'slBuyerShop'=>array(
						'buyer_code'	=>$params['buyer_code'],
						'card_id'	=>$params['card_id'],
						'slSort'	=>2,
						'addr'		=>$params['addr'] ?:$update_params['addr'],
						'flag1'		=> $params['sex']==1 ?'0':'1',
				),
				'slShopInfo'=>array(
						'buyer_code'	=>$params['buyer_code'],
						'shop_id'		=>$params['shop_id'],
						'store_name'	=>$params['store_name'] ?:$update_params['store_name'],
						'store_logo'	=>$params['store_logo'] ?:$update_params['store_logo'],
						'managingCharact1'=>$params['operate_feature'],
				),
					
		);
		$this->app->rpc('edit_buyer_info')->request($request, false);
		
	}
	
}