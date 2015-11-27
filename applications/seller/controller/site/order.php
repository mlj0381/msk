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
// | Description 商家订单
// +----------------------------------------------------------------------

class seller_ctl_site_order extends seller_frontpage
{
    public $titel = '商家订单';
    public function __construct(&$app){
        parent::__construct($app);
    }

    //商家订单
    public function index($status = 'all', $page = 1){
        $limit = 10;
        $status_filter = array(
            'all' => array(
                'store_id' => $this->store['store_id'],
            ) ,
            's1' => array(
                'store_id' => $this->store['store_id'],
                'status' => 'active',
                'pay_status' => array(
                    '0',
                    '3',
                    '5',
                ),
            ) ,
            's2' => array(
                'store_id' => $this->store['store_id'],
                'status' => 'active',
                'pay_status' => array(
                    '1',
                    '2',
                ) ,
                'ship_status|notin' => array(
                    '1',
                ),
            ) ,
            's3' => array(
                'store_id' => $this->store['store_id'],
                'status' => 'active',
                'ship_status' => array(
                    '1',
                    '2',
                ),
            ) ,
            's4' => array(
                'store_id' => $this->store['store_id'],
                'status|notin' => array('dead'),
                'ship_status|notin'=>array(
                    '0',
                ),
            ),
        );
        if ($filter = $status_filter[$status]) {
        } else {
            $filter = array(
                'store_id' => $this->store['store_id'],
            );
        }
        $mdl_order = app::get('b2c')->model('orders');
        $mdl_order_items = app::get('b2c')->model('order_items');
        $order_list = $mdl_order->getList('*', $filter, ($page - 1) * $limit, $limit);
        foreach ($order_list as $key => $value) {
            $store_info = vmc::singleton('store_store_object')->store_info($value['store_id'], 'store_id, store_name');
            $order_list[$key]['store_name'] = $store_info['store_name'];
        }
        $oids = array_keys(utils::array_change_key($order_list, 'order_id'));
        $order_items = $mdl_order_items->getList('*', array(
            'order_id' => $oids,
        ));
        $order_items_group = utils::array_change_key($order_items, 'order_id', true);
        $order_count = $mdl_order->count($filter);
        $this->pagedata['current_status'] = $status;
        $this->pagedata['status_map'] = $status_filter;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['order_count'] = $order_count;
        $this->pagedata['order_items_group'] = $order_items_group;
        $this->pagedata['pager'] = array(
            'total' => ceil($order_count / $limit) ,
            'current' => $page,
            'link' => array(
                'app' => 'b2c',
                'ctl' => 'site_member',
                'act' => 'orders',
                'args' => array(
                    $status,
                    ($token = time()),
                ) ,
            ) ,
            'token' => $token,
        );
        $this->output();
    }

    //支付
    public function dopay(){

    }

    //订单发货
    public function send(){

    }

    //订单取消
    public function docancel(){

    }

    //编辑
    public function edit(){

    }

    //订单详细信息
    public function detail($order_id){
        $this->output();
    }

    //退货
    public function goreship(){

    }

    //退款
    public function dorefund(){

    }

    //保存
    public function save(){

    }

    //删除
    public function del(){

    }

    //订单操作日志
    public function order_log(){

    }

    //打印单据
    public function doreship(){

    }

    //手工订单减价
    public function discount(){

    }

}
