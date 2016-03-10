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


class b2c_openapi_goods extends base_openapi
{
    private $req_params = array();

    public function __construct()
    {
        $this->req_params = vmc::singleton('base_component_request')->get_params(true);
    }
    /**
     * 商品列表.
     */
    public function gallery($params = array())
    {
        $default_params = array(
            'page_size' => 20,
            'page_index' => 1,
            'orderby' => '',
        );
        if (!is_array($params)) {
            $params = array();
        }
        $params = array_merge($default_params, $params, $this->req_params);
        if($params['orderby']){
            $params['orderby'] = str_replace('-', ' ', $params['orderby']);
        }
        $cache_key = utils::array_md5($params);
        //优先从缓存读取
        if(cachemgr::get($cache_key, $gallery_data)){
            $this->success($gallery_data);
        }
        cachemgr::co_start();
        $filter = $params['filter'];

        if (!is_array($filter)) {
            $filter = array();
        }
        $filter['marketable'] = 'true';
        $obj_goods_stage = vmc::singleton('b2c_goods_stage');
        //set_member
        if ($this->app->member_id = vmc::singleton('b2c_user_object')->get_member_id()) {
            $obj_goods_stage->set_member($this->app->member_id);
        }
        $mdl_goods = app::get('b2c')->model('goods');
        $goods_cols = 'goods_id,gid,name,type_id,cat_id,brand_id,nostore_sell,brief,image_default_id,goods_setting';
        $goods_list = $mdl_goods->getList($goods_cols, $filter, $params['page_size'] * ($params['page_index'] - 1),
        $params['page_size'], $params['orderby']);
        if (!$goods_list) {
            $this->failure();
        }
        $total = $mdl_goods->count($filter);
        $obj_goods_stage->gallery($goods_list); //引用传递
        $page_total = ($total ? ceil($total / $the_params['page_size']) : 1);
        $gallery_data = array(
            'page_total' => ($page_total > 0 ? $page_total : 1),
            'goods_list' => array_values($goods_list),
        );
        cachemgr::set($cache_key, $gallery_data, cachemgr::co_end());
        $this->success($gallery_data);
    }
    /**
     * 品牌数据.
     */
    public function brand($params)
    {
        $mdl_brand = app::get('b2c')->model('brand');
        $filter = array('disabled' => 'false');
        foreach ($params as $key => $value) {
            switch ($key) {
                case 'brand_id':
                case 'brand_initial':
                $filter[$key] = explode(',', $value);
                    break;
                case 'brand_name':
                $filter[$key.'|has'] = $value;
                break;
            }
        }
        $brand_list = $mdl_brand->getList('brand_id,brand_name,brand_initial,brand_logo', $filter);
        if (!$brand_list) {
            $this->failure();
        }
        foreach ($brand_list as &$brand) {
            $brand['brand_logo'] = base_storager::image_path($brand['brand_logo']);
            $brand['detail_url'] = app::get('site')->router()->gen_url(array('app' => 'b2c', 'ctl' => 'site_list', 'args' => array($brand['brand_id'])));
        }
        $this->success($brand_list);
    }
    /**
     * 分类数据.
     */
    public function catalog($params, $return = false)
    {
        $mdl_gcat = app::get('b2c')->model('goods_cat');
        $parent_id = $params['parent_id'] ? $params['parent_id'] : 0;
        $step = $params['step'] ? $params['step'] : 1;
        $tree = $mdl_gcat->get_tree($parent_id, $step);
        if ($return) {
            return $tree;
        }
        if ($tree) {
            $this->success($tree);
        } else {
            $this->failure();
        }
    }
    /**
     * 分类数据.
     */
    public function catalog_path($params)
    {
        $cat_id = $params['cat_id'];
        $show_self = $params['show_self'];
        $mdl_gcat = app::get('b2c')->model('goods_cat');
        if ($tree = $mdl_gcat->getPath($cat_id, $show_self)) {
            $this->success($tree);
        } else {
            $this->failure();
        }
    }
    /**
     * 确认商品收藏情况.
     */
    public function check_fav($args = array())
    {
        $args = array_merge((array) $args, $this->req_params);
        $mdl_member_goods = app::get('b2c')->model('member_goods');
        $gid = $args['goods_id'] ? $args['goods_id'] : $req_params['goods_id'];
        $member_id = $args['member_id'] ? $args['member_id'] : $req_params['member_id'];
        $fav_check_result = $mdl_member_goods->check_fav($member_id, $gid);
        $this->success($fav_check_result);
    }
    /**
     * 批量确认商品收藏情况.
     */
    public function check_favs($args = array())
    {
        $args = array_merge((array) $args, $this->req_params);
        $mdl_member_goods = app::get('b2c')->model('member_goods');
        $gid_arr = $args['goods_id'] ? $args['goods_id'] : $req_params['goods_id'];
        $member_id = $args['member_id'] ? $args['member_id'] : $req_params['member_id'];
        $fav_check_result = $mdl_member_goods->check_favs($member_id, $gid_arr);
        $this->success($fav_check_result);
    }
    /**
     * 获得相关商品.
     */
    public function related($args = array())
    {
        $args = array_merge((array) $args, $this->req_params);
        $gid = $args['goods_id'];
        if (!$gid) {
            $this->failure('缺少参数');
        }
        $mdl_goods = app::get('b2c')->model('goods');
        $req_params = vmc::singleton('base_component_request')->get_params(true);
        $rate = $mdl_goods->getLinkList($gid);
        $gids = array_keys(utils::array_change_key($rate, 'goods_id'));
        if (count($gids) < 1) {
            $this->failure('空数据');
        }
        $glist = $mdl_goods->getList('goods_id,gid,name,type_id,cat_id,brand_id,brief,image_default_id,spec_desc', array('goods_id' => $gids));
        //数据包装
        vmc::singleton('b2c_goods_stage')->gallery($glist);
        $this->success(array_values($glist));
    }
    /**
     * 获得商品促销规则信息.
     */
    public function promotion($args = array())
    {
        $args = array_merge((array) $args, $this->req_params);
        $goods_id = $args['goods_id'];
        $price = $args['price'];
        if (!$goods_id) {
            $this->failure('缺少参数');
        }
        $plist = vmc::singleton('b2c_goods_stage')->promotion($goods_id,$price);
        $this->success($plist);
    }
    /**
     * 不破坏缓存情况下的商品统计
     */
    public function counter($args = array())
    {
        $args = array_merge((array) $args, $this->req_params);
        $mdl_goods = app::get('b2c')->model('goods');
        $gid = $args['goods_id'];
        if (!$gid) {
            return false;
        }
        $db = vmc::database();
        $kv = base_kvstore::instance('b2c_counter');

        foreach ($args as $key => $value) {
            $value = intval($value);
            $update_sql = false;
            if ($value < 1) {
                $value = 1;
            }
            switch ($key) {
                case 'view_count':
                    $this->history($gid);
                    //UV型统计 24小时同一IP记录一次
                    $c_key = 'view_count_uv_'.$gid.'_'.base_request::get_remote_addr();

                    cacheobject::get($c_key, $time);
                    $kv->fetch('view_w_count_time', $vw_last_update);
                    if (!$time || strtotime('+1 day', $time) < time()) {

                        //获得周标记
                        if ($vw_last_update > strtotime('-1 week')) {
                            $update_sql = "UPDATE vmc_b2c_goods SET view_count=view_count+$value,view_w_count=view_w_count+$value WHERE goods_id=$gid";
                        } else {
                            $update_sql = "UPDATE vmc_b2c_goods SET view_count=view_count+$value,view_w_count=$value WHERE goods_id=$gid";
                            $kv->store('view_w_count_time', time());
                        }

                        cacheobject::set($c_key, time(), 86400 + time());
                    }
                    break;
                case 'buy_count':
                    //验证
                    if (md5($gid.'buy_count'.($value * 1024)) != $args['buy_count_sign']) {
                        break;
                    }
                    //获得周标记
                    $kv->fetch('buy_w_count_time', $bw_last_update);
                    if ($bw_last_update > strtotime('-1 week')) {
                        $update_sql = "UPDATE vmc_b2c_goods SET buy_count=buy_count+$value,buy_w_count=buy_w_count+$value WHERE goods_id=$gid";
                    } else {
                        $update_sql = "UPDATE vmc_b2c_goods SET buy_count=buy_count+$value,buy_w_count=$value WHERE goods_id=$gid";
                        $kv->store('buy_w_count_time', time());
                    }
                    break;
                case 'comment_count':
                    if (md5($gid.'comment_count'.($value * 1024)) == $args['comment_count_sign']) {
                        $update_sql = "UPDATE vmc_b2c_goods SET comment_count=comment_count+$value WHERE goods_id=$gid";
                    }
                    break;
            }

            if ($update_sql) {
                logger::info($update_sql);
                $db->exec($update_sql, true);
            }
        }
    }
    /**
     * 浏览历史.
     */
    public function history($gid = flase)
    {
        $exits_gv_history = $_COOKIE['goods_view_history'];
        $exits_gv_history = explode('G', $exits_gv_history);
        if ($gid) {
            $exits_gv_history = $exits_gv_history ? $exits_gv_history : array();
            array_unshift($exits_gv_history, $gid);
            $exits_gv_history = array_unique($exits_gv_history);
            $exits_gv_history = array_slice($exits_gv_history, 0, 20);//限制20个
            return setcookie('goods_view_history', implode('G', $exits_gv_history), time() + 315360000, vmc::base_url().'/');
        }
        $glist = app::get('b2c')->model('goods')->getList('goods_id,gid,name,type_id,cat_id,brand_id,brief,image_default_id,spec_desc', array('goods_id' => $exits_gv_history));
        //数据包装
        vmc::singleton('b2c_goods_stage')->gallery($glist);
        $this->success(array_values($glist));
    }


}
