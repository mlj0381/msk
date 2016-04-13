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
        $search = $_POST['goods'] ?: '';
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

    /**
     * 获取分类下的特征，净重，包装信息
     * @params $cat
     */
    private function _getSpec($cat)
    {
        $feature = $this->getFeature(array('cat' => $cat));
        //print_r($feature);
        foreach ($feature as $v1) {
            $value = $cat . '-' . $v1['featureCode'];
            $tmp1[] = $this->getWeight(array('cat' => $value));
            $weights = $this->_unique($tmp1, 'weightCode', $v1['featureCode']);
            foreach ($weights as $v2) {
                $value = $cat . '-' . $v1['featureCode'] . '-' . $v2['weightCode'];
                $tmp2[] = $this->getPack(array('cat' => $value));
                $pack = $this->_unique($tmp2, 'normsCode', $v2['weightCode']);
            }
        }
        return array(
            'feature' => $feature,
            'weight' => $weights,
            'pack' => $pack,
        );
    }


    private function _unique($params, $key, $parent)
    {
        $tmp = Array();
        $index = 0;
        foreach ($params as $param) {
            foreach ($param as $v1) {
                $tmp[$index] = $v1;
                $tmp[$index]['parent'] = $parent;
                $index++;
            }
        }
        $tmp = utils::array_change_key($tmp, $key);
        return $tmp;
    }

    //添加商品
    public function add($goods_id)
    {
        /**
         * 润和接口
         * ISL231109 查询卖家产品和标准
         * IPD141129 货品（商品特征）
         * IPD141111 产品查询价盘_接口定义
         * IPD141115 产品信息
         * 品牌列表
         * IPD141114 2 物流区（仓库）
         */
        //base_kvstore::instance('seller_goods')->fetch('seller_' . $goods_id, $goods);
        if ($goods) return $goods;
        if (is_numeric($goods_id)) {
            $this->pagedata['goods'] = $this->mB2cGoods->dump($goods_id, '*', 'default');
            $this->pagedata['api_cat'] = $this->_getSpec($this->pagedata['goods']['api_cat']);
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
        $this->pagedata['seller_id'] = $this->seller['seller_id'];
        $this->pagedata['_PAGE_'] = 'new_from.html';

        $this->output();
    }

    //获取商品添加所需基本参数
    private function basic()
    {
        $return = array();
        //商品类目
        $mdl_goods_cat = app::get('b2c')->model('goods_cat');
        $return['cat'] = $mdl_goods_cat->get_tree('', null);

        //商品品牌
        $return['brand'] = app::get('b2c')->model('brand')->getList('*', array('seller_id' => $this->seller['seller_id']));
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
        /**
         * 调用润和接口 获取物流区信息
         */
        $dlyplace = app::get('b2c')->model('dlyplace')->get_api_area();
        $return['logistics'] = $dlyplace['logiAreaList'];
        return $return;
    }

    public function getProp()
    {
        $filter = array('cat' => '0', 'belong_type' => '0');
        $mdl_goods_type = app::get('b2c')->model('goods_type');

        //ajax调用
        $filter['cat'] = $this->_request->get_get('cat_id') ?: 0;

        $return = $mdl_goods_type->getList('*', $filter);
        foreach ($return as &$value) {
            $value = $mdl_goods_type->dump($value['type_id'], '*');
        }
        if ($filter['cat']) {
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
        /**
         * 润和接口 商品目录
         * 全部分类
         * IPD141101 一级目录
         * IPD141104 二级目录
         * IPD141128 三级目录
         *
         * 已添加的分类
         * 获取我已添加的分类 接口没有
         *
         * 添加分类
         * ISL231109 查询卖家产品和标准
         * ISL231106 编辑卖家产品和标准
         *
         * 展示店铺信息 我的品牌
         * ISL231149 查询企业产品品牌
         * ISL231153 查询卖家产品品牌
         * 店铺基本信息 自己数据库查询
         */
        if ($_POST) {
            $this->edit_directory($_POST);
        }
        //查询自己的店铺分类
        $store_tree = app::get('store')->model('goods_cat');
        $this->pagedata['this_cat'] = $store_tree->get_tree($this->seller['seller_id'], '', null);
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
        $redirect_url = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_goods', 'act' => $type ? 'add' : 'index'));
        if (!$_POST) {
            $this->splash(false, $redirect_url, '非法请求');
        }
        //检查是否填写了商品编号没有生成有检查是否重复
        $objGoodsData = vmc::singleton('seller_goods_data');
        $card = $_POST['card'];
        $goods = $objGoodsData->prepare_goods_data($_POST);
        $goods = array_merge($goods, array(
            'seller_id' => $this->seller['seller_id'],
            'store_id' => $this->store['store_id']
        ));

        $objGoodsData->checkin($goods);

        $db = vmc::database();
        $db->beginTransaction();
        //保存货品价盘

        if (!$this->mB2cGoods->save($goods)) {
            $db->rollback();
            $this->splash('error', $redirect_url, '保存失败');
        }


        if (!$objGoodsData->interval($goods)) {
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

        $goods['card'] = $card;
        if (!$this->_apiAddGoods1($goods)) {
            $this->splash('error', $redirect_url, '保存失败');
            $db->rollback();
        };
        $db->commit();
        base_kvstore::instance('seller_goods')->store('seller_' . $goods['goods_id'], $goods, 2592000);
        $this->splash('success', $redirect_url, '商品添加成功');
    }

    /**
     * 提交商品信息到api
     * @param $goods
     * @return bool
     */
    private function _apiAddGoods1($goods)
    {
        //print_r($goods);
        $api = Array();
        //基本信息
        $slPdList = Array();
        $catId = explode('-', $goods['api_cat']);
        //获取自己的企业id
        $company_id = app::get('base')->model('company')->getRow('ep_id', array('uid' => $this->seller['seller_id'], 'from' => '1'));
        $brand_id = $this->seller['ident'] == 1 ? $company_id['ep_id'] : $company_id['ep_id'];//查询品牌所属企业id
        foreach ($goods['product'] as $v) {
            $slPdList[] = array(
                'slCode' => $this->seller['sl_code'],
                'prodEpId' => (int)$company_id['ep_id'],
                'brandEpId' => (int)$brand_id,
                'brandId' => 111197,//todo 品牌id查询
                'pdClassesCode' => $catId[0],
                'machiningCode' => $catId[1],
                'pdBreedCode' => $catId[2],
                'pdFeatureCode' => substr($v['bn'], 5, 2),
                'weightCode' => substr($v['bn'], 7, 2),
                'distFlg' => '0', //神龙客分销
                'distmskFlg' => '0', //美侍客分销
                'loginId' => '1',
            );
        }

        $api['slPdList'] = $slPdList;
        $result = $this->app->rpc('edit_seller_product')->request($api);
        $product = Array();
        if ($result['status']) {
            foreach ($slPdList as $v) {

                //查询包装信息
                $data = array(
                    'classesCode' => $v['pdClassesCode'],
                    'machiningCode' => $v['machiningCode'],
                    'breedCode' => $v['pdBreedCode'],
                    'featureCode' => $v['pdFeatureCode'],
                    'weightCode' => $v['weightCode'],
                );
                $pack = app::get('b2c')->rpc('select_product_cat6')->request($data);
                foreach ($pack['result'] as $value) {
                    $product['pack'][] = $value['normsCode'];
                }

                //查询商品id
                $result = $this->app->rpc('select_seller_product')->request($v);
                foreach ($result['result']['slPdList'] as $value) {
                    $product['product'][] = $value['slPdId'];
                }
            }

            if ($this->_apiAddGoods2($goods, $product)) {
                return true;
            }
        }
        return false;
    }

    /**
     * 提交商品信息到api
     * @param $goods
     * @param $product
     * @return bool
     */
    private function _apiAddGoods2($goods, $product)
    {

        //获取产品标准id
        $result = app::get('b2c')->rpc('select_product_id')->request();
        foreach ($result['result']['searchList'] as $v) {
            if ($goods['api_cat'] == ($v['classesCode'] . '-' . $v['machiningCode'] . '-' . $v['breedCode'])) {
                $standardId = $v['standardId'];
            }
        }

        $mdl_b2c_goods = app::get('b2c')->model('goods');
//        $card = array(
//            //'apt_stock' => '',//
//            'apt_prove' => 'card_pd_org',//原种种源标准指标
//            'apt_raise' => 'card_pd_fed',//原种饲养标准指标
//            'apt_technology' => 'card_pd_mct',//产品加工技术标准指标
//            'apt_quality' => 'card_pd_tnc',//产品加工质量标准指标
//            'apt_common' => 'card_pd_gnq',//产品通用质量标准指标
//            'apt_safety' => 'card_pd_sft',//产品安全标准指标
//            'apt_transport' => 'card_pd_tsp',//储存运输标准指标
//        );

        //卖家产品加工技术标准指标
        $slPdMctList = $mdl_b2c_goods->fileCard('apt_technology', $goods['api_cat']);

        //卖家产品加工质量标准指标
        $slPdTncList = $mdl_b2c_goods->fileCard('apt_quality', $goods['api_cat']);

        //卖家原种种源标准
        $slPdOrgStdList = $mdl_b2c_goods->fileCard('apt_prove', $goods['api_cat']);

        //卖家产品饲养标准
        $slPdFedStdList = $mdl_b2c_goods->fileCard('apt_raise', $goods['api_cat']);

        //卖家产品通用质量标准
        $slPdGnqStdList = $mdl_b2c_goods->fileCard('apt_common', $goods['api_cat']);

        //卖家产品储存运输标准
        $slPdTspStdList = $mdl_b2c_goods->fileCard('apt_transport', $goods['api_cat']);

        //卖家产品安全标准
        $slPdSftStdList = $mdl_b2c_goods->fileCard('apt_safety', $goods['api_cat']);
        foreach ($product['product'] as $k => $v) {
            //卖家产品加工技术标准指标
            $api['slPdMctList'][$k] = array(
                'slCode' => $this->seller['sl_code'],
                'slPdId' => (int)$v,
                'slQltGradeCode' => $slPdMctList['mctList'][$goods['card']['pt_technology']]['mctStdItemId'],
                'loginId' => '1',
                'slPdMctStdList' => array(
                    array(
                        'slCode' => $this->seller['sl_code'],
                        'standardId' => (int)$standardId,
                        'stdItemId' => $slPdMctList['mctList'][$goods['card']['pt_technology']]['mctStdItemId'],
                        'agreeFlg' => '1',
                        'stdVal' => '',
                        'loginId' => '1',

                    ),
                ),
            );
            //卖家产品加工质量标准指标
            $api['slPdTncList'][$k] = array(
                'slCode' => $this->seller['sl_code'],
                'slPdId' => (int)$v,
                'loginId' => '1',
                'slTncGradeCode' => $slPdTncList['tncList'][$goods['card']['apt_quality']]['tncStdItemId'],
                'slPdTncStdList' => array(
                    array(
                        'slCode' => $this->seller['sl_code'],
                        'standardId' => (int)$standardId,
                        'stdItemId' => $slPdTncList['tncList'][$goods['card']['apt_quality']]['tncStdItemId'],
                        'agreeFlg' => '1',
                        'stdVal' => '',
                        'loginId' => '1',
                    ),
                ),
            );
            //卖家产品包装

            $api['slPdPkgList'][$k] = array(
                'slCode' => $this->seller['sl_code'],
                'slPdId' => (int)$v,
                'slPdPkgId' => '',
                'loginId' => '1',
                'standardId' => (int)$standardId,
                'pkgCode' => $product['pack'][$k],
            );


            //卖家原种种源标准
            $api['slPdOrgStdList'][$k] = array(
                'slCode' => $this->seller['sl_code'],
                'slPdId' => (int)$v,
                'loginId' => '1',
                'standardId' => (int)$standardId,
                'stdItemId' => $slPdOrgStdList['orgList'][$goods['card']['apt_prove']]['orgStdItemId'],  //0 1 2 三类标准
                'agreeFlg' => '1', //同意标致
            );

            //卖家产品饲养标准
            $api['slPdFedStdList'][$k] = array(
                'slCode' => $this->seller['sl_code'],
                'slPdId' => (int)$v,
                'loginId' => '1',
                'standardId' => (int)$standardId,
                'stdItemId' => $slPdFedStdList['fedList'][$goods['card']['apt_raise']]['fedStdItemId'],  //0 1 2 三类标准
                'agreeFlg' => '1', //同意标致
            );
            //卖家产品通用质量标准
            $api['slPdGnqStdList'][$k] = array(
                'slCode' => $this->seller['sl_code'],
                'slPdId' => (int)$v,
                'loginId' => '1',
                'standardId' => (int)$standardId,
                'stdItemId' => $slPdGnqStdList['gnqList'][$goods['card']['apt_common']]['gnqStdItemId'],  //0 1 2 三类标准
                'agreeFlg' => '1', //同意标致
            );
            //卖家产品储存运输标准
            $api['slPdTspStdList'][$k] = array(
                'slCode' => $this->seller['sl_code'],
                'slPdId' => (int)$v,
                'loginId' => '1',
                'standardId' => (int)$standardId,
                'stdItemId' => $slPdTspStdList['tspList'][$goods['card']['apt_transport']]['tspStdClaId'],  //0 1 2 三类标准
                'agreeFlg' => '1', //同意标致
            );
            //卖家产品安全标准
            $api['slPdSftStdList'][$k] = array(
                'slCode' => $this->seller['sl_code'],
                'slPdId' => (int)$v,
                'loginId' => '1',
                'standardId' => (int)$standardId,
                'stdItemId' => $slPdSftStdList['sftList'][$goods['card']['apt_safety']]['sftStdClaId'],  //0 1 2 三类标准
                'agreeFlg' => '1', //同意标致
            );
        }
        $result = $this->app->rpc('edit_seller_product1')->request($api);
        if ($result['status']) {
            return true;
        }
        return false;
    }


    //ajax检查商品gid
    public function check_gid()
    {

        $params = $this->_request->get_get();
        $goods_id = $params['goods']['gid'];
        if (!empty($goods_id) && $this->mB2cGoods->count(array('gid' => $goods_id)) > 0) {
            $this->splash('error', '', '重复的商品ID' . $goods_id);
        }
        $this->splash('success', '', '可用');
    }

    //ajax检查商品货品
    public function check_bn()
    {

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


    /**
     * ajax调用api获取商品特征下的包装、价盘信息
     * 润和接口
     */
    public function createProduct()
    {
        if (!$_POST) $this->splash('error', '', '非法请求');
        extract($_POST);
        //获取地区价盘
        $mdl_product_price = app::get('b2c')->model('products_price');

        $product = str_replace('-', '', $product);
        $productId = Array();
        foreach ($pack as $v2) {
            $tmp = explode('-', $v2);
            $productId[] = $product . $tmp[0] . $tmp[1];
            $pack_id[] = $tmp[2];
        }
        //获取商品列表
        $apiProduct = app::get('b2c')->rpc('goods_info')->request('', 259000);
        $productArray = array();
        foreach ($apiProduct['result']['goods'] as $key => $value) {
            if (in_array($value['bn'], $productId) && in_array($value['pack'], $pack_id)) {
                $value['product_price'] = $mdl_product_price->getList();
                $productArray[$key] = $value;
            }
        }
        $this->splash('success', '', $productArray);
    }

    private function _formatCat($data)
    {
        $data = explode('-', $data);
        $api_data = array(
            'classesCode' => $data[0],
            'machiningCode' => $data[1],
            'breedCode' => $data[2],
            'featureCode' => $data[3],
            'weightCode' => $data[4],
        );
        return $api_data;
    }


    /**
     * 获取分类下的特征信息
     */
    public function getFeature($params)
    {
        $cat = $_POST ?: $params;
        if (!$cat) $this->splash('error', '', '非法请求');
        $api_data = $this->_formatCat($cat['cat']);
        $result = app::get('b2c')->rpc('select_product_cat4')->request($api_data, 2592000);
        if ($params) {
            return $result['result'];
        }
        $this->splash('success', '', $result['result']);
    }


    /**
     * 获取特征下的净重
     */
    public function getWeight($params)
    {
        $cat = $_POST ?: $params;
        if (!$cat) $this->splash('error', '', '非法请求');
        $api_data = $this->_formatCat($cat['cat']);
        $result = app::get('b2c')->rpc('select_product_cat5')->request($api_data, 2592000);
        if ($params) {
            return $result['result'];
        }
        $this->splash('success', '', $result['result']);
    }

    /**
     * 获取分类下的包装信息
     */
    public function getPack($params)
    {
        $cat = $_POST ?: $params;
        if (!$cat) $this->splash('error', '', '非法请求');
        $api_data = $this->_formatCat($cat['cat']);
        $result = app::get('b2c')->rpc('select_product_cat6')->request($api_data, 2592000);
        if ($params) {
            return $result['result'];
        }
        $this->splash('success', '', $result['result']);
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
        if (!$mdl_product->save($product)) {
            $this->splash('error', $redirect, '操作失败');
        }
        $product['createTime'] = time();
        base_kvstore::instance('goods_price')->fetch("goods_price_{$this->store['store_id']}_{$product['product_id']}", $products);
        if (empty($products)) {
            $products = array(0 => $product);
        } else {
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


    public function addNewCard()
    {
        $params = $this->_request->get_get();
        if(empty($params)) $this->splash('error', '', '非法请求');
        $this->display('site/goods/add-new-pack.html');
        //$this->display('site/goods/add-new-pack.html');
    }

    public function saveNewCard()
    {
        $parent = explode('-', $_POST['catPath']);
        $mdl_cat = app::get('b2c')->model('goods_cat');
        $cat = array(
            array('classesCode', 'classesName'),
            array('machiningCode', 'machiningName'),
            array('breedCode', 'breedName'),
//            array('featureCode', 'featureName'),
//            array('weightName', 'weightVal'),
        );

        foreach($parent as $key => $value){
            $cat_name = $mdl_cat->getRow('cat_name', array('cat_id' => $value));
            $apiData[$cat[$key][0]] = $value;
            $apiData[$cat[$key][1]] = $cat_name['cat_name'];
        }
        $addNewType = (string)$parent - 2;
        $apiData['newFlag'] = $addNewType;
        $apiData['crtId'] = '1';
        if($addNewType == '3'){
            //查询特征名称
            $apiData['weightName'] = $_POST['num'];
            $apiData['weightVal'] = $_POST['name'];
        }
        $result = $this->app->rpc('apply_for_packaging')->request($apiData);
        if($result['start']){
            $this->splash('success', '', '添加成功');
        }
        $this->splash('error', '', '添加失败');
    }
}
