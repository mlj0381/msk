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
class b2c_source_goods extends base_source {

    protected $host = 'http://localhost/mskapi/goods.php';
    protected $params = array();
    protected $method = 'post';
    protected $schema = 'http';
    protected $config_path = '';
    private $args = array(
        'label' => '',
        'num' => '',
        'addr' => '',
    );

    public function __construct($app) {
        $this->app = $app;
        $this->params = array(
            'app' => $this->app,
            'method' => $this->method,
            'schema' => $this->schema,
            'host' => $this->host,
            'config_path' => $this->config_path,
        );
    }

    public function request($params) {
        
        $params = $this->init_request_args($params);
        $this->params['params'] = $params;
        $this->init($this->params);
        if ($this->get($params)) {
            return $this->get($params);
        }
        $data = $this->remote();
        $this->set($params, $data);
        $this->response($data);
    }

    /*
     * 首页楼层
     * @param $params array()
     * return array()
     */
    public function floor ($params){
        $mdl_ad = app::get('b2c')->model('ad');
        $goods_list = $mdl_ad->getList('*', array('page_id' => 12, 'ad_type' => 3));
        foreach($goods_list as $key => &$value){
            $value['son'] = $mdl_ad->getList('*', array('page_id' => $value['id'], 'ad_type' => 3));
        }
        return $goods_list;
    }

//    public function floor($params) {
//        $mdl_ad = app::get('b2c')->model('ad');
//        $tmp = array();
//        $tmp_floor_ad = array();
//        $tmp_window = array();
//        $floor = $mdl_ad->getList('*', array('page_id' => $params['page'], 'ad_type' => $params['type']));
//        foreach ($floor as  &$v) {
//            $tmp[] = $v['ordernum'];
//            $v['ad_setting']['floor_ad'] = $mdl_ad->getList('*', array('id|in' => $v['ad_setting']['floor_ad'], 'status' => 'true'));
//            foreach($v['ad_setting']['floor_ad'] as &$ad){
//                //$ad['ad_content'] = unserialize($ad['ad_content']);
//                $tmp_floor_ad[] = $ad['ordernum'];
//            }
//            $v['ad_setting']['floor_window'] = $mdl_ad->getList('*', array('id|in' => $v['ad_setting']['floor_window'], 'status' => 'true'));
//            foreach($v['ad_setting']['floor_window'] as &$win){
//               //$win['ad_content'] = unserialize($win['ad_content']);
//                $tmp_window[] = $win['ordernum'];
//            }
//            array_multisort($tmp_window, SORT_ASC, $v['ad_setting']['floor_window']);
//            array_multisort($tmp_floor_ad, SORT_ASC, $v['ad_setting']['floor_ad']);
//        }
//        array_multisort($tmp, SORT_ASC, $floor);
//        return $floor;
//    }

    /*
     * 商品列表
     * @param $params array()
     * return array()
     */

    public function good_list($params) {
        
    }

    /*
     * 商品详情
     * @param $params array()
     * return array()
     */

    public function good_detalis($params) {
        
    }

    /*
     * 商品评价
     * @param $params array()
     * return true/false
     */

    public function comment($params) {
        
    }

    /**
     * 相关商品
     * @param $params goodsId
     */
    public function goods_rate($params){
        $mdl_rate = app::get('b2c')->model('goods_rate');
        $goods_list = $mdl_rate->getList('*', array('goods_1' => $params['goods_id']));
        return $this->good_list($goods_list);
    }
    
    /**
     * 商品促销
     * @param $params goodsId
     */
    
    public function promotions($params){
        
    }
    
    /**
     * 猜你商品
     * @param $params goodsId
     */
    
    public function love_goods($params){
        
    }
    
    /**
     * 根据商品搜索店铺
     * @param $params products_id
     */
    
    public function store_goods($params){
        
    }
    
    /**
     * 获取商品列表页基本数据 （属性）
     * @param $params
     * return array()
     */
    public function basic($params){
        
    }
}
