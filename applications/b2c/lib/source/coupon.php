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

class b2c_source_coupon extends base_source {

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

    /*
     * 优惠券查看
     * @params $params 地址参数
     * return true/false     
     */

    public function read($params) {
        
    }
    
    /*
     * 优惠券使用
     * @params $params 地址参数
     * return true/false     
     */

    public function edit($params) {
        
    }

}
