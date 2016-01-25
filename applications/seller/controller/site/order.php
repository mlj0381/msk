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

    public function __construct(&$app)
    {
        parent::__construct($app);
        $this->verify();
    }

    //商家订单
    public function index($status = 'all', $page = 1)
    {
        $mdl_order = app::get('b2c')->model('orders');
        $mdl_order_items = app::get('b2c')->model('order_items');
        $limit = 5;

        $status_filter = $mdl_order->filter();
        $this->pagedata['status'] = $status;
        $filter = $status_filter[$status];
        $obj_order_search = vmc::singleton('b2c_order_search');
        $search = $obj_order_search->search($_POST);
        $filter['store_id'] = $this->store['store_id'];

        if($status == 's2'){
            $where = $search['sql'];
            $sql = "SELECT
* FROM  vmc_b2c_orders WHERE `store_id`={$this->store['store_id']} AND `status` = 'active' AND `confirm` = 'N' AND (`is_cod`='Y' OR
`pay_status`='1')  {$where}   ORDER BY createtime desc LIMIT ". (($page - 1) * $limit). ", {$limit}";
            $order_list = vmc::database()->select($sql);
        }else{
            $search['order_id|has'] && $filter['order_id|has'] = $search['order_id|has'];
            $search['order_id|in'] && $filter['order_id|in'] = $search['order_id|in'];
            $order_list = $mdl_order->getList('*', $filter, ($page - 1) * $limit, $limit);
        }
        foreach ($order_list as $key => $value) {
            //所属店铺信息
            $store_info = vmc::singleton('store_store_object')->store_info($value['store_id'], 'store_id, store_name');
            $order_list[$key]['store_name'] = $store_info['store_name'];
        }
        $oids = array_keys(utils::array_change_key($order_list, 'order_id'));
        $order_items = $mdl_order_items->getList('*', array(
            'order_id' => $oids,
        ));
        $order_items_group = utils::array_change_key($order_items, 'order_id', true);
        $order_count = $mdl_order->count($filter);
        $this->pagedata['search'] = $_POST['search'];
        $this->pagedata['type'] = 'orders';
        $this->pagedata['current_status'] = $status;
        $this->pagedata['status_map'] = $status_filter;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['order_count'] = $order_count;
        $this->pagedata['order_items_group'] = $order_items_group;
        $this->pagedata['pager'] = array(
            'total' => ceil($order_count / $limit),
            'current' => $page,
            'link' => array(
                'app' => 'b2c',
                'ctl' => 'site_member',
                'act' => 'orders',
                'args' => array(
                    $status,
                    ($token = time()),
                ),
            ),
            'token' => $token,
        );
        $this->output();
    }

    private function search_order($post){

    }
    //支付
    public function dopay()
    {

    }

    //订单发货
    public function send()
    {

    }

    //订单取消
    public function docancel()
    {

    }

    //编辑
    public function edit()
    {

    }

    //订单详细信息
    public function detail($order_id)
    {
        $mdl_order = app::get('b2c')->model('orders');
        $mdl_order_log = app::get('b2c')->model('order_log');
        $order = $mdl_order->dump($order_id, '*', array(
            'items' => array(
                '*',
            ),
            'promotions' => array(
                '*',
            ),
            ':dlytype' => array(
                '*',
            ),
            // 'store_info' => array(
            //     'store_name, store_id',
            // ),
        ));
        $store_obj = vmc::singleton('store_store_object');
        $order['store_info'] = $store_obj->store_info($order['store_id'], 'store_id, store_name');
        foreach ($mdl_order_log->getList('behavior,log_time', array(
            'order_id' => $order['order_id'],
            'result' => 'success',
            //会员端只显示成功日志

        )) as $log) {
            $order['process'][$log['behavior']] = $log['log_time'];
        }
        $this->pagedata['order'] = $order;
        $this->output();
    }

    //退货
    public function goreship()
    {

    }

    //退款
    public function dorefund()
    {

    }

    //保存
    public function save()
    {

    }

    //删除
    public function del()
    {

    }

    //订单操作日志
    public function order_log()
    {

    }

    //打印单据
    public function doreship()
    {

    }

    //手工订单减价
    public function discount()
    {

    }

}
