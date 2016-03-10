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
class b2c_source_search extends base_source {

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
    
     /**
     * 首页基础数据（热门关键词）
     * @param $params member_id
     * return array cartList
     */
    
    public function basic($params){
        return app::get('b2c')->model('setting')->getList('*', array('status' => 'true', 'setting_type' => '0'));
    }
    
    /**
     * 查询商品
     * @param $params 
     * return array() list
     */
    
    public function goods_list($params){
        
    }
    
    /**
     * 查询店铺
     * @param $params 
     * return array() list
     */
    
    public function store_list($params){
        
    }
}
