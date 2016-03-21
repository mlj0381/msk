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

/**
 * 接口请求基类
 */
class apicenter_api
{
    private $HOST = 'http://121.40.103.229:8080/';
    private $_request;

    public function __construct()
    {
        header("Content-type:application/json;charset=utf-8");
        $this->_request = vmc::singleton('base_httpclient');
    }

    /**
     * 发送POST请求
     *
     * @param url string 接口地址
     * @param post_data array 请求参数
     * @return false | array 返回接口成功所有数据
     */
    public function api_post($url,&$post_data=array()){
        $post_url = $this->HOST.$url;
        $res = $this->_request->post($post_url,$post_data);
        $data = json_decode($res,1);
        $post_data['msg'] = $data ? $data['message'] : '请求异常';
        if($data['status'] == 'S'){
            return $data['result'];
        }else{
            return false;
        }
    }

    /**
     * db文件读取
     *
     * @param db array ctl：文件名 act：数组名
     * @param param array 请求参数
     * @return false | array 校验合法接口数据
     */
    public function dbdata($db,&$param){
    	@ include(APP_DIR.'/apicenter/dbdata/'.$db['ctl'].'.php');

    	if(!is_array($dbdata[$db['act']]['columns'])){
    		$param['msg'] = $db['ctl'].'文件或数组'.$db['act'].'格式有误';
    		return false;
    	}
    	return self::verify($dbdata[$db['act']]['columns'],$param);
    }

    /**
     * 所需参数与传入参数过滤及对比
     *
     * @param $base array 基础数组
     * @param verify array 所需验证数组
     * @return false | array 校验合法数据
     */
    protected function verify($base,&$verify){
    	if(is_array($verify)){
    		foreach($base as $key => $value){
    			if($value['type'] == 'array'){
    				foreach($value['param'] as $ke=>$va){
    					if($va['required'] == 'Y' && empty($verify['param'][$ke])){
    						$verify['msg'] = $verify['param'][$ke].'不能为空';
    						return false;
    					}
						$data['param'][$ke] = $verify['param'][$ke];
    				}
    				//$this->verify($base[$key]['param'],$verify[$key]);
    			}else{
    				if($value['required'] == 'Y' && empty($verify[$key])){
    					$verify['msg'] = $verify[$key].'不能为空';
    					return false;
    				}
					$data[$key] = $verify[$key];
    			}
    		}
    		return $data;
    	}else{
    		$verify['msg'] = '参数有误';
    		return false;
    	}
    }
   	//$post_data['param'] = $this->arrayToObject($post_data['param']);
   	//var_dump($post_url,$post_data,$res);exit;
	private function arrayToObject($e){
        if( gettype($e)!='array' ) return;
        foreach($e as $k=>$v){
            if( gettype($v)=='array' || getType($v)=='object' ) $e[$k]=(object)self::arrayToObject($v);
        }
        return (object)$e;
    }
}