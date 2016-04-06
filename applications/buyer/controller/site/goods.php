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
		$this->buyer_id = vmc::singleton('buyer_user_object')->get_session();
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
	 * 销售商品订单(订单管理)
	 */
	public function stock($current_status = 'all', $page = 1){
		$limit = 5;
		if (!in_array($current_status,array('all','2','8'))){
			$order_list = null;
		}else {
			$rpc_model = $this->app->rpc('get_orders_list');
			$data = array(
					'buyersId'	=>'BI01',
					'buyersCode'=>'BC01',
			);
			$response = $rpc_model->request($data, 2);

			if ($current_status == 'all' or empty($current_status)){
				if (!empty($_POST['search'])){
					foreach ($response['result']['orders'] as $k=>$v){
						if ($v['orderCode'] == $_POST['search']){
							$order_list[$k] = $response['result']['orders'][$k];
						}
					}
				}else {
					$order_list = $response['result']['orders'];
				}
			}else {
				foreach ($response['result']['orders'] as $k=>$v){
					if ($v['orderStatus'] == $current_status){
						$order_list[$k] = $response['result']['orders'][$k];
					}
				}
			}
			$list = array_slice($order_list, ($page-1)*$limit, $limit);
		}

		is_array($list) and array_walk($list,function(&$v,$k){
			$v['pay_status'] = self::$_pay_list[$v['orderStatus']];
		});
		$this->pagedata['order_list'] = $list;
		$this->pagedata['current_status'] = $current_status;
		$this->pagedata['search'] = $_POST['search'];
		$this->pagedata['pager'] = array(
				'total' => ceil(count($order_list) / $limit),
				'current' => $page,
				'link' => array(
						'app' => 'buyer',
						'ctl' => 'site_goods',
						'act' => 'store',
						'args' => array($current_status,($token = time())),
						),
				'token' => $token,
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
		$rpc_model = $this->app->rpc('get_orders_list');
		$data = array(
				'buyersId'	=>'BI01',
				'buyersCode'=>'BC01',
		);
		$response = $rpc_model->request($data, 2);
		$detail = utils::array_change_key($response['result']['orders'], 'orderId')[$goods_id];
		$detail['pay_status'] = self::$_pay_list[$detail['orderStatus']];
		$detail['count_goods'] = count($detail['orderDetail']);
		$this->pagedata['detail'] = $detail;
		$this->output();
	}
	
	/**
	 * 囤货订单
	 */
	public function store($current_status = 'all', $page = 1){
		$limit = 5;
		if (!in_array($current_status,array('all','2','8'))){
			$order_list = null;
		}else {
			$rpc_model = $this->app->rpc('get_orders_list');
			$data = array(
					'buyersId'	=>'BI01',
					'buyersCode'=>'BC01',
			);
			$response = $rpc_model->request($data, 2);
			if ($current_status == 'all' or empty($current_status)){
				if (!empty($_POST['search'])){
					foreach ($response['result']['orders'] as $k=>$v){
						if ($v['orderCode'] == $_POST['search']){
							$order_list[$k] = $response['result']['orders'][$k];
						}
					}
				}else {
					$order_list = $response['result']['orders'];
				}
			}else {
				foreach ($response['result']['orders'] as $k=>$v){
					if ($v['orderStatus'] == $current_status){
						$order_list[$k] = $response['result']['orders'][$k];
					}
				}
			}
			$list = array_slice($order_list, ($page-1)*$limit, $limit);
		}

		is_array($list) and array_walk($list,function(&$v,$k){
			$v['pay_status'] = self::$_pay_list[$v['orderStatus']];
		});
		$this->pagedata['order_list'] = $list;
		$this->pagedata['current_status'] = $current_status;
		$this->pagedata['search'] = $_POST['search'];
		$this->pagedata['pager'] = array(
				'total' => ceil(count($order_list) / $limit),
				'current' => $page,
				'link' => array(
						'app' => 'buyer',
						'ctl' => 'site_goods',
						'act' => 'store',
						'args' => array($current_status,($token = time())),
						),
				'token' => $token,
		);
		$this->output();
	}
	
	private static $_pay_list=array(
			1=>'新建',
			2=>'待付款',
			3=>'已付款',
			4=>'待审核',
			5=>'已审核',
			6=>'待分销',
			7=>'分销中',
			8=>'已确认',
			9=>'待发货',
			10=>'部分发货',
			11=>'部分收货',
			12=>'全部发货',
			13=>'全部收货',
			14=>'分销失败',
	);
	
	
}