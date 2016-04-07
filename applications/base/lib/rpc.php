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
// | 接口基类
// +----------------------------------------------------------------------
// | example:
/* 
	//$orderRpc = $this->app->rpc('register'); // rpc调用的两种方式，同model
	$orderRpc = app::get('b2c')->rpc('order_create');	
	$data = array(
		'member_id' => 2,
		'years' => '2016-03',
		'region_id'=> '111',
		'status' => '123123',
		'goods' => array(
			array(
				'goods_id' => '12',
				'goods_name' => '大盘鸡'
			),
			array(
				'goods_id' => '13',
				'goods_name' => '三黄鸡'
			)
		),
		'address' => array(
			'region_id' => 1,
			'mobile' => '13212321232',
			'address' => '碧波路5号'
		),
	);
	//$result = $orderRpc->request($data, false);	
	+----------------------------------------------------------------------
*/

class base_rpc
{
	private static $__instance = array();
	public static $initialized = false;
	public static $_rpc_config = array();

	private $app_id = "";
	private $app_dir = "";
	private $action = "";

	private $result = array();	
	static  $base_url = "";
	private $url = "";
    static $version = 'v1';

	static $headers = array();
    static $postData = array(); //

    private $_postData = Array();
	private $_params = array(); //
	private $_subs = array(); // 

	private $_cache_path = 'rpc/';

	private $status = true;
	private $message = "";
	private $returnCode = "";
	private $_timeout = 300;

	public function __construct($app)
    {
        $this->app_id = $app->app_id;
        $this->app_dir = APP_DIR.'/'.$app->app_id;	
		$this->init();		
    }
	public function get($action)
	{
		$this->action = $action;
		return $this;
	}

	private function init()
	{		
		if (! self::$initialized) {
            $base = app::get('base');
			$setting = new base_setting($base);
			$config = $setting->get_conf('remote');
			self::$base_url = $this->build_url($config);
            self::$version = $config['version'];
			if(!empty($config['param']))
			{
				self::$postData = $config['param'];
			}			
			// 头部处理
			if(!empty($config['headers']))
			{
				self::$headers = $config['headers'];
			}
			self::$initialized = true;
        }
	}

	public function request(Array $data, $expire=false)
	{
		$this->status = true;
		if(!$this->action /*||  !$data */) return $this->error('错误的请求');
		$index = $this->app_id . "_" . $this->action;	
		$this->result = Array();
		if($expire !== false)
		{			
			$key = $index . md5(json_encode($data));			
			$path = $this->_cache_path . $this->app_id;			
			base_kvstore::instance($path)->fetch($key, $this->result);
		}
		if(empty($this->result))
		{
			$this->_request($index, $data);
			if($this->status && $expire !== false && $this->result) {
				base_kvstore::instance($path)->store($key, $this->result, $expire);
			}
		}
		return $this->response();
	}

	private function response()
	{
		return array(
			'status' => $this->status,
			'returnCode' => $this->returnCode,
			'message' => $this->message,
			'result' => $this->result
		);
	}

	private function _request($index, $data)
	{
		if(!isset(self::$_rpc_config[$index]))
		{
			$filePath = $this->app_dir . "/rpc/" . $this->action . ".php";
			@require_once($filePath);
			if(!isset($remote[$index])) return $this->error('Not found this request!');			
			self::$_rpc_config[$index] = $remote[$index];			
		}
		$this->configs = self::$_rpc_config[$index];
		if(empty($this->configs['request'])) return $this->error('错误的请求');
		if(empty(self::$_rpc_config[$index]['url'])){
			$this->error('Not found this Url!');
		}else{
            $version = self::$version;
            empty(self::$_rpc_config[$index]['version']) || $version = self::$_rpc_config[$index]['version'];
			$this->url = self::$base_url . '/'. $version . self::$_rpc_config[$index]['url'];
		}
        $this->_postData = self::$postData;
		foreach($this->configs['request'] as $key => $item){
			$column = isset($item['column']) ? $item['column'] : $key;
			if(!empty($item['require']) && !isset($data[$key])) return $this->error("{$key}=>{$column}为必填字段！");
			$type = strtolower($item['type']);  
			$value = $key == 'param' ? $data : $data[$key];// 放在外层			
			$this->_postData[$column] = $this->_convert($key, $item, $value);
		}
		// 处理参数			
		if(!$this->status) return ;
		$this->result = $this->remote();
	}	
	private function _convert($key, $item, $data){		
		extract($item);
		$default = isset($default) ? $default : '';		
		$value = $data === NUll ? $default : $data;
		if(isset($item['require']) && $item['require'] == true && $value === '') {
			return $this->error("{$key}=>{$column}为必填字段！");
		}
		if(!isset($type)) $type == 'string';
		switch(strtolower($type))
		{
			case 'object':				
				$result = Array();
				if(isset($this->configs[$key]))
				{		
					foreach($this->configs[$key] as $k => $val)
					{
						$column = isset($val['column']) ? $val['column'] : $k;
						$result[$column] = $this->_convert($k, $val, isset($value[$k]) ? $value[$k] : Null);
					}
				}		
				break;
			case 'list':				
				$result = Array();				
				if(isset($this->configs[$key]) && is_array($value))
				{	
					foreach($value as $val)
					{				
						$vals = Array();
						foreach($this->configs[$key] as $k => $sub)
						{
							$column = isset($sub['column']) ? $sub['column'] : $k;
							$vals[$column] = $this->_convert($k, $sub, isset($val[$k]) ? $val[$k] : Null);
						}
						$result[] = $vals;
					}
				}
				break;
			case 'md5':
				$result && $result = md5($result);
				break;
			default : 
				$result = $value;
		}		
		return $result;
	}
	
	private $_page = Null;
	private $_perpage = Null;
	
	public function limit($page, $perpage)
	{
		$this->_page = $page;
		$this->_perpage = $perpage;
		return $this;
	}
	private function build_url( $param ){
		$result = $param['scheme'] . '://' . $param['host'];
		if(isset($param['port']) && $param['port'] != 80){
			$result.= ':' .$param['port'];
		}
		$result.= $param['root'];// ."/". $param['version'];	
		return $result;
	}

	private function _prepare()
	{
		if($this->_page !== Null) $this->postData['param']['pageNo'] = $this->_page;
		if($this->_perpage !== Null) $this->postData['param']['pageCount'] = $this->_page;
		//print_r($this->postData);
        if(count($this->_postData['param']) <= 0) unset($this->_postData['param']);
		$query = json_encode($this->_postData, true);
		return $query;
	}
	
	private function remote() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);		
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_prepare());
		curl_setopt($ch, CURLOPT_HTTPHEADER, self::$headers);
        curl_setopt($ch, CURLOPT_TIMEOUT, $this->_timeout);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		//curl_setopt($ch, CURLOPT_COOKIEJAR, $this->_cookieFileLocation);
        //curl_setopt($ch, CURLOPT_COOKIEFILE, $this->_cookieFileLocation);
		//var_dump($this->_prepare(), curl_getinfo($ch));
		$return = curl_exec($ch);
		$requestHeader = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		//$this->request_logs = curl_getinfo($ch);	
		if($requestHeader != 200) $this->error("Conection Error {$requestHeader}", $requestHeader);
        return $this->_result($return);
    }
	
	private function _result($data){
		$result = Array();
		$object = json_decode($data);

		if(!isset($object->status) || $object->status != 'S') {
			$this->message = isset($object->message) ? $object->message : 'Request Fail';
			$this->returnCode = isset($object->returnCode) ? $object->returnCode : 0;
			return $this->error($this->message, $this->returnCode);
		}

		if(empty($object->result)) return $result;
		if(is_object($object->result))
		{			
			$resource = json_decode($data, true);
			foreach($this->configs['response'] as $key => $item)
			{		
				if(!isset($resource['result'][$key])) continue;
				$column = isset($item['column']) ? $item['column'] : $key;
				$result[$column] = $this->_convert($key, $item, $resource['result'][$key]);
			}
		}else if(is_array($object->result)){
			$resource = json_decode($data, true);
			foreach($resource['result'] as $val){
				$vals = Array();
				foreach($this->configs['response'] as $key => $item)
				{
					if(!isset($val[$key])) continue;
					$column = isset($item['column']) ? $item['column'] : $key;
					$vals[$column] = $this->_convert($key, $item, $val[$key]);
				}
				$result[] = $vals;
			}
		}
		return $result;
	}

	private function error($message = 'Request Fail', $code='')
	{
		$this->status = false;
		$this->message = $message;
		if($code) $this->returnCode = $code;
		logger::error("{$this->app_id}_{$this->action}\n\tmessage:{$this->message}");
		return false;
	}
}