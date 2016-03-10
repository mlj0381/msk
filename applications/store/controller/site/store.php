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

class store_ctl_site_store extends site_controller
{
    public function __construct(&$app){
        parent::__construct($app);
        $this->app = $app;
        $this->set_tmpl('store_home');

    }
    public function index($store_id){
        $this->pagedata['store_id'] = $store_id = 5;//$store_id ? $store_id : $this->_request->get_get('store');
        $this->page('site/index.html');
    }

    public function store_list($store_id){
        $store_id = 5;
        $this->pagedata['store_id'] = $store_id;
        if(!is_numeric($store_id)) $this->splash('error', '', '非法请求');
        $params = utils::_filter_input($_GET);
        $objSearch = vmc::singleton('b2c_goods_search');
        //参数组合
        $query_str = $objSearch->query_str($params);
        //配置参数
        $params = $objSearch->params_decode($params);
        $params['filter']['store_id'] = $store_id;
        $goods_list = $objSearch->goods_list($params);
        $this->pagedata['having'] = $params['keywords'];
        $this->pagedata['data_list'] = $goods_list['data'];
        $this->pagedata['pager'] = $goods_list['page_info'];
        $this->pagedata['pager']['token'] = time();
        $this->pagedata['query'] = $query_str;
        $this->pagedata['count'] = $goods_list['all_count'];
        $this->pagedata['page_index'] = $params['page']['index'];
        $this->pagedata['pager']['link'] = $this->gen_url(array(
                'app' => 'store',
                'ctl' => 'site_store',
                'act' => 'store_list',
                'full' => 1,
                'args0' => $store_id
            )) . '?page=' . $this->pagedata['pager']['token'] . ($query_str ? '&' . $query_str : '');
        $this->page('site/store_list.html');
    }
}
