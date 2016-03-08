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
class seller_source_cat extends base_source {

    protected $host = 'http://localhost/mskapi/goods.php';
    protected $params = array();
    protected $method = 'post';
    protected $schema = 'http';
    protected $path = '';
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
        );
    }

    public function request($params) {
        $this->set_config($this->path);
        $params = $this->init_request_args($params);
        $this->params['params'] = $params;
        $this->init($this->params);
        if ($this->get($params)) {
            return $this->get($params);
        }
        $data = $this->remote();
       // $this->set($params, $data);
        $this->response($data);
    }
    
    /**
     * 添加商品分类
     * @param $params
     * return true/false
     */
    public function add($params){
        
    }
    
    /**
     * 修改商品分类
     * @param $params
     * return true/false
     */
    public function edit($params){
        
    }
    
    /**
     * 查看商品分类
     * @param $params
     * return true/false
     */
    public function read($params){
        
    }
    
    /**
     * 删除商品分类
     * @param $params
     * return true/false
     */
    public function del($params){
        
    }
}
