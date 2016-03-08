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
class seller_source_seller extends base_source {

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
    
    /**
     * 修改基本信息
     * @param $params
     * return true/flase
     */
    public function edit_info($params){
        
    }
    
    /**
     * 查看审核进度
     * @param $params
     * return array()
     */
    public function read_checkin($params){
        
    }
    
    /**
     * 商家推荐
     * @param $params
     * return array()
     */
    public function seller_recommend($params){
        
    }
}