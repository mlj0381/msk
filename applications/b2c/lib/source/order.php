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

    /*
     * 售后申请
     * @param $params array()
     * return true/false
     */

    public function aftersales($params) {
        
    }

    /*
     * 售后列表
     * @param $params array()
     * return array()
     */

    public function aftersales_list($params) {
        
    }
    
    /*
     * 售后详情
     * @param $params array()
     * return array()
     */

    public function aftersales_detalis($params) {
        
    }
    
    /*
     * 退款管理
     * @param $params array()
     * return true/false
     */

    public function price_aftersales($params) {
        
    }

    /*
     * 退货管理
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

    
    /*
     * 订单提醒
     * @param $params array()
     * return array()各种订单状态下的订单数据
     */

    public function order_remind($params) {
        
    }
}
