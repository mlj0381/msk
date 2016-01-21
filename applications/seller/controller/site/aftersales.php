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


class seller_ctl_site_aftersales extends seller_frontpage
{
    public function __construct(&$app){
        parent::__construct($app);
        $this->app = $app;
        $this->verify();
    }

    public function order($list = 'all', $page = 1){
        $this->_list($list, 'goods', $page);
        $this->output();
    }

    public function price_manage($list = 'all', $page = 1){
        $this->_list($list, 'price', $page);
        $this->pagedata['_PAGE_'] = 'order.html';
        $this->output();
    }

    private function _list($list, $type, $page){
        $limit = 10;
        $mdl_as_request = app::get('aftersales')->model('request');
        $mdl_products = app::get('b2c')->model('products');
        $filter = array(
            'store_id' => $this->store['store_id'],
        );
        if(is_numeric($list)){
            if($list == '1'){
                $filter['status|in'] = array('1', '3', '4');
            }else{
                $filter['status'] = $list;
            }
        }
        foreach ($_POST['order'] as $key => $value) {
            if(empty($value)) continue;
            if($key == 'createtime'){
                if(strtotime($value[0]) <= strtotime($value[1])){
                    $filter[$key . '|betwwen'] = array(strtotime($value[0].' 00:00:00'), strtotime($value[1].' 23:59:59'));
                    continue;
                }
            }
            $filter[$key] = $value;
        }
        $filter['req_type'] = 5;
        if($type != 'price') $filter['req_type'] = 1;
        $count = $mdl_as_request->count($filter);
        $request_list = $mdl_as_request->getList('*', $filter, ($page - 1) * $limit, $limit);
        $mdl_member = app::get('pam')->model('members');
        foreach ($request_list as $key => $value) {
            $request_list[$key]['member_info'] = $mdl_member->getRow('member_id, login_account');
        }
        foreach ($request_list as $key => &$item) {
            if ($item['product']['product_id']) {
                $item['product']['info'] = $mdl_products->dump($item['product']['product_id']);
            }
        }
        $this->pagedata['filter'] = $_POST['order'];
        $this->pagedata['status'] = $list;
        $this->pagedata['request_list'] = $request_list;
        $action = $type == 'price' ? 'price_manage' : 'order';
        $this->pagedata['pager'] = array(
            'total' => ceil($count / $limit) ,
            'current' => $page,
            'link' => array(
                'app' => 'seller',
                'ctl' => 'site_aftersales',
                'act' => $action,
                'args' => array(
                    $list,
                    ($token = time()),
                ) ,
            ) ,
            'token' => $token,
        );
    }
}
