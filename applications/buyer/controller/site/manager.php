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
	public function index($page=1){
		$limit = 5;

		$model_freeze = app::get('freeze')->model('freeze');
		$object_obj = vmc::singleton('buyer_user_object');
		$buyer_id = $object_obj->get_id();

		$freeze_list = $model_freeze->getList('*',array('buyer_id' => $buyer_id,'code|noequal'=>''),($page - 1) * $limit, $limit);
		$count = $model_freeze->count(array('buyer_id' => $buyer_id));

		$this->pagedata['pager'] = array(
			'total' => ceil($count / $limit),
			'current' => $page,
			'link' => array(
				'app' => 'buyer',
				'ctl' => 'site_manager',
				'act' => 'index',
				'args' => array(
					($token = time()),
				),
			),
			'token' => $token,
		);
		$this->pagedata['list'] = $freeze_list;
		$this->output('');
	}
	
	
	/**
	 * 管家注册（有下一步）
	 */
	public function signup(){
		//处理冻品管家登录账号
		$object_obj = vmc::singleton('buyer_user_object');
		$buyer_id = $object_obj->get_id();
		$account_name = app::get('freeze')->model('freeze')->get_account($buyer_id);

		$this->pagedata['account_name'] = $account_name;
		$this->output('');
	}
	



	/**
	 * 所有业绩列表（里面加的有查询和js）
	 */
	public function feat(){
		$this->output('');
	}
	
	
}