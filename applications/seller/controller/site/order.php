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
        /**
         * 润和接口
         * ISO151416 买家订单列表 卖家订单列表 买手销售订单列表 买手囤货订单列表 买家订单明细
         *          卖家订单明细 买手销售订单明细 买手囤货订单明细 订单明细查询接口 订单列表查询接口
         */
//        $mdl_order = app::get('b2c')->model('orders');
//        $mdl_order_items = app::get('b2c')->model('order_items');
//        $limit = 5;
//
//        $status_filter = $mdl_order->status_filter();
//        $this->pagedata['status'] = $status;
//        $filter = $status_filter[$status];
//        $status == 'all' && $filter['status|notin'] = 'del';
//        $obj_order_search = vmc::singleton('b2c_order_search');
//        $search = $obj_order_search->search($_POST);
//        $filter['store_id'] = $this->store['store_id'];
//
//        if($status == 's2'){
//            $where = $search['sql'];
//            $sql = "SELECT * FROM  vmc_b2c_orders WHERE `store_id`={$this->store['store_id']} AND `status` = 'active' AND `confirm` = 'N' AND `ship_status` = '0'  (`is_cod`='Y' OR `pay_status`='1')  {$where}   ORDER BY createtime desc LIMIT ". (($page - 1) * $limit). ", {$limit}";
//            $order_list = vmc::database()->select($sql);
//        }else{
//            $search['order_id|has'] && $filter['order_id|has'] = $search['order_id|has'];
//            $search['order_id|in'] && $filter['order_id|in'] = $search['order_id|in'];
//            $order_list = $mdl_order->getList('*', $filter, ($page - 1) * $limit, $limit);
//        }
//        foreach ($order_list as $key => $value) {
//            //所属店铺信息
//            $store_info = vmc::singleton('store_store_object')->store_info($value['store_id'], 'store_id, store_name');
//            $order_list[$key]['store_name'] = $store_info['store_name'];
//        }
//        $oids = array_keys(utils::array_change_key($order_list, 'order_id'));
//        $order_items = $mdl_order_items->getList('*', array(
//            'order_id' => $oids,
//        ));
//        $order_items_group = utils::array_change_key($order_items, 'order_id', true);
//        $order_count = $mdl_order->count($filter);

        /**
         *  订单列表查询接口---------------ISO151416
         */
        $limit = 1;
        $offset = ($page - 1) * $limit;
        $rpc_orders = app::get('buyer')->rpc("get_orders_list");
        $seller_id = vmc::singleton('seller_user_object')->get_id();
        $request_filter = app::get('seller')->model('sellers')->getRow('sl_code',array('seller_id'=>$seller_id));
        $response = $rpc_orders->request($request_filter);
        if($response['status'])
        {
            $api_orders_list = $response['result']['orders'];
            //如果不是查询全部订单就进行状态筛选
            if($status != 'all')
            {
                foreach($api_orders_list as $k=>$order)
                {
                    if($order['orderStatus'] != $status)
                    {
                        unset($api_orders_list[$k]);
                    }
                }
                sort($api_orders_list);
            }
            //分页处理
            $api_orders = array_slice($api_orders_list,$offset,$limit);
            $order_count = count($api_orders_list);


            //查询本地数据库数据
            $api_order_id = array_keys(utils::array_change_key($api_orders,'orderId'));
            $mdl_order = app::get('b2c')->model('orders');
            $mdl_order_items = app::get('b2c')->model('order_items');
            $local_orders = $mdl_order->getList('*', array('api_order_id'=>$api_order_id));
            $local_orders = utils::array_change_key($local_orders,'api_order_id');
            $order_list = array();
            //进行接口数据合并
            foreach($api_orders as $k=>$order)
            {
                if($local_orders[$order['orderId']])
                {
                    $order = array_merge($order,$local_orders[$order['orderId']]);
                }
                $order['status_name'] = $this->api_order_status($order['orderStatus']);
                $order_list[] = $order;
            }

            $oids = array_keys(utils::array_change_key($order_list, 'order_id'));
            $order_items = $mdl_order_items->getList('*', array(
                'order_id' => $oids,
            ));
            $order_items_group = utils::array_change_key($order_items, 'order_id', true);

        }


        $this->pagedata['search'] = $_POST['search'];
        $this->pagedata['type'] = 'orders';
        $this->pagedata['current_status'] = $status;
//        $this->pagedata['status_map'] = $status_filter;
        $this->pagedata['order_list'] = $order_list;
        $this->pagedata['order_count'] = $order_count;
        $this->pagedata['order_items_group'] = $order_items_group;
        $this->pagedata['pager'] = array(
            'total' => ceil($order_count / $limit),
            'current' => $page,
            'link' => array(
                'app' => 'seller',
                'ctl' => 'site_order',
                'act' => 'index',
                'args' => array(
                    $status,
                    ($token = time()),
                ),
            ),
            'token' => $token,
        );
        $this->output();
    }

    public function api_order_status($status)
    {
        $status_array = array(
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
            14=>'分销失败'
        );
        if($status_array[$status])
        {
            return $status_array[$status];
        }
        return false;
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
