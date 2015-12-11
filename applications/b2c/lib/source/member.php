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
class b2c_source_member extends base_source {

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
     * 我的收藏
     * @param $params array()
     * return $data  店铺/商品
     */

    public function favorites($params) {
        
    }

    /*
     * 删除我的收藏
     * @param $params array()
     * return true/false
     */

    public function favorite_del($params) {
        
    }

    /*
     * 最近访问 商品/店铺
     * @param $params array()
     * return $data 商品/店铺
     */ 

    public function lately_visit($params) {
        
    }

}
