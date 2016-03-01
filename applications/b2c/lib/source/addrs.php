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

class b2c_source_addrs extends base_source {

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
        $this->set($params, $data);
        $this->response($data);
    }

    /*
     * 收货地址添加
     * @params $params 地址参数
     * return true/false     
     */

    public function addrs_add($params) {
        
    }

    /*
     * 收货地址编辑
     * @params $params 地址参数
     * return true/false     
     */

    public function addrs_edit($params) {
        
    }

    /*
     * 收货地址删除
     * @params $params 地址参数
     * return true/false     
     */

    public function addrs_del($params) {
        
    }

    /*
     * 收货地址查看
     * @params $params 地址参数
     * return true/false     
     */

    public function addrs_read($params) {
        
    }

    /*
     * 设为默认地址
     * @params $params 地址Id
     * return true/false     
     */

    public function addrs_default($params) {
        
    }
    
    /*
     * 所在地区获取、查看
     * @params $params 地址Id
     * return true/false     
     */

    public function &basic($params) {
        $obj_regions_op = vmc::service('ectools_regions_apps', array('content_path' => 'ectools_regions_operation'));
        $obj_regions_op->type = 1;
        $stockList = $obj_regions_op->getRegionById(); // 0 三级联动 1 仓库地址
        foreach($stockList as &$value){
            $value['childNode'] = $obj_regions_op->getRegionById($value['region_id']);
        }
        $_SESSION['addrs'] = $_SESSION['addrs'] ?: $stockList[0]['childNode'][0]['region_id'];
        return $stockList;
    }
    
    /*
     * 页面顶部设置所在地区
     * @params $params 地址Id 会员id
     * return true/false     
     */

    public function set_addr($params) {
        
    }
}
