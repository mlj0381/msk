<?php

class freeze_ctl_site_center extends freeze_frontpage
{

    function __construct(&$app)
    {
        parent::__construct($app);
        $this->_response->set_header('Cache-Control', 'no-store');
        $this->verify_member();
        $this->is_complete_info();
    }

    public function index()
    {
        $freeze_id = $this->app->freeze_id;
        $buyer = app::get('freeze')->model('freeze')->getRow('buyer_id', array('freeze_id' => $freeze_id));
        $buyer_code = app::get('buyer')->model('buyers')->getRow('buyer_code', array('buyer_id' => $buyer['buyer_id']));
        $member_ids = app::get('freeze')->model('freeze_member')->getList('member_id', array('freeze_id' => $freeze_id));
        $member_ids = array_keys(utils::array_change_key($member_ids, 'member_id'));
        $buyer_ids = app::get('b2c')->model('members')->getList('refer_id', array('member_id' => $member_ids));

        $filter = array(
//            'buyersId' => '',//买家id
            'sellerCode' => $buyer_code['buyer_code']//买手编码
        );
        $rpc_order = app::get('buyer')->rpc('get_orders_detail');
        $order_list = $rpc_order->request($filter);
//        $order_list = $this->generate($order_list,$buyer_ids,0,5);
//        var_dump($order_list);
        $this->output();
    }


    public function generate($order_list, $filter, $offset, $limit)
    {

        foreach ($order_list as $order) {

        }
    }


    /**
     * 订单管理
     */
    public function orders()
    {
        $this->output();
    }

    /**
     * 结算管理
     */
    public function settlement()
    {
        $this->output();
    }

    /**
     * 我的分销产品
     */
    public function goods()
    {
        $this->output();
    }

    /**
     * 我的买家列表
     */
    public function buyer_list($status = 'all', $page = 1)
    {
        $mdl_goods_cat = app::get('b2c')->model('goods_cat');
        $mdl_company = app::get('base')->model('company');
        $mdl_company_extra = app::get('base')->model('company_extra');
        $mdl_freeze_member = app::get('freeze')->model('freeze_member');
        $limit = 10;

        $filter = array();
        if ($status != 'all') {
            $filter = array(
                'fm.status' => $status,
            );
        }

        /**
         * 调用润和接口
         */
        $request = array(
            'buyerFlag' => '1',
            'pageCount' => $limit,
            'pageNo' => $page,
        );
        $result = app::get('freeze')->rpc('querybuyer')->request($request);
        $api_member_list = $result['result']['slBuyerList'];
        $buyer_id = array();
        foreach($api_member_list as $member)
        {
            if($member['buyerId'])
            {
                $buyer_id[] =  "'".$member['buyerId']."'";
            }
        }
        if($buyer_id)
        {
            $filter['bm.buyer_id|in'] = implode(',',$buyer_id);
        }
        $count = count(app::get('freeze')->rpc('querybuyer')->request(array( 'buyerFlag' => '1'))['result']['slBuyerList']);
        //end


        //买家信息
        $local_member_list = $mdl_freeze_member->get_freeze_member('bm.*,fm.status,fm.apply_type', $filter);
        $merge_local_list = utils::array_change_key($local_member_list,'buyer_id');
        $member_ids = array_keys(utils::array_change_key($local_member_list, 'member_id'));
//        $count = $mdl_freeze_member->count_freeze_member($filter);
        //润和数据和本地进行合并
        $member_list = array();
        foreach($api_member_list as $api_member)
        {
            $member_list[] = array_merge($api_member,$merge_local_list[$api_member['buyer_id']]);
        }

        //查询出绑定状态
        $bind_status = $mdl_freeze_member->getList('*', array('member_id' => $member_ids));
        $bind_status = utils::array_change_key($bind_status, 'member_id');
        $this->pagedata['bind'] = $bind_status;

        //查询出公司信息
        $company_list = $mdl_company->getList('*', array('uid' => $member_ids));
        $company_list = utils::array_change_key($company_list, 'uid');
        $this->pagedata['company'] = $company_list;

        //查询出主营品类
        $type_list = $mdl_company_extra->getList('uid,value', array('uid' => $member_ids, 'key' => 'manageInfo'));
        $cat_list = array();
        foreach ($type_list as $k => $v) {
            $cat_list[$k]['cat_id'] = $v['value']['main'];
            $cat_list[$k]['uid'] = $v['uid'];
        }
        $cat_list = utils::array_change_key($cat_list, 'cat_id');
        $type_ids = array_keys($cat_list);
        //查询出类目名称
        $cat_name = $mdl_goods_cat->getList('cat_name,cat_id', array('cat_id' => $type_ids));
        $cat_name = utils::array_change_key($cat_name, 'cat_id');
        foreach ($cat_list as $k => $v) {
            $cat_list[$k]['cat_name'] = $cat_name[$k]['cat_name'];
        }
        $cat_list = utils::array_change_key($cat_list, 'uid');
        $this->pagedata['cat'] = $cat_list;

        $this->pagedata['pager'] = array(
            'total' => ceil($count / $limit),
            'current' => $page,
            'link' => array(
                'app' => 'freeze',
                'ctl' => 'site_center',
                'act' => 'buyer_list',
                'args' => array(
                    ($token = time()),
                    'status' => $status,
                ),
            ),
            'token' => $token,
        );

        $this->pagedata['current_status'] = $status;
        $this->pagedata['list'] = $member_list;
        $this->output();
    }

    /**
     * 申请绑定
     */
    public function apply_bind($bind_id, $status = '0', $freeze_member_id = null)
    {
        $mdl_freeze_member = app::get('freeze')->model('freeze_member');
        $freeze_member = array(
            'updatetime' => time(),
        );
        if ($status == '0') {
            $freeze_member['apply_type'] = '1';
            $freeze_member['time'] = time();
        }
        //冻品管家

        $redirect = $this->gen_url(array(
            'app' => 'freeze',
            'ctl' => 'site_center',
            'act' => 'buyer_list',
        ));

        $freeze_member['member_id'] = $bind_id;
        $freeze_member['freeze_member_id'] = $freeze_member_id;
        $freeze_id = $this->user_obj->get_member_id();

        if (!$bind_id || !$freeze_id) {
            $this->splash('error', $redirect, '绑定信息错误');
        }
        $freeze_member['freeze_id'] = $freeze_id;
        $freeze_member['status'] = $status;
        if (!$mdl_freeze_member->save($freeze_member)) {
            $this->splash('error', $redirect, '绑定失败');
        }
        $this->splash('success', $redirect, '绑定成功');
    }

    /**
     * 退货管理
     */
    public function reship()
    {
        $this->output();
    }

    /**
     * 退款管理
     */
    public function refund()
    {
        $this->output();
    }

    /**
     * 售后管理
     */
    public function after_sale()
    {
        $this->output();
    }

    /**
     * 违规处理
     */
    public function break_rule()
    {
        $this->output();
    }

    /**
     * 举报管理
     */
    public function report()
    {
        $this->output();
    }

    /**
     * 咨询管理
     */
    public function consultation()
    {
        $this->output();
    }


}

?>