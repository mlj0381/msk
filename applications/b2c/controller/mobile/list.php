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

class b2c_ctl_mobile_list extends b2c_mfrontpage
{
    public $title = '商品列表';
    public function __construct(&$app)
    {
        parent::__construct($app);
        $this->app = $app;
        $this->_response->set_header('Cache-Control', 'no-store');
        $this->set_tmpl('list');
    }
    public function index($fix_brand = false)
    {

        $params = utils::_filter_input($_GET);
        $query_str = $this->_query_str($params);
        $this->pagedata['query'] = $this->_query_str($params, 0);
        $params = $this->_params_decode($params);
        $filter = $params['filter'];
        if (!$fix_brand && $filter['cat_id']) {
            $mdl_cat = $this->app->model('goods_cat');
            $cat_info = $mdl_cat->dump($filter['cat_id']);
            if ($cat_info['gallery_setting']['mobile_template']) {
                $this->set_tmpl_file($cat_info['gallery_setting']['mobile_template']); //设置模板文件
            }
            $this->_info = $cat_info['seo_info'];
            $this->pagedata['cat_path'] = $mdl_cat->getPath($filter['cat_id']);
        } elseif($fix_brand) {
            $filter['brand_id'] = $fix_brand;
        }
        $goods_list = $this->_list($filter, $params['page'], $params['orderby']);
        $this->pagedata['data_list'] = $goods_list['data'];
        $this->pagedata['count'] = $goods_list['count'];
        $this->pagedata['all_count'] = $goods_list['all_count'];
        $this->pagedata['pager'] = $goods_list['page_info'];
        $this->pagedata['pager']['token'] = time();
        $this->pagedata['pager']['link'] = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'mobile_list',
            'act' => 'index',
            'full' => 1,
        )).'?page='.$this->pagedata['pager']['token'].($query_str ? '&'.$query_str : '');
        if (!$fix_brand) {
            $this->pagedata['data_screen'] = vmc::singleton('b2c_goods_stage')->screening_data_by_cat($filter['cat_id']);
        } else {
            $brand = app::get('b2c')->model('brand')->dump($fix_brand);
            $this->pagedata['brand'] = $brand;
            $this->pagedata['data_screen'] = vmc::singleton('b2c_goods_stage')->screening_data_by_brand($fix_brand);
            $this->set_tmpl('brandlist'); //锁定品牌型列表模板
            $brand_setting = $brand['brand_setting'];
            if ($brand_setting['mobile_template']) {
                $this->set_tmpl_file($brand_setting['mobile_template']);
            }
        }
        if($this->_request->is_ajax()){
            //ajax 请求不经过模板机制
            $this->display('mobile/list/index.html');
        }else{
            $this->page('mobile/list/index.html');
        }

    }
    //获取商品列表，包装商品列表
    private function _list($filter, $page, $orderby)
    {

        $cache_key =  utils::array_md5(func_get_args());
        if(cachemgr::get($cache_key, $return)){
            return $return;
        }
        cachemgr::co_start();
        $goods_cols = '*';
        $mdl_goods = $this->app->model('goods');
        $goods_list = $mdl_goods->getList($goods_cols, $filter, $page['size'] * ($page['index'] - 1), $page['size'], $orderby);
        $obj_goods_stage = vmc::singleton('b2c_goods_stage');
        //set_member
        if ($this->app->member_id = vmc::singleton('b2c_user_object')->get_member_id()) {
            $obj_goods_stage->set_member($this->app->member_id);
        }
        $obj_goods_stage->gallery($goods_list); //引用传递
        $total = $mdl_goods->count($filter);

        $return =  array(
            'data' => $goods_list,
            'count' => count($goods_list) ,
            'all_count'=>$total,
            'page_info' => array(
                'total' => ($total ? ceil($total / $page['size']) : 1) ,
                'current' => intval($page['index']),
            ),
        );
        cachemgr::set($cache_key, $return, cachemgr::co_end());
        return $return;
    }
    private function _query_str($params, $nopage = true)
    {
        if ($nopage) {
            unset($params['page']);
        }

        return http_build_query($params);
    }
    //配置参数
    private function _params_decode($params)
    {
        //排序
        $orderby = str_replace('-', ' ', $params['orderby']);
        unset($params['orderby']);
        //分页,页码
        $page['index'] = $params['page'] ? $params['page'] : 1;
        $page['size'] = $params['page_size'] ? $params['page_size'] : 10;
        unset($params['page']);
        unset($params['page_size']);
        //价格区间
        if ($params['price_min'] || $params['price_max']) {
            $params['price'] = ($params['price_min'] ? $params['price_min'] : '0').'~'.($params['price_max'] ? $params['price_max'] : '99999999');
        }
        unset($params['price_min']);
        unset($params['price_max']);
        $params['marketable'] = 'true';
        $tmp_filter = $params;
        //价格区间筛选
        if ($tmp_filter['price']) {
            $tmp_filter['price'] = explode('~', $tmp_filter['price']);
        }
        $params['filter'] = $tmp_filter;
        $params['orderby'] = $orderby;
        $params['page'] = $page;

        return $params;
    }
}
