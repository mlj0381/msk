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
class b2c_source_cart extends base_source {

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
     * 加入购物车
     * @param $params 
     * return true/false
     */
    
    public function add_cart($params){
        
    }
    
    /**
     * 查看购物车
     * @param $params member_id
     * return array cartList
     */
    
    public function read_cart($params){
        
    }
    
    /**
     * 删除
     * @param $params member_id
     * return true
     */
    
    public function del_cart($params){
        
    }
    
    /**
     * 更新
     * @param $params member_id
     * return true
     */
    
    public function edit_cart($params){
        
    }
    
     /**
     * 首页购物车基础数据
     * @param $params member_id
     * return array cartList
     */
    
    public function basic($params){
        return $this->read_cart($params);
    }
}
