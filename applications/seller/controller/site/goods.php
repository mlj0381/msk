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

class seller_ctl_site_goods extends seller_frontpage
{

    public function __construct(&$app)
    {
        parent::__construct($app);
        $this->app = $app;
        $this->verify();
        $this->mB2cGoods = app::get('b2c')->model('goods');
        $this->mStoreGoods = app::get('store')->model('goods');
    }

    //商品页
    public function index($page = 1)
    {
        // 入商品库
        !is_numeric($page) && $page = 1;
        $search = $_POST['goods'] ? $_POST['goods'] : '';
        $mdl_goods_cat = app::get('b2c')->model('goods_cat');
        $this->pagedata['cat'] = $mdl_goods_cat->get_tree();
        $this->pagedata['goodList'] = $this->_good_list(1, $search, $page);
        $this->output();
    }

    private function _good_list($type, $search, $page)
    {
        $limit = 8;
        $store_goods_cat = app::get('b2c')->model('goods_cat')->getList('*');
        $mdl_product = app::get('b2c')->model('products');
        $filter['marketable'] = 'false';
        if ($type) {
            $filter['marketable'] = 'true';
            $filter['checkin'] = $type;
        }
        if ($search) {
            $this->pagedata['serach'] = $search;
            if ($search['price'] && is_numeric($search['price'][0]) && is_numeric($search['price'][1])) {

                $price['price|between'] = $search['price'];
            }

            if ($search['buy_count']) {
                if (is_numeric($search['buy_count'][0]) && is_numeric($search['buy_count'][1])) {
                    $filter['buy_coun|between'] = $search['buy_count'];
                }
            }

            $filter['name|has'] = $search['name'];
            $filter['gid'] = $search['gid'];
            $filter['cat_id'] = $search['cat_id'];
        }
        $price['is_default'] = 'true';
        $tmp = $mdl_product->getList('*', $price);
        if (!$tmp) {
            return array();
        }
        $product = Array();

        foreach ($tmp as $k => $v) {
            $product['goods_id'][$k] = $v['goods_id'];
            $product['product'][$v['goods_id']] = $v;
        }
        $filter['goods_id|in'] = $product['goods_id'];
        $filter['store_id'] = $this->store['store_id'];
        $filter['seller_id'] = $this->seller['seller_id'];
        $goodsList = $this->mB2cGoods->getList('*', $filter, (($page - 1) * $limit), $limit);
        $this->pagedata['pager']['total'] = ceil($this->mB2cGoods->count($filter) / $limit);
        $this->pagedata['pager']['current'] = $page;
        $this->pagedata['pager']['token'] = time();
        $this->pagedata['pager']['link'] = $this->gen_url(array(
                'app' => 'seller',
                'ctl' => 'site_goods',
                'act' => 'index',
                'args0' => $this->pagedata['pager']['token']
            ));
        foreach ($goodsList as $key => $value) {
            $goodsList[$key]['price_interval'] = $product['product'][$value['goods_id']]['price_interval'];
            $goodsList[$key]['price_up'] = $product['product'][$value['goods_id']]['price_up'];
            $goodsList[$key]['price_dn'] = $product['product'][$value['goods_id']]['price_dn'];
            $goodsList[$key]['product_id'] = $product['product'][$value['goods_id']]['product_id'];
            foreach ($store_goods_cat as $k => $v) {
                if ($value['cat_id'] == $v['cat_id']) {
                    $goodsList[$key]['cat_id'] = $v['cat_name'];
                    break;
                }
            }
        }
        return $goodsList;
    }

    //添加商品
    public function add($goods_id)
    {
        if (is_numeric($goods_id)) {
            $this->pagedata['goods'] = $this->mB2cGoods->dump($goods_id, '*', 'default');
            //获取商品库存信息
            $mdl_stock = app::get('b2c')->model('stock');
            foreach ($this->pagedata['goods']['product'] as &$value) {
                $value['stock'] = $mdl_stock->getRow('*', array('sku_bn' => $value['bn'], 'warehouse' => $this->store['store_id']));
            }
            foreach ($this->pagedata['goods']['product'] as &$value) {
                $value['spec'] = explode('/', $value['spec_info']);
            }
        }
        $this->pagedata['params'] = $this->basic();
        $this->pagedata['_PAGE_'] = 'from.html';
        $this->_editor();
        $this->output();
    }

//    public function selfParams()
//    {
//        //商品参数配置
//
//        $cat_id = $_POST['cat_id'];
//        $mdl_goods_type = app::get('b2c')->model('goods_type');
//        $return = $mdl_goods_type->getRow('*', array('cat' => $cat_id));
//        $return['son'] = $mdl_goods_type->get_props($return['type_id']);
//        $this->splash('success', '', $return);
//    }

    //获取商品添加所需基本参数
    private function basic()
    {
        $return = array();
        //商品类目
        $mdl_goods_cat = app::get('b2c')->model('goods_cat');
        $return['cat'] = $mdl_goods_cat->get_tree('', null);

        //商品品牌
        $return['brand'] = $this->app->model('brand')->getList('*', array('seller_id' => $this->seller['seller_id']));
        //商品参数配置
        $return['goods_type'] = $this->getProp();
        $mdl_goods_type = app::get('b2c')->model('goods_type');
        //商品规格
        $return['goods_norms'] = $mdl_goods_type->getList('*', array('cat' => '0', 'belong_type' => '1'));
        foreach ($return['goods_norms'] as &$value) {
            $value = $mdl_goods_type->get_props($value['type_id']);
        }
        //店铺信息
        $return['store'] = app::get('store')->model('store')->getRow('*', array('seller_id' => $this->seller['seller_id']));
        $store_type = app::get('store')->getConf('store_type');
        $return['store']['store_type'] = $store_type[$return['store']['store_type']]['name'];
        //获取展示位置
        $return['setting'] = $this->app->getConf('goods_setting');

        //获取仓库信息

        return $return;
    }

    public function getProp(){
        $filter = array('cat' => '0', 'belong_type' => '0');
        $mdl_goods_type = app::get('b2c')->model('goods_type');

            //ajax调用
        $filter['cat'] = $this->_request->get_get('cat_id') ?: 0;

        $return = $mdl_goods_type->getList('*', $filter);
        foreach ($return as &$value) {
            $value = $mdl_goods_type->dump($value['type_id'], '*');
        }
        if($filter['cat']){
//            $this->pagedata['params']['goods_type'] = $return;
//            $this->display('site/goods/detail/params.html');die;
            $this->splash('success', '', $return);
            die;
        }
        return $return;
    }

    //商品目录
    public function directory()
    {
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

    private function edit_directory($post)
    {
        $redirect = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_goods', 'act' => 'directory'));
        $db = vmc::database();
        $db->beginTransaction();
        $mdl_store = app::get('store')->model('store');
        $mdl_store_cat = app::get('store')->model('goods_cat');
        $store_id = $mdl_store->getRow('store_id', array('seller_id' => $this->seller['seller_id']));
        foreach ($post['cat'] as $value) {

            $count = 0;
            foreach ($value['parent'] as $v) {
                !empty($v['check']) && $count++;
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

    public function save($type = null)
    {
        header('Content-Type:text/html;charset=utf-8');

        $redirect_url = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_goods', 'act' => $type ? 'add' : 'index'));
        if (!$_POST) {
            $this->splash(false, $redirect_url, '非法请求');
        }
        //检查是否填写了商品编号没有生成有检查是否重复
        $objGoodsData = vmc::singleton('seller_goods_data');
        $goods = $objGoodsData->prepare_goods_data($_POST);
        $goods = array_merge($goods, array(
            'seller_id' => $this->seller['seller_id'],
            'store_id' => $this->store['store_id']
        ));

        $objGoodsData->checkin($goods);

        $db = vmc::database();
        $db->beginTransaction();

        if (!$this->mB2cGoods->save($goods)) {
            $db->rollback();
            $this->splash('error', $redirect_url, '保存失败');
        }

        //更新店铺商品表
        $mdl_store_goods = app::get('store')->model('goods');
        $store_data['seller_id'] = $goods['seller_id'];
        $store_data['store_id'] = $goods['store_id'];
        $store_data['goods_id'] = $goods['goods_id'];
        $check = $mdl_store_goods->getRow('id', $store_data);
        !empty($check) && $store_data['id'] = $check['id'];
        $store_data['create_time'] = time();
        $store_data['showcase'] = $goods['showcase'];

        if (!$mdl_store_goods->save($store_data)) {
            $db->rollback();
            $this->splash('error', $redirect_url, '保存失败');
        }

        //更新库存表
        $mdl_stock = app::get('b2c')->model('stock');
        foreach ($goods['product'] as $value) {
            $stockData = array(
                'title' => $goods['name'],
                'sku_bn' => $value['bn'],
                'quantity' => $value['quantity'],
                'warehouse' => $goods['store_id'],
                'stock_id' => $value['stock_id'],
            );
            if (!$mdl_stock->save($stockData)) {
                $db->rollback();
                $this->splash('error', $redirect_url, '保存失败');
            }
        }
        $db->commit();
        $this->splash('success', $redirect_url, '商品添加成功');
    }

    //ajax检查商品gid
    public function check_gid(){

        $params = $this->_request->get_get();
        $goods_id = $params['goods']['gid'];
        if (!empty($goods_id) && $this->mB2cGoods->count(array('gid' => $goods_id)) > 0) {
            $this->splash('error', '',  '重复的商品ID'.$goods_id);
        }
        $this->splash('success', '',  '可用');
    }
    //ajax检查商品货品
    public function check_bn(){

    }

    //修改
    public function edit()
    {

    }

    //商品上下架
    public function marketable($goods_id, $type)
    {
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
    public function del()
    {

    }

    //商品库存
    public function stock()
    {
        $this->output();
    }

    //仓库中的商品
    public function storage()
    {
        $this->pagedata['type'] = 'storage';
        $search = $_POST['goods'] ? $_POST['goods'] : '';
        $this->pagedata['goodList'] = $this->_good_list(null, $search);
        $this->pagedata['_PAGE_'] = 'index.html';
        $this->output();
    }

    //价格修改
    public function price($goods_id)
    {
        $params = $this->_request->get_get();
        if (is_numeric($goods_id)) {
            $this->pagedata['goods'] = $this->mB2cGoods->dump($goods_id, '*', 'default');
        } else {
            $page = $params['page'] ? $params['page'] : 1;
            $this->pagedata['goods_list'] = $this->_good_list(1, '', $page);
            $this->pagedata['pager']['token'] = time();
            $this->pagedata['pager']['current'] = $page;
            $this->pagedata['pager']['link'] = $this->gen_url(
                    array('app' => 'seller', 'ctl' => 'site_goods', 'act' => 'price')
                ) . '?page=' . $this->pagedata['pager']['token'];
            $this->pagedata['_PAGE_'] = 'goods_price.html';
        }
        $this->output();
        // $redirect = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_goods', 'act' => 'index'));
        //!is_numeric($goods_id) && $this->splash('error', $redirect, '非法请求');

    }

    //价格修改记录
    public function modify_record($goods_id)
    {
        !is_numeric($goods_id) && $this->splash('error', '', '参数错误，非法请求');
        $product_list = app::get('b2c')->model('products')->getList('product_id', array('goods_id' => $goods_id));
        $mdl_goods = app::get('b2c')->model('goods');
        $result = array();
        $result['gid'] = $mdl_goods->getRow('gid', array('goods_id', $goods_id));
        foreach ($product_list as $key => $value) {
            base_kvstore::instance('goods_price')->fetch("goods_price_{$this->store['store_id']}_{$value['product_id']}", $data);

            if (!empty($data)) {
                $result['products'][] = $data;

            }
        }
        $this->pagedata['product_list'] = $result;
        $this->output();
    }


    private function _editor()
    {
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

    //价格修改
    public function edit_price($product_id)
    {
        !is_numeric($product_id) && die('参数错误，非法请求');
        $this->pagedata['product'] = app::get('b2c')->model('products')->getRow('*', array('product_id' => $product_id));
        $this->display('site/goods/edit_price.html');
    }

    //价格保存
    public function save_price()
    {
        extract($_POST);
        $redirect = $this->gen_url(
            array('app' => 'seller',
                'ctl' => 'site_goods',
                'act' => 'price',
                'args0' => $product['goods_id']));
        if (empty($_POST)) $this->splash('error', $redirect, '非法请求');
        $mdl_product = app::get('b2c')->model('products');
        if(!$mdl_product->save($product)){
            $this->splash('error', $redirect, '操作失败');
        }
        $product['createTime'] = time();
        base_kvstore::instance('goods_price')->fetch("goods_price_{$this->store['store_id']}_{$product['product_id']}", $products);
        if(empty($products)){
            $products = array( 0 => $product);
        }else{
          array_unshift($products, $product);
        }
        $result = base_kvstore::instance('goods_price')->store("goods_price_{$this->store['store_id']}_{$product['product_id']}",
            $products);
        base_kvstore::instance('goods_price')->fetch("goods_price_{$this->store['store_id']}_{$product['product_id']}", $data);
        if ($result) {
            $this->splash('success', $redirect, '操作成功');
        }
        $this->splash('error', $redirect, '操作失败');
    }

}
