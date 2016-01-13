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
// | Description 商家商品申请
// +----------------------------------------------------------------------

class seller_ctl_site_goods extends seller_frontpage {

    public function __construct(&$app) {
        parent::__construct($app);
        $this->app = $app;
        $this->verify();
        $this->mB2cGoods = app::get('b2c')->model('goods');
        $this->mStoreGoods = app::get('store')->model('goods');
    }

    //商品页
    public function index() {
        // 入商品库
        $serach = $_POST['goods'] ? $_POST['goods'] : '';
        $this->pagedata['goodList'] = $this->_good_list(1, $serach);
        $this->output();
    }

    private function _good_list($type, $serach) {
        $brandList = app::get('b2c')->model('brand')->getList('brand_id, brand_name');
        $store_goods_cat = app::get('b2c')->model('goods_cat')->getList('*');
        $mdl_product = app::get('b2c')->model('products');
        $mdl_stock = app::get('b2c')->model('stock');
        $filter['marketable'] = 'false';
        if ($type) {
            $filter['marketable'] = 'true';
            $filter['checkin'] = $type;
        }
        if ($serach) {
            $this->pagedata['serach'] = $serach;
            if ($serach['price']) {
                if (is_numeric($serach['price'][0]) && is_numeric($serach['price'][1])) {
                    $price['price|between'] = $serach['price'];
                    $goods_id = $mdl_product->getList('goods_id', $price);
                    if (!$goods_id)
                        return array();
                }
            }
            if ($serach['buy_count']) {
                if (is_numeric($serach['buy_count'][0]) && is_numeric($serach['buy_count'][1])) {
                    $filter['buy_coun|between'] = $serach['buy_count'];
                }
            }
            $tmp = Array();
            foreach ($goods_id as $k => $v) {
                array_push($tmp, $v['goods_id']);
                $tmp = array_unique($tmp);
            }
            $filter['goods_id|in'] = $tmp;
            $filter['name|has'] = $serach['name'];
            $filter['gid'] = $serach['gid'];
        }

        $filter['store_id'] = $this->store['store_id'];
        $filter['seller_id'] = $this->seller['seller_id'];
        $goodsList = $this->mB2cGoods->getList('*', $filter);

        foreach ($goodsList as $key => $value) {
            $product = $mdl_product->getList('barcode', array('goods_id' => $value['goods_id']));
            foreach ($product as $k => $v) {
                $barcode['barcode'][$k] = $v['barcode'];
            }
            $stock = $mdl_stock->getRow('sum(quantity) as stock', array('barcode|in' => $barcode['barcode']));
            $goodsList[$key]['stock'] = $stock['stock'];
            foreach ($brandList as $k => $v) {
                if ($value['brand_id'] == $v['brand_id']) {
                    $goodsList[$key]['brand_id'] = $v['brand_name'];
                }
            }
            foreach ($store_goods_cat as $k => $v) {
                if ($value['cat_id'] == $v['cat_id']) {
                    $goodsList[$key]['cat_id'] = $v['cat_name'];
                }
            }
        }
        return $goodsList;
    }

    //添加商品
    public function add($goods_id) {
        $this->pagedata['goods'] = $this->mB2cGoods->dump($goods_id, '*', 'default');
        $this->pagedata['params'] = $this->basic();

        foreach ($this->pagedata['goods']['product'] as &$value) {
            $value['spec'] = explode('/', $value['spec_info']);
        }
        $this->pagedata['_PAGE_'] = 'from.html';
        $this->_editor();
        $this->output();
    }

    //获取商品添加所需基本参数
    private function basic() {
        $return = array();
        //商品类目
        $mdl_goods_cat = app::get('b2c')->model('goods_cat');
        $return['cat'] = $mdl_goods_cat->get_tree();
        foreach ($return['cat'] as &$value) {
            $value['son'] = $mdl_goods_cat->children($value['cat_id']);
        }

        $return['setting'] = $this->app->getConf('goods_setting');
        //商品品牌
        $return['brand'] = $this->app->model('brand')->getList('*', array('seller_id' => $this->seller['seller_id']));
        //商品参数配置
        $return['goods_type'] = app::get('b2c')->model('goods_type')->getList('*');
        $type_props = app::get('b2c')->model('goods_type_props');
        foreach ($return['goods_type'] as &$value) {
            if ($return['setting']['prop'][$value['name']]) {
                $value['cloumns_name'] = $return['setting']['prop'][$value['name']];
            }
            $value['son'] = $type_props->getList('*', array('type_id' => $value['type_id']));
        }
        //店铺信息
        $return['store'] = app::get('store')->model('store')->getRow('*', array('seller_id' => $this->seller['seller_id']));
        $store_type = app::get('store')->getConf('store_type');
        $return['store']['store_type'] = $store_type[$return['store']['store_type']]['name'];
        //获取展示位置
        return $return;
    }

    //商品目录
    public function directory() {
        if ($_POST) {
            $this->edit_directory($_POST);
        }
        //查询自己的店铺分类
        $mdl_store = app::get('store')->model('store');
        $store_id = $mdl_store->getRow('store_id', array('seller_id' => $this->seller['seller_id']));
        $store_tree = app::get('store')->model('goods_cat');
        $this->pagedata['this_cat'] = $store_tree->get_tree('', null, $store_id['store_id']);
        $this->pagedata['info'] = $this->basic();
        $this->output();
    }

    private function edit_directory($post) {
        $redirect = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_goods', 'act' => 'directory'));
        $db = vmc::database();
        $db->beginTransaction();
        $mdl_store = app::get('store')->model('store');
        $mdl_store_cat = app::get('store')->model('goods_cat');
        $store_id = $mdl_store->getRow('store_id', array('seller_id' => $this->seller['seller_id']));
        foreach ($post['cat'] as $value) {

            $count = 0;
            foreach ($value['parent'] as $v) {
                !empty($v['check']) && $count ++;
                if (empty($v['check']) && empty($v['id'])) {
                    continue;
                }
                if (empty($v['check'])) {
                    if (!$mdl_store_cat->remove($v['cat_id'], $store_id['store_id'], $msg)) {
                        $db->rollback();
                        $this->splash('error', $redirect, $msg);
                    }
                } else if (empty($v['id'])) {
                    $son_data = array(
                        'cat_id' => $v['cat_id'],
                        'cat_name' => $v['cat_name'],
                        'store_id' => $store_id['store_id'],
                        'is_leaf' => 'true',
                        'cat_path' => ',' . $value['cat_id'] . ',',
                        'parent_id' => $value['cat_id'],
                    );
                    if (!$mdl_store_cat->save($son_data)) {
                        $db->rollback();
                        $this->splash('error', $redirect, '操作失败');
                    }
                }
            }
            if (!$count) {
                continue;
            }
            extract($value);
            $parent_data = array(
                'cat_id' => $cat_id,
                'cat_name' => $cat_name,
                'child_count' => $count,
                'store_id' => $store_id['store_id'],
                'is_leaf' => 'true',
                'parent_id' => '0',
                'id' => $value['id']
            );

            if (!$mdl_store_cat->save($parent_data)) {
                $db->rollback();
                $this->splash('error', $redirect, '操作失败');
            }
        }
        $db->commit();
        $this->splash('success', $redirect, '操作成功');
    }

    public function save($type = null) {
        $redirect_url = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_goods', 'act' => $type ? 'add' : 'index'));
        if (!$_POST) {
            $this->splash(false, $redirect_url, '非法请求');
        }
        print_r($_POST['goods']);
        $objModule = vmc::singleton('seller_goods_module');
        $objModule->init($_POST['goods']);
        $methods = get_class_methods($objModule);
        foreach ($methods as $func) {
            $objModule->$func();
        }
        print_r($objModule);
        die;
        //检查是否填写了商品编号没有生成有检查是否重复
//        $goods = $objGoodsData->prepare($_POST);        
//        $goods = $objGoodsData->checkin();
//        $objGoodsData = vmc::singleton('seller_goods_data');
//        $goods = array_merge($goods, array(
//            'seller_id' => $this->seller['seller_id'],
//            'store_id' =>  $this->store['store_id']
//        ));
//        //var_dump($return);die;
//        
//        if (!$this->mB2cGoods->save($goods)) {
//            return ('保存失败!');
//        }
//        //保存商家商品
//        //if(!$this->mStoreGoods->save())
//        
//        if ($return) {
//            $this->splash('error', '', $return);
//        }        
//        $this->splash('success', $redirect_url, '商品添加成功');
    }

    //修改
    public function edit() {
        
    }

    //商品上下架
    public function marketable($goods_id, $type) {
        $redirect_url = array('app' => 'seller', 'ctl' => 'site_goods', 'act' => $type == 'dn' ? 'index' : 'storage');
        if (!$goods_id || !$type)
            $this->splash('error', $redirect_url, '非法请求');
        $update_value['marketable'] = $type == 'up' ? true : false;
        $update_value[$type == 'up' ? 'uptime' : 'downtime'] = time();
        $filter = array(
            'goods_id' => $goods_id,
            'store_id' => $this->store['store_id'],
        );
        if (!$this->mB2cGoods->update($update_value, $filter)) {
            $this->splash('error', $redirect_url, '操作失败');
        }
        $this->splash('success', $redirect_url);
    }

    //删除
    public function del() {
        
    }

    //商品库存
    public function stock() {
        $this->output();
    }

    //仓库中的商品
    public function storage() {
        $this->pagedata['type'] = 'storage';
        $serach = $_POST['goods'] ? $_POST['goods'] : '';
        $this->pagedata['goodList'] = $this->_good_list(null, $serach);
        $this->pagedata['_PAGE_'] = 'index.html';
        $this->output();
    }

    //价格修改
    public function price() {
        $this->output();
    }

    //价格修改记录
    public function modify_record() {
        $this->output();
    }

    private function _editor() {
        $this->pagedata['sections'] = array(
            'basic' => array(
                'label' => ('基本信息'),
                'file' => 'site/goods/goods/basic.html',
            ),
            'content' => array(
                'label' => ('图文介绍'),
                'file' => 'site/goods/goods/content.html',
            ),
            'params' => array(
                'label' => ('属性参数'),
                'file' => 'site/goods/goods/params.html',
            ),
            'template' => array(
                'label' => ('展示模板'),
                'file' => 'site/goods/goods/template.html',
            ),
            'rel' => array(
                'label' => ('相关商品'),
                'file' => 'site/goods/goods/rel.html',
            ),
            'price' => array(
                'label' => ('价格修改'),
                'file' => 'site/goods/goods/price.html',
            ),
        );
    }

}
