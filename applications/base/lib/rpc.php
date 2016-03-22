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
	public static $_rpc_config = array();

	private $app_id = "";
	private $app_dir = "";
	private $action = "";

	private $result = array();	
	private $base_url = "";
	private $url = "";

	private $headers = array();	
	private $postData = array(); //

	private $_params = array(); //
	private $_subs = array(); // 

	private $_cache_path = 'rpc/';

	public $status = true;
	public $message = "";
	public $returnCode = "";

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
			$this->base_url = $this->build_url($config);
			if(!empty($config['param']))
			{
				$this->postData = $config['param'];
			}			
			// 头部处理
			if(!empty($config['headers']))
			{
				$this->headers = $config['headers'];
			}
			$result = $setting->get_conf('result');
			foreach($result as $key => $item )
			{
				$this->$key = $item;
			}
			self::$initialized = true;			
        }		
	}

	public function request(Array $data, $expire=false)
	{	
		if(!$this->action || !$data) return $this->error('错误的请求');
		$index = $this->app_id . "_" . $this->action;
		$result = Array();
		if($expire !== false)
		{			
			$key = $index . md5(json_encode($data));			
			$path = $this->_cache_path . $this->app_id;			
			base_kvstore::instance($path)->fetch($key, $result);			
		}
		
		$this->_config($index, $data);
		if(empty($result))
		{
			$result = $this->_result($data);
			if($expire !== false && $result) {
				base_kvstore::instance($path)->store($key, $result, $expire);
			}
		}		
		return $result;
	}
	
	private function _config($index)
	{
		if(!isset(self::$_rpc_config[$index]))
		{
			$filePath = $this->app_dir . "/rpc/" . $this->action . ".php";
			@require_once($filePath);
			if(!isset($remote[$index])) return $this->error('Not found this request!');			
			self::$_rpc_config[$index] = $remote[$index];
		}
		$this->configs = self::$_rpc_config[$index];
		if(empty(self::$_rpc_config[$index]['url'])){
			$this->error('Not found this Url!');
		}else{
			$this->url = $this->base_url . $config['url'];
		}		
	}

	private function _result($data){
		if(empty($this->configs['params'])) return ;		
		foreach($this->configs['params'] as $key => $item){
			$column = isset($item['column']) ? $item['column'] : $key;
			if(!empty($item['require']) && !isset($data[$key])) return $this->error('参数错误！');
			$type = strtolower($item['type']);  
			$value = $key == 'param' ? $data : $data[$key];// 放在外层
			echo $key . "\t" . $column . "\n";
			print_r($value);
			echo "\n---------------------------------------------------------------\n";
			if($type == 'object')
			{	
				isset($this->postData[$column]) || $this->postData[$column] = Array();				
				foreach($this->configs[$key] as $k => $val)
				{					
					$sub_cloumn = isset($val['column']) ? $val['column'] : $k;
					$_value = $key == 'param' ? $value[$key] : $value;
					$this->postData[$column][$sub_cloumn] = $this->_convert($k, $val, $_value[$k]);
				}
			}else if($type == 'list'){
				isset($this->postData[$column]) || $this->postData[$column] = Array();				
				if(!isset($this->configs[$key])) continue;
				foreach($value as $k => $val)
				{
					$vals = Array();
					foreach($this->configs[$key] as $s => $sub)
					{		
						$sub_cloumn = isset($sub['column']) ? $sub['column'] : $k;
						$vals[$sub_cloumn] = $this->_convert($k, $sub, $val[$s]);						
					}
					$this->postData[$column][] = $vals;
				}
			}else{
				$this->postData[$column] = $this->_convert($key, $item, $value);
			}			
		}
		// 处理参数
		print_r($this->postData);
		return $this;
		// 发起请求
		if($this->status) $result = $this->remote();
		// 处理结果
		if($result)
		{
			foreach($result as $key => $val)
			{
				$this->$key = $val;
			}
		}
		return $this->result;
		//return $this;
	}
	
	// object
	/*
	 * data => array(
	 *	    'member_id' => '1',
	 *		'name' => 'mskseller',
	 *		'goods' => array(
	 *			0 => array(
	 *				'goods_id' => 1,
	 *				'goods_name' => '鸡产品1.6公斤'
	 *			),
	 *			1 => array(
	 *				'goods_id' => 1,
	 *				'goods_name' => '鸡产品1.8公斤'
	 *			),
	 *		)
	 * )
	*/
	private function _convert($key, $item, $data){		
		extract($item);  
		$result = isset($data) ? $data : $item['default'];
		if(!isset($type)) return $value;
		$type = strtolower($type);		
		switch($type)
		{
			case 'object':
				$value = $result;
				$result = Array();
				if(isset($this->configs[$key]))
				{				
					foreach($this->configs[$key] as $k => $val)
					{
						$column = isset($val['column']) ? $val['column'] : $k;
						$result[$column] = $this->_convert($k, $val, $value);
					}
				}
				$result = (Object)$result;
				break;
			case 'list':
				$value = $result;
				$result = Array();
				if(isset($this->configs[$key]))
				{
					foreach($value as $val)
					{				
						$vals = Array();
						foreach($this->configs[$key] as $k => $sub)
						{
							$column = isset($sub['column']) ? $sub['column'] : $k;
							$vals[$column] = $this->_convert($k, $sub, $val);
						}
						$result[] = $vals;
					}
				}
				break;
			case 'md5':
				$result && $result = md5($result);
				break;
		}
		//print_r($result);
		//echo "\n================================================================================\n";
		return $result;
	}
	
	private function __result($status=true, $message="sucess", $result=Array()){
		$this->status = $status;
		$this->message = $message;
		$this->result = $result;
	}
	
	private $_page = 1;
	private $_perpage = 10;
	
	public function limit($page, $perpage)
	{
		$this->_page = $page;
		$this->_perpage = $perpage;
	}
	
	/*
	 * data = array();
	*/
	private function _convert2($index, $data){	
		$params = self::$_rpc_config[$index]['params']; // 无须参数未处理
		$objects = isset(self::$_rpc_config[$index]['objects']) ? self::$_rpc_config[$index]['objects'] : Array();
		foreach($params as $key=>$item)
		{
			if(isset($item['require']) && $item['require'] === 'true' && !isset($data[$key])) return $this->error("{$key}为必填！");
			$value = isset($data[$key]) ? $data[$key] : $item['default'];
			$column = isset($item['column']) ?  $item['column'] : $key;			
			if($item['type'] == 'object' && !$value) $value = array();

			if(isset($objects[$key])) 

			if(isset($item['parent']) && $parent = $item['parent'])
			{
				isset($this->param[$item]) || $this->param[$key] = array();
				$this->param[$parent] = $this->_convert();
			}
			$this->param[$column] = $value;			
		}
		
			/*
			//echo $item['parent'] . "\n";
			//if(!empty($item['require']) && !isset($data[$key])) return $this->error("{$key} 不能为空！");			
			$value = isset($data[$key]) ? $data[$key] : $item['default'];
			$column = isset($item['column']) ?  $item['column'] : $key;			
			if(isset($item['type']) && $type = $item['type'])
			{
				if(function_exists($type) && $data[$key]) $value = $type($value);
				
				switch($type){
					case 'md5' : 
						$value = md5($value);
						break;
					case 'hash':
						break;
				}
				
			}			
			if(empty($item['parent'])){
				if(empty($item['require']) && !isset($data[$key])) continue;
				if($item['type'] == 'object' && !$value) $value = array();
				$this->param[$column] = $value;
			}else{
				echo $item['parent'] . "\n";
				$parents = explode("/", $item['parent']); // buyer/order/goods
				print_r($parents);
				if(count($parents) > 1) // 数组
				{
					while($parents)
					{
						$k = array_pop($parents);
						isset($first) || $first = $k;
						$_key = $params[$k]['column'];
						if(isset($value[$k])) break; // 若value本身是数组
						$tmp = Array();
						$tmp[$k] = $value;
						$value = $tmp;					
					}
					print_r($value);
					$this->param = array_merge_recursive($this->param, $value);
				}else{
					$parent = empty($params[$item['parent']]['column']) ? $item['parent'] : $params[$item['parent']]['column'];
					isset($this->param[$parent]) || $this->param[$parent] = Array();
					$this->param[$parent][$column] = $value;
				}
			}	
			
			*/
	}
	
	private function _prepare(){
		
	}

	// 
	private function _request_value($value, $param){
		isset($param['default']) || $param['default'] = '';		
	}

	

	private function build_url( $param ){
		$result = $param['scheme'] . '://' . $param['host'];
		if(isset($param['port']) && $param['port'] != 80){
			$result.= ':' .$param['port'];
		}
		$result.= "/" .$param['root'] . $param['version'] ."/";	
		return $result;
	}

	private function remote() {
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

	private function error($message = 'Request Fail', $status=false)
	{
		$this->status = $status;
		$this->message = $message;
		return $this;
	}
}