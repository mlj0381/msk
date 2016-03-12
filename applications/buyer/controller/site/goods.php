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
 * 买手店商品管理类
 * @author Administrator
 *
 */
class buyer_ctl_site_goods extends buyer_frontpage{
	
	public function __construct(&$app){
		parent::__construct($app);
		//后面还需要什么............
	}
	
	
	public function index(){
		
	}
	
	/**
	 * 获取买手店已经购买的商品
	 * @param number $page 页码
	 * @param unknown $good_keyword 商品关键字搜索
	 * @param unknown $order_id 订单ID搜索
	 */
	public function get_goods_list($page=1, $good_keyword, $order_id){
		//return list 
		
	}
	
	
	/**
	 * 为前台页面添加需要分销的商品
	 * @param unknown $goods_list 暂时规定商品为list
	 * 
	 */
	public function add_sales_goods($goods_list = array()){
		//注意，只有自己有的商品才能够作为分销产品
		//model操作  判断是不是你的商品
	}
	
	
	/**
	 * 删除分销商品(同上面方法一致)
	 * @param unknown $goods_list
	 */
	public function del_sales_goos($goods_list = array()){
		
	}
	
	
	
	
	
	
	
	
}