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
    }

    public function order($type = 'all'){

        $limit = 10;
        $mdl_as_request = app::get('aftersales')->model('request');
        $mdl_products = app::get('b2c')->model('products');
        $filter = array(
            'store_id' => $this->store['store_id'],
        );
        if(is_numeric($type)){
            if($type == '1'){
                $filter['status|in'] = array('1', '3', '4');
            }else{
                $filter['status'] = $type;
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
        $count = $mdl_as_request->count($filter);
        $request_list = $mdl_as_request->getList('*', $filter, ($page - 1) * $limit, $limit);
        foreach ($request_list as $key => &$item) {
            if ($item['product']['product_id']) {
                $item['product']['info'] = $mdl_products->dump($item['product']['product_id']);
            }
        }
        $this->pagedata['filter'] = $_POST['order'];
        $this->pagedata['status'] = $type;
        $this->pagedata['request_list'] = $request_list;
        $this->pagedata['pager'] = array(
            'total' => ceil($count / $limit) ,
            'current' => $page,
            'link' => array(
                'app' => 'aftersales',
                'ctl' => 'site_member',
                'act' => 'request',
                'args' => array(
                    ($token = time()),
                ) ,
            ) ,
            'token' => $token,
        );
        $this->output();
    }
}
