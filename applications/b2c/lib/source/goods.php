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
class b2c_source_goods extends base_source
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

    private function _init_args($params)
    {
        $data = array_merge($this->args, $params);
        return array_intersect_key($data, $params);
    }

    public function request_params($params)
    {
        $params = $this->_init_args($params);
        $this->params['params'] = $params;
        $this->init($this->params);
        if($this->get($params)){
            return $this->get($params);
        }
        $data = $this->remote();
        $this->set($params, $data);
        $this->response_params($data);
    }

    public function response_params($data)
    {
        return $data;
    }

    public function get_config()
    {

    }
}
