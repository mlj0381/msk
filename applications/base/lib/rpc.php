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

/* +----------------------------------------------------------------------
	// $this->Rpc = vmc::singleton('base_rpc');
	$data = array(
		'tel' => '13212312312'
	);
	$res = $this->Rpc->app('seller')->request('register', $data);
	+----------------------------------------------------------------------
*/

class base_rpc
{
	private static $__instance = array();
	public static $initialized = false;

	private $app_id = "";
	private $app_dir = "";
	private $auth = "";

	private $result = array();

	private $status = false;

	private $headers = array();
	
	public function __construct($app_id)
    {
        $this->app_id = $app_id;
        $this->app_dir = APP_DIR.'/'.$app_id;		
		$this->init();	
		//print_r($this->base);
    }

	public static function app($app_id)
    {
        if (!isset(self::$__instance[$app_id])) {
            self::$__instance[$app_id] = new self($app_id);
        }
        return self::$__instance[$app_id];
    }

	public function request($action, Array $param)
	{
		if(!$action || !$param) return false;
		$rpc_params_config = $this->app_dir . "/rpc/" . $action . ".php";
		if(!file_exists($rpc_params_config)) return false;

		@include($rpc_params_config);
		// 处理参数
		$index = $this->app->app_id . "_" . $action;
		if(!isset($remote[$index]) && $columns = $remote[$index]) return false;
			$columns = $this->convert($columns);

		// 发起请求
		$result = $this->remote();
		// 处理结果
		if($result)
		{
			foreach($result as $key => $val)
			{
				$this->$key = $val;
			}
		}
	}

	private function init()
	{	
		if (! self::$initialized) {
            $base = app::get('base');
			$setting = new base_setting($base);
			$config = $setting->get_conf('remote');
			$this->Url = $this->build_url($config);
			if(!empty($config['param']))
			{
				$this->param = $config['param'];
			}

			if(!empty($config['header']))
			{
				foreach($config['header'] as $key => $item)
				{
					$this->headers[] = "{$key}:{$item}";
				}
			}

			$result = $setting->get_conf('result');
			foreach($result as $key => $item )
			{
				$this->$key = $item;
			}
			self::$initialized = true;			
        }		
	}	
	protected function build_url( $param ){
		$result = $param['scheme'] . '://' . $param['host'];
		if(isset($param['port']) && $param['port'] != 80){
			$result.= ':' .$param['port'];
		}
		$result.= "/" .$param['root'] . $param['version'] ."/";	
		return $result;
	}
	public function remote() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->Url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
       
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($this->params));
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        curl_setopt($ch, CURLOPT_TIMEOUT, $this->_timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $this->_cookieFileLocation);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $this->_cookieFileLocation);
        $return = curl_exec($ch);
        curl_close($ch);
        return $return;
    }
}