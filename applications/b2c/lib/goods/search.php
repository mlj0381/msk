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


class b2c_goods_search
{
    public function __construct()
    {
        $this->conf = app::get('b2c')->getConf('serach');
        $this->mBrand = app::get('b2c')->model('brand');
        $this->mKeywords = app::get('b2c')->model('goods_keywords');
        $this->mGoods = app::get('b2c')->model('goods');
    }

    //属性查找面包屑组合
    public function init_crumbs($params)
    {
        if (empty($params)) {
            return array();
        }
        $search_info = array();
        $search_label = app::get('b2c')->getConf('search_label');
        if (isset($params['brand']) && is_numeric($params['brand'])) {
            $brand = $this->mBrand->getRow('brand_id, brand_name', array('brand_id' => $params['brand']));
            $search_info['brand'] = array(
                'label' => $search_label['brand'],
                'id' => $brand['brand_id'],
                'name' => $brand['brand_name'],
            );
        }
        foreach ($params as $k => $v) {
            $query = $params;
            unset($query[$k]);
            foreach ($this->conf[$k] as $value) {
                if ($value['id'] == $v) {
                    $search_info[$k] = $value;
                    $search_info[$k]['label'] = $search_label[$k];
                    $search_info[$k]['url'] = http_build_query($query);
                    break;
                }
            }
        }
        return $search_info;
    }

    //参数组合
    public function query_str($params, $nopage = true)
    {
        if ($nopage) {
            unset($params['page']);
        }

        return http_build_query($params);
    }

    //配置参数
    public function params_decode($params)
    {
        //排序
        $orderby = str_replace('-', ' ', $params['orderby']);
        unset($params['orderby']);
        //分页,页码
        $page['index'] = $params['page'] ? $params['page'] : 1;
        $page['size'] = $params['page_size'] ? $params['page_size'] : 8;
        unset($params['page']);
        unset($params['page_size']);
        //价格区间
        if ($params['price_min'] || $params['price_max']) {
            $params['price'] = ($params['price_min'] ? $params['price_min'] : '0') . '~' . ($params['price_max'] ? $params['price_max'] : '99999999');
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

    /*
     * 按店铺搜索
     *
     *  */

    public function search_store($params)
    {
        if (empty($params) && !isset($params)) return array();
        $cache_key = utils::array_md5(func_get_args());
        if (cachemgr::get($cache_key, $return)) {
            return $return;
        }
        cachemgr::co_start();
        //查询店铺
        $mdl_store = app::get('store')->model('store');
        $filter = array('store_name|has' => $params['keywords']['keywords']);
        $result = $mdl_store->getList('*', $filter, $params['page']['size'] * ($params['page']['index'] - 1),
            $params['page']['size'], $params['orderdy']);
        $mdl_brand = app::get('b2c')->model('brand');
        foreach ($result as &$value) {
            $value['brand'] = $mdl_brand->getList('brand_name, brand_id', array('seller_id' => $value['seller_id']));
        }
        cachemgr::set($cache_key, $return, cachemgr::co_end());
        return $result;
    }

    public function goods_list($params)
    {
        if (empty($params) && !isset($params)) return array();
        $cache_key = utils::array_md5(func_get_args());
        if (cachemgr::get($cache_key, $return)) {
            return $return;
        }
        cachemgr::co_start();
        if (!empty($params['keywords']['keywords'])) {
            $goods = $this->mKeywords->getList('goods_id', array('keyword|has' => $params['keywords']['keywords'], 'res_type' => 'goods'));
            if(empty($goods)) return array();
            foreach ($goods as $key => $value) {
                $filter['goods_id|in'][$key] = $value['goods_id'];
            }
        }
        $goods_cols = '*';
        $filter['cat_id'] = $params['filter']['cat'];
        $filter['brand_id'] = $params['filter']['brand'];
        $filter['store_id'] = $params['filter']['store_id'];
        $filter['marketable'] = 'true';

        $goods_list = $this->mGoods->getList($goods_cols, $filter, $params['page']['size'] * ($params['page']['index'] - 1), $params['page']['size'], $params['orderby']);
        $obj_goods_stage = vmc::singleton('b2c_goods_stage');
        //set_member

        $mdl_store = app::get('store')->model('store');
        $mdl_goods_mark = app::get('b2c')->model('goods_mark');
        foreach($goods_list as &$value){
            //店铺信息
            $value['store_info'] = $mdl_store->getRow('store_name, store_id', array('store_id' => $value['store_id']));
            //商品好评数
            //$value['count_mark'] = $mdl_goods_mark->count(array('goods_id' => $value['goods_id']));
            $value['count_mark'] = $mdl_goods_mark->getRow(array('goods_id' => $value['goods_id']));
        }
        $jg = $mdl_goods_mark->getRow('count(*)',array('goods_id' => 41));
        //var_dump($jg);
        if ($this->app->member_id = vmc::singleton('b2c_user_object')->get_member_id()) {
            $obj_goods_stage->set_member($this->app->member_id);
        }

        $obj_goods_stage->gallery($goods_list); //引用传递
        if ($params['sg'] == 's') {
            $goods_list = $this->_store_goods($goods_list);
        }
        $total = $this->mGoods->count($params['filter']);
        $return = array(
            'data' => $goods_list,
            'count' => count($goods_list),
            'all_count' => $total,
            'page_info' => array(
                'total' => ($total ? ceil($total / $params['page']['size']) : 1),
                'current' => intval($params['page']['index']),
            ),
        );
        cachemgr::set($cache_key, $return, cachemgr::co_end());
//print_r($return['data']);
        return $return;
    }

    //商品列表按店铺显示
    private function _store_goods(&$goodsList)
    {
        $mdl_store = app::get('store')->model('store');
        foreach ($goodsList as $key => $value) {
            $store_info[$value['store_id']] = $mdl_store->getRow('*', array('store_id' => $value['store_id']));
            $goods[$value['store_id']][$key] = $value;
            //array_push($store_info[$value['store_id']]['goods'], array($key => $value));
        }
        foreach ($store_info as $key => &$value) {
            $value['goodsNum'] = count($goods[$key]);
            $value['goods'] = $goods[$key];
        }
        unset($goodsList);
        return $store_info;
    }
}