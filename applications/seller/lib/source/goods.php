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
// | Description: 商家商品接口类
// +----------------------------------------------------------------------
class seller_source_goods extends base_source {

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
     * 在售/仓库中的商品
     * @param $params array()
     * return array()  商品
     */

    public function sell_goods($params) {
        
    }

    /*
     * 商品上下架
     * @param $params array()
     * return true/false
     */

    public function marketable($params) {
        
    }

    /*
     * 商品编辑
     * @param $params array()
     * return true/false
     */

    public function edit($params) {
        
    }
    
    /*
     * 商品添加
     * @param $params array()
     * return true/false
     */

    public function add($params) {
        
    }
    
    /*
     * 库存编辑
     * @param $params array()
     * return true/false
     */

    public function stock($params) {
        
    }

   
}
