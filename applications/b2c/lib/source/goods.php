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

    public function floor($params) {
        
    }

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

    /*
     * 售后管理
     * @param $params array()
     * return true/false
     */

    public function aftersales($params) {
        
    }

    /*
     * 退货管理
     * @param $params array()
     * return true/false
     */

    public function price_aftersales($params) {
        
    }

    /*
     * 退款管理
     * @param $params array()
     * return true/false
     */

    public function goods_aftersales($params) {
        
    }

    /*
     * 撤消售后
     * @param $params array()
     * return true/false
     */

    public function del_aftersales($params) {
        
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
}
