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

class b2c_ctl_site_list extends b2c_frontpage {

    public $title = '商品列表';

    public function __construct(&$app) {
        parent::__construct($app);
        $this->app = $app;
        $this->_response->set_header('Cache-Control', 'no-store');
        $this->mCat = $this->app->model('goods_cat');
        $this->set_tmpl('list');
    }

//属性查找面包屑组合
    private function _init_crumbs($params) {
        if (empty($params)) {
            return array();
        }
        $serach_info = array();
        $conf = $this->app->getConf('serach');
        if (isset($params['brand']) && is_numeric($params['brand'])) {
            $brand = $this->app->model('brand')->getRow('brand_id, brand_name', array('brand_id' => $params['brand']));
            $serach_info['brand'] = array(
                'label' => '品牌',
                'id' => $brand['brand_id'],
                'name' => $brand['brand_name'],
            );
        }
        foreach ($params as $k => $v) {
            $query = $params;
            unset($query[$k]);
            foreach ($conf[$k] as $value) {
                if ($value['id'] == $v) {
                    $serach_info[$k] = $value;
                    $serach_info[$k]['url'] = http_build_query($query);
                    break;
                }
            }
        }
        return $serach_info;
    }

    private function _get_cat($cat_id) {
        if (!empty($cat_id) && is_numeric($cat_id)) {
//记录父级分类名称，分类面包屑显示
            $this->pagedata['cat_name']['self'] = $this->mCat->getRow('cat_id, cat_name, has_children', array('cat_id' => $cat_id));
            $this->pagedata['cat_title'] = '二级分类';
            if ($this->pagedata['cat_name']['self']['has_children'] == 'true') {
                return $this->mCat->children($cat_id);
            }
            $this->pagedata['cat_name']['parent'] = $this->mCat->getRow('cat_id, cat_name', array('parent_id' => $this->pagedata['cat_name']['self']['parent_id']));
            $this->pagedata['cat_title'] = '';
        } else {
            $this->pagedata['cat_title'] = '一级分类';
            return $this->mCat->get_tree();
        }
    }

    public function index($fix_brand = false) {
        $params = utils::_filter_input($_GET);
        $this->pagedata['search_info'] = $this->_init_crumbs($params);
        $query_str = $this->_query_str($params);
        $this->pagedata['query'] = $this->_query_str($params, 0);
        $params = $this->_params_decode($params);
        $this->pagedata['cat'] = $this->_get_cat($params['cat']);
        $filter = $params['filter'];
        if (!$fix_brand && $filter['cat_id']) {
            $mdl_cat = $this->app->model('goods_cat');
            $cat_info = $mdl_cat->dump($filter['cat_id']);
            if ($cat_info['gallery_setting']['site_template']) {
                $this->set_tmpl_file($cat_info['gallery_setting']['site_template']); //设置模板文件
            }
            $this->seo_info = $cat_info['seo_info'];
            $this->pagedata['cat_path'] = $mdl_cat->getPath($filter['cat_id']);
        } elseif ($fix_brand) {
            $filter['brand_id'] = $fix_brand;
        }
//by bibin 2015/10/10  只显示审核通过的商品
        $filter['checkin'] = '1';
//>>

        $goods_list = $this->_list($filter, $params['page'], $params['orderby']);
        
        $this->pagedata['data_list'] = $goods_list['data'];
        $this->pagedata['count'] = $goods_list['count'];
        $this->pagedata['all_count'] = $goods_list['all_count'];
        $this->pagedata['pager'] = $goods_list['page_info'];
        $this->pagedata['pager']['token'] = time();
        $this->pagedata['pager']['link'] = $this->gen_url(array(
                    'app' => 'b2c',
                    'ctl' => 'site_list',
                    'act' => 'index',
                    'full' => 1,
                )) . '?page=' . $this->pagedata['pager']['token'] . ($query_str ? '&' . $query_str : '');
        if (!$fix_brand) {
//$this->pagedata['data_screen'] = $this->_screen_data_by_cat($filter['cat_id']);
        } else {
            $brand = app::get('b2c')->model('brand')->dump($fix_brand);
            $this->pagedata['brand'] = $brand;
//$this->pagedata['data_screen'] = $this->_screen_data_by_brand($fix_brand);
            $this->set_tmpl('brandlist'); //锁定品牌型列表模板
            $brand_setting = $brand['brand_setting'];
            if ($brand_setting['site_template']) {
                $this->set_tmpl_file($brand_setting['site_template']);
            }
        }
//seo
        $this->generate_seo_data();
        $this->page('site/list/index.html');
    }

    /*
     * 根据分类ID提供筛选条件，并且返回已选择的条件数据
     *
     * @params int $cat_id 分类ID
     * @params array $filter 已选择的条件
     * */
    private function _screen_data_by_cat($cat_id)
    {
        //分类
        if ($cat_list = $this->app->model('goods_cat')->getList('cat_id,cat_name', array(
            'parent_id' => ($cat_id ? $cat_id : 0),
        ))) {
            $_return['cat_id']['title'] = '分类';
            foreach ($cat_list as $value) {
                $_return['cat_id']['options'][$value['cat_id']] = $value['cat_name'];
            }
        }
        $filter = array();
        if ($cat_id) {
            $filter['cat_id'] = $cat_id;
        }
        $gprops_arr = $this->app->model('goods')->lw_getList('brand_id,type_id,cat_id', $filter);
        foreach ($gprops_arr as $arr) {
            if ($cat_id == $arr['cat_id']) {
                //仅取得当前分类下相关类型//TODO 可配置
                $type_id_arr[] = $arr['type_id'];
            }
            $brand_id_arr[] = $arr['brand_id'];
        }
        //品牌
        if ($brands = $this->app->model('brand')->getList('brand_id,brand_name', array(
            'brand_id' => $brand_id_arr,
            'disabled' => 'false',
        ))) {
            $_return['brand_id']['title'] = '品牌';
            foreach ($brands as $key => $value) {
                $_return['brand_id']['options'][$value['brand_id']] = $value['brand_name'];
            }
        }
        //扩展属性
        if ($type_id_arr) {
            foreach ($type_id_arr as $type_id) {
                $type_info = $this->app->model('goods_type')->dump2(array(
                    'type_id' => $type_id,
                ));
                $props = $type_info['props'];
                foreach ($props as $key => $prop) {
                    $_return['p_'.$key]['title'] = $prop['name'];
                    $_return['p_'.$key]['options'] = $prop['options'];
                }
            }
        }

        return $_return;
    }
    
    /*
     * 根据品牌ID提供筛选条件，并且返回已选择的条件数据
     *
     * @params int $brand 品牌ID
     * @params array $filter 已选择的条件
     * */

    private function _screen_data_by_brand($brand_id) {
        $filter = array();
        if ($brand_id) {
            $filter['brand_id'] = $brand_id;
        }
        $gprops_arr = $this->app->model('goods')->lw_getList('brand_id,type_id', $filter);
        $type_id_arr = array_keys(utils::array_change_key($gprops_arr, 'type_id'));
//扩展属性
        if ($type_id_arr) {
            foreach ($type_id_arr as $type_id) {
                $type_info = $this->app->model('goods_type')->dump2(array(
                    'type_id' => $type_id,
                ));
                $props = $type_info['props'];
                foreach ($props as $key => $prop) {
                    $_return['p_' . $key]['title'] = $prop['name'];
                    $_return['p_' . $key]['options'] = $prop['options'];
                }
            }
        }

        return $_return;
    }

//商品列表页筛选参数处理
    private function handle_params($params) {
        $filter = array(
            'cat_id' => '',
            'brand_id' => '',
            'price_id' => '',
            'weight_id' => '',
            'origin_id' => '',
        );
        return array_merge($filter, $params);
    }

//获取商品列表，包装商品列表
    private function _list($filter, $page, $orderby, $keywords) {
        $cache_key = utils::array_md5(func_get_args());
        if (cachemgr::get($cache_key, $return)) {
            return $return;
        }
        cachemgr::co_start();
        if ($keywords) {
            $goods_keywords = $this->app->model('goods_keywords');
            $goods = $goods_keywords->getList('goods_id', array('keyword|has' => $keywords, 'res_type' => 'goods'));
            foreach ($goods as $key => $value) {
                $filter['goods_id|in'][$key] = $value['goods_id'];
            }
        }
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
        $return = array(
            'data' => $goods_list,
            'count' => count($goods_list),
            'all_count' => $total,
            'page_info' => array(
                'total' => ($total ? ceil($total / $page['size']) : 1),
                'current' => intval($page['index']),
            ),
        );
        cachemgr::set($cache_key, $return, cachemgr::co_end());
//print_r($return['data']);
        return $return;
    }

    private function _query_str($params, $nopage = true) {
        if ($nopage) {
            unset($params['page']);
        }

        return http_build_query($params);
    }

//配置参数
    private function _params_decode($params) {
//排序
        $orderby = str_replace('-', ' ', $params['orderby']);
        unset($params['orderby']);
//分页,页码
        $page['index'] = $params['page'] ? $params['page'] : 1;
        $page['size'] = $params['page_size'] ? $params['page_size'] : 20;
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
     * 设置列表页SEO
     *
     * */

    private function generate_seo_data() {

        if (isset($this->seo_info) && !empty($this->seo_info) && !empty($this->seo_info['seo_title'])) {

            $this->title = $this->seo_info['seo_title'];
            $this->keywords = $this->seo_info['seo_keywords'];
            $this->description = $this->seo_info['seo_description'];

            return;
        }


        $pagedata = $this->pagedata;
        $cat_path = array();
        $cat = array();
        $brand = array();
        if (isset($pagedata['cat_path'])) {
            foreach ($pagedata['cat_path'] as $key => $value) {
                $cat_path[] = $value['title'];
            }
        }
        if (empty($cat_path)) {
            $cat_path = array('全部分类');
        }

        if (isset($pagedata['data_screen'])) {
            foreach ($pagedata['data_screen'] as $key => $value) {
                switch ($key) {
                    case 'cat_id':
                        $cat = array_values($value['options']);
                        break;
                    case 'brand_id':
                        $brand = array_values($value['options']);
                        break;
                }
            }
        }
        $seo_data = array(
            'goods_cat' => implode('_', $cat), //ENV_goods_cat
            'goods_cat_path' => implode('_', $cat_path), //ENV_goods_cat_path
            'goods_brand' => implode('_', $brand), //ENV_goods_brand
        );

        $this->setSeo('site_list', 'index', $seo_data);
    }

    /**
     * 相关商品
     */
    public function goods_rate() {
        $goods_api = vmc::singleton('b2c_source_goods');
        return $goods_api->goods_rate($_GET);
    }

    /**
     * 商品促销
     */
    public function promotions() {
        $goods_api = vmc::singleton('b2c_source_goods');
        return $goods_api->promotions($_GET);
    }

}
