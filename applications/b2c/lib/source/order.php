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
class b2c_source_order extends base_source {

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
     * 订单创建
     * @param $params array()
     * return true/false
     */

    public function create($params) {
        
    }

    /*
     * 订单查看 All
     * @param $params array()
     * return true/false
     */

    public function read($params) {
        
    }

    /*
     * 单个订单详情查看
     * @param $params array()
     * return true/false
     */

    public function details($params) {
        
    }

    /*
     * 订单取消
     * @param $params array()
     * return true/false
     */

    public function abolish($params) {
        
    }

 

    /*
     * 订单删除
     * @param $params array()
     * return true/false
     */

    public function del($params) {
        
    }


}
