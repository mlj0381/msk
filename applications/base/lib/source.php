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


class base_source {

    protected $source;
    protected $host = 'localhost';
    protected $schema = 'http'; // Http/Https
    protected $method = 'get'; // post/get
    protected $params = Array();
    protected $_timeout = 300;
    private $_cookieFileLocation = '/tmp/source.cookie'; // 设置cookie路径
    private $_cache_path = 'source/';
    private $ttl = 300;
    protected $app = '';
    private $agent = '';
    protected $config = '';
    protected $config_path = '';

    public function get() {
        $key = $this->get_key();
        $path = $this->_cache_path . $this->app->app_id;
        base_kvstore::instance($path)->fetch($key, $vcode);
        return $vcode;
    }

    public function set($key, $data) {
        $path = $this->_cache_path . $this->app;
        base_kvstore::instance($path)->store($key, $data, $this->ttl);
    }

    private function get_key() {
        return md5(json_encode($this->params));
    }

    public function init($params) {
        
        foreach ($params as $key => $val) {
            $this->$key = $val;
        }
    }

    public function remote() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->host);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        if ($this->method == 'post') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->params);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->_timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->_cookieFileLocation);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->_cookieFileLocation);
        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }

    public function set_config($path) {
        $this->config = $path;
    }

    /**
     * 参数列表调整
     **/
    public function init_request_args($params) {
        $params = utils::_filter_input($params);
        $data = array_merge($this->set_config($this->path), $params);
        return array_intersect_key($data, $params);
    }

    /**
     * 字段匹配转换
     **/
    public function convertColumns(&$data, $type)
    {

    }

    public function response(&$data) {
        return $data;
    }

    /**
     * 调用api接品获取数据
     * @params $params 要提交的数据
     **/
    public function request($params) {
       // var_dump($this->app);die;
        $this->set_config($this->path);
        $this->convertColumns($params);
        $params = $this->init_request_args($params);
        $this->params['params'] = $params;
        $this->init($this->params);
        if ($this->get($params)) {
            return $this->get($params);
        }
        $data = $this->remote();
        // $this->set($params, $data);
        return $data;
    }
}
