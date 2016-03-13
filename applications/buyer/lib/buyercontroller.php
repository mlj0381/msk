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


class site_buyercontroller extends site_controller{
	
	
	public function __construct(&$app){
		parent::__construct($app);
		$this->_request = vmc::singleton('base_component_request');
		
	}
	
	
	public function gen_url($params = array()){
		return app::get('buyer')->router()->gen_url($params);
	}
	
	/**
	 * 检测用户登陆
	 */
	 function verify_buyer(){
		if (defined('BUYERID'))	return ;
		define('BUYERID', vmc::singleton('buyer_user_passport')->is_login());
		if (!BUYERID){
			$login_url = $this->gen_url(array(
					'app' => 'buyer',
					'ctl' => 'site_passport',
					'act' => 'login',
			));
			
			$this->splash('error', $login_url, '请重新登陆');exit;
		}
	}
	
	/**
	 * 暂时没用
	 * @param unknown $forward
	 */
	public function set_forward(&$forward){
        $params = $this->_request->get_params(true);
        $forward = ($forward ? $forward : $params['forward']);
        if (!$forward) {
            $forward = $_SERVER['HTTP_REFERER'];
        }
        if (!strpos($forward, 'passport')) {
            $this->pagedata['forward'] = $forward;
        }
    }
	
}