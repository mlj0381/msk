<?php

/**
 * 发送短信，获取验证码
 * @author ptf
 *
 */
class b2c_user_smscode {
	var $ttl = 86400; //缓存时间
	var $sendNum=6; //每天发送的限制
	var $sendDown=60; //倒计时
	
	public function __construct(&$app) {
		$this->app = $app;

		vmc::singleton('base_session')->start();
	}
	
	/**
	 * 发送手机短信，获取验证码
	 * @param 手机号 $moble
	 * @return string smsCode or boolean NULL
	 */
	public function get_code($mobile){
		$smscode = ''; //验证码
		$data = array(
			'mobile' => $mobile 
		);
	/** 远程验证码接口 【验证码短信平台接口】IOL101001  需要用的时候，取消这个注释，删除$result
		$orderRpc = app::get('b2c')->rpc('send_code');
		$result = $orderRpc->request($data);
	*/	
		$result = array(
				'status' => '1' ,
				'result' => array(
						'vcode' => '666888'
				)	
		);
	
		$status = $result['status'];
		if(!$status){
			return false;
		}		
		$smscode = $result['result']['vcode'] ; 
		return $smscode;
	}
	
	/*
	 * 将验证码存储到缓存中(没开启缓存则存储到kv) 短信验证码
	 *
	 * @params $mobile 手机号码 
	 * @params $type  sms 发送短信
	 * */
	public function send_smscode($mobile, $type = 'sms', &$msg) {
		$vcodeData = $this->get_smscode($mobile, $type);
		if ($vcodeData && ENVIRONMENT!='DEVELOPMENT') {
			if ($vcodeData['createtime'] == date('Ymd') && $vcodeData['count'] == $this->sendNum) {
				$msg = '每天只能进行'. $this->sendNum.'次验证';
				return false;
			}
			$left_time = (time() - $vcodeData['lastmodify']);
			if ($left_time < $this->sendDown) {
				$msg = '请'.($this->sendDown - $left_time).'秒后重试';
				return false;
			}
			if ($vcodeData['createtime'] != date('Ymd')) {
				$vcodeData['count'] = 0;
			}
		}
		$vcode = $this->get_code($mobile); //发送短信，获取验证码
		if(!$vcode){
			$msg ='发送失败';
			return false;
		}
		$vcodeData['$mobile'] = $mobile;
		$vcodeData['vcode'] = $vcode;
		$vcodeData['count'] += 1;
		$vcodeData['createtime'] = date('Ymd');
		$vcodeData['lastmodify'] = time();
		
		$key = $this->get_vcode_key($mobile, $type);
		base_kvstore::instance('vcode/account')->store($key, $vcodeData, $this->ttl);
		return $vcode;
	}
	
	public function get_smscode($mobile, $type = 'sms') {
		$key = md5($mobile . $type);
		base_kvstore::instance('vcode/account')->fetch($key, $vcode);
		return $vcode;
	}
	
	public function get_vcode_key($mobile, $type = 'sms') {
		return md5($mobile . $type);
	}
	
	/**
	 * 判断验证码是否正确
	 * @param unknown $mobile
	 * @param unknown $smscode
	 * @param string $type
	 */
	public function bool_sms($mobile,$smscode,$type='sms'){
		$vcode = $this->get_smscode($mobile,$type);
		if($vcode && $smscode == $vcode['vcode']){
			return true;
		}else{
			return false;
		}
		
	}
	
	
}

?>