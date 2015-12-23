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
class seller_source_product extends base_source
{
    protected $host = 'http://localhost/mskapi/goods.php';
    protected $params = array();
    protected $method = 'post';
    protected $schema = 'http';
    private $args = array(
        'label' => '',
        'num' => '',
        'addr' => '',
    );
    public function __construct($app)
    {
        $this->app = $app;
        $this->params = array(
            'app' => $this->app,
            'method' => $this->method,
            'schema' => $this->schema,
            'host' => $this->host,
        );
    }

    public function request($params)
    {
        $this->set_config($this->path);
        $params = $this->init_request_args($params);
        $this->params['params'] = $params;
        $this->init($this->params);
        if($this->get($params)){
            return $this->get($params);
        }
        $data = $this->remote();
        $this->set($params, $data);
        $this->response($data);
    }

    /**
     * 货品查询
     * @param $params
     * return array()
     */
    public function read($params){
        
    }
    
    
    /**
     * 货品添加
     * @param $params
     * return array()
     */
    public function add($params){
        
    }
    
    /**
     * 货品编辑
     * @param $params
     * return array()
     */
    public function edit($params){
        
    }
    
    /**
     * 货品删除
     * @param $params
     * return array()
     */
    public function del($params){
        
    }
}
