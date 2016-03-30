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

class b2c_ctl_site_list extends b2c_frontpage
{

    public $title = '商品列表';

    public function __construct(&$app)
    {
        parent::__construct($app);
        $this->app = $app;
        $this->_response->set_header('Cache-Control', 'no-store');
        $this->mCat = $this->app->model('goods_cat');
        $this->objSearch = vmc::singleton('b2c_goods_search');
        $this->set_tmpl('list');
    }


    private function _get_cat($cat_id)
    {
        if (!empty($cat_id) && is_numeric($cat_id)) {
            //记录父级分类名称，分类面包屑显示
            $cat['catPath'] = $this->mCat->getPath($cat_id);
            $cat['cat'] = $this->mCat->children($cat_id);
        } else {
            $cat['cat'] = $this->mCat->get_tree();
        }
        return $cat;
    }


    public function index($fix_brand = false)
    { 	
        /**
         * 润和接口
         * IPD141129 货品（商品特征）
         * IPD141111 产品查询价盘_接口定义
         * IPD141115 产品信息
         * 品牌列表
         * ISO151416 订单数
         * IPD141114 2 物流区
         */

        $params = utils::_filter_input($_GET);
        //属性查找面包屑组合
        $search_info = $this->objSearch->init_crumbs($params);
        //参数组合
        $query_str = $this->objSearch->query_str($params);
        //配置参数
        $params = $this->objSearch->params_decode($params);
        $this->pagedata['search_info'] = $search_info;
        $this->pagedata['query'] = $query_str;
        $this->pagedata['cat'] = $this->_get_cat($params['cat']);
        $this->pagedata['serach_keywords'] = $params['keywords'];
        $this->pagedata['serach_type'] = $params['type'];
        $this->pagedata['search_having'] = $params['having'];
        if (!$fix_brand && $params['filter']['cat_id']) {
            $mdl_cat = $this->app->model('goods_cat');
            $cat_info = $mdl_cat->dump($params['filter']['cat_id']);
            if ($cat_info['gallery_setting']['site_template']) {
                $this->set_tmpl_file($cat_info['gallery_setting']['site_template']); //设置模板文件
            }
            $this->seo_info = $cat_info['seo_info'];
            $this->pagedata['cat_path'] = $mdl_cat->getPath($params['filter']['cat_id']);
        } elseif ($fix_brand) {
            $params['filter']['brand_id'] = $fix_brand;
        }
        $params['keywords'] = array('keywords' => $params['keywords'], 'having' => $params['having']);

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
        !isset($params['sg']) && $params['sg'] = 'g';
        //seo
        $this->generate_seo_data();
        if ($params['type'] == 'store') {
            $this->pagedata['storeList'] = $this->objSearch->search_store($params);
            $page = 'store';
        } else {
            $goods_list = $this->objSearch->goods_list($params);
            if (!empty($goods_list)) {
                $this->pagedata['show_type'] = $params['sg'];
                $this->pagedata['data_list'] = $goods_list['data'];
                $this->pagedata['count'] = $goods_list['count'];
                $this->pagedata['all_count'] = $goods_list['all_count'];
                $this->pagedata['page_index'] = $params['page']['index'];
                $this->pagedata['pager'] = $goods_list['page_info'];
                $this->pagedata['pager']['token'] = time();
            }
            $page = 'index';
        }
        $this->pagedata['buyer_id'] = vmc::singleton('buyer_user_object')->get_session();
        $this->pagedata['pager']['link'] = $this->gen_url(array(
                'app' => 'b2c',
                'ctl' => 'site_list',
                'act' => 'index',
                'full' => 1,
            )) . '?page=' . $this->pagedata['pager']['token'] . ($query_str ? '&' . $query_str : '');
        $this->page("site/list/{$page}.html");
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
        ))
        ) {
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
        ))
        ) {
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
                    $_return['p_' . $key]['title'] = $prop['name'];
                    $_return['p_' . $key]['options'] = $prop['options'];
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

    private function _screen_data_by_brand($brand_id)
    {
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
    private function handle_params($params)
    {
        $filter = array(
            'cat_id' => '',
            'brand_id' => '',
            'price_id' => '',
            'weight_id' => '',
            'origin_id' => '',
        );
        return array_merge($filter, $params);
    }

    /*
     * 设置列表页SEO
     *
     * */

    private function generate_seo_data()
    {

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
    public function goods_rate()
    {
        $goods_api = vmc::singleton('b2c_source_goods');
        return $goods_api->goods_rate($_GET);
    }

    /**
     * 商品促销
     */
    public function promotions()
    {
        $goods_api = vmc::singleton('b2c_source_goods');
        return $goods_api->promotions($_GET);
    }

}
