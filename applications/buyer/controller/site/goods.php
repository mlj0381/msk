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
 * 买手店商品管理类
 * @author Administrator
 *
 */
class buyer_ctl_site_goods extends buyer_frontpage{
	
	public function __construct(&$app){
		parent::__construct($app);
		$this->verify_buyer();
		//后面还需要什么............
	}
	
	
	/**
	 * 出货管理
	 */
	public function index(){
		
		$this->output();
	}
	
	
	/**
	 * 订单详情（单个订单的详情）
	 */
	public function order_details(){
		$this->output();
	}
	
	
	/**
	 * 已购买商品(订单管理)
	 */
	public function stock($status = 'all', $page = 1){
		$order_list = array(
			0 => array(''),
				
				
				
		);
		$this->pagedata['order_list'] = $order_list;
		$this->pagedata['current_status'] = $status;
		$this->pagedata['pager'] = array(
				'current' => $page,
				'link' => array(
						'app' => 'buyer',
						'ctl' => 'site_goods',
						'act' => 'stock',
						'args' => array(
								$status,
								($token = time()),
						),
				),
		);
		$this->output();
	
	}
	
	/**
	 * 库存管理
	 */
	public function repertory(){
		$this->output();
	}
	
	
	/**
	 * 订单回收站
	 */
	public function stock_trash(){
		$this->output();
	}
	
	
	/**
	 * 删除订单
	 * @param unknown $goods_id
	 */
	public function del($goods_id){
		echo '订单号'.$goods_id;
	}
	
	//////////////////走 b2c
	/**
	 * 去付款
	 * @param unknown $goods_id
	 */
	public function payment($goods_id){
		$this->output();
	}
	
	//////////////////走 b2c
	/**
	 * 订单详情
	 * @param unknown $goods_id
	 */
	public function detail($goods_id){
		$this->output();
	}
	
	
}