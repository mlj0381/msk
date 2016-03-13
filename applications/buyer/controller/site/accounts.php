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
 * 买手店结算类
 * @author Administrator
 *
 */
class buyer_ctl_site_accounts extends buyer_frontpage{
	
	public function __construct(&$app){
		parent::__construct($app);
		//后面还需要什么............
	}
	
	
	public function index(){
		
	}
	
	
	/**
	 * 已经结算+未结算
	 */
	
	/**
	 * 已经结算+未结算信息展示
	 * 
	 * @param unknown $account_type
	 */
	public function account($account_type){
		//这个需要是否配置在config中
		//结算1  未结算2
	}
	
	
	/**
	 * 获取商品对应库存量
	 * @param unknown $goodsid
	 */
	public function get_inventory_count($goodsid){
		//验证商品是否存在在该买手店里面
	}
	
	
	
// 	//这个是否需要修改库存量????????????????????????????
	
// 	/**
// 	 * 修改商品库存量
// 	 * @param unknown $goodsid
// 	 */
// 	public function edit_inventory_count($goodsid){
// 		//验证商品是否存在在该买手店里面
		
// 	}
	
	
	/**
	 * 验证商品是否存在在该买手店里面
	 */
	public function check_goodsid_to_buyer(){
		return true;
		return false;
		//return count
	}
	
	
	
	
}