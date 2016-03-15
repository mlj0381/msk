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


class buyer_frontpage extends site_controller{
	
	protected $buyer = array();
	protected $store = array();
	
	public function __construct(&$app){
        parent::__construct($app);
        $this->_response->set_header('Cache-Control', 'no-store');
        $this->_response->set_header('Cache-Control', 'no-cache');
        $this->_response->set_header('Cache-Control', 'must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // 强制查询etag
        vmc::singleton('base_session')->start();
        $this->action = $this->_request->get_act_name();
        $this->controller = $this->_request->get_ctl_name();
        $this->menuSetting = 'index';
        $this->set_tmpl('buyer');
    }
	
	
	public function gen_url($params = array()){
		return app::get('buyer')->router()->gen_url($params);
	}
	
	/**
	 * 检测用户登陆
	 */
	 function verify_buyer(){
		if (defined('BUYERID'))	return ;
		/**
		 * define('BUYERID', vmc::singleton('buyer_user_passport')->is_login());
		 * 这个走seller的session规则
		 * @var unknown
		 */
		define('BUYERID', vmc::singleton('buyer_user_object')->is_login());
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
	
    /**
     * cookie 生成机制
     * @param unknown $name
     * @param unknown $value
     * @param string $expire
     * @param string $path
     */
    function set_cookie($name, $value, $expire = NULL, $path = NULL) {
    	if (!$path){
    		$path = vmc::base_url() . '/';
    	}
    	if (!$expire){
    		//发送一个 24*7 小时候过期的 cookie
    		$expire = time()+3600*24*7;
    	}
    	setcookie($name, $value, $expire, $path);
    	$_COOKIE[$name] =  $value;
    }
    

    protected function output($app_id) {
    	$app_id || $app_id = $this->app->app_id;
    	$this->pagedata['buyer'] = $this->buyer;
    	$this->pagedata['store'] = $this->store;
    	$this->pagedata['menu'] = $this->get_menu($this->action);
    	$this->pagedata['app'] = $this->app->app_id;
    	$this->pagedata['current_controller'] = $this->controller;
    	$this->pagedata['current_action'] = $this->action;
    	$this->pagedata['active'] = $this->menuSetting;
    	$this->action_view = $this->action . '.html';
    	$controller = str_replace("site_", "", $this->controller);
    	if ($this->pagedata['_PAGE_']) {
    		$this->pagedata['_PAGE_'] = 'site/' . $controller . "/" . $this->pagedata['_PAGE_'];
    	} else {
    		$this->pagedata['_PAGE_'] = 'site/' . $controller . '/' . $this->action_view;
    	}
    	$this->pagedata['app_id'] = $app_id;
    	$this->pagedata['_MAIN_'] = 'site/main.html';
    	$this->page('site/main.html');
    }
    
    public function get_menu() {
    	$xmlfile = $this->app->app_dir . "/menu.xml";
    	//$xsd = vmc::singleton('base_xml')->xml2array(file_get_contents($xmlfile), $tags);
    	$parser = xml_parser_create();
    	xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
    	xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
    	xml_parse_into_struct($parser, file_get_contents($xmlfile), $tags);
    	xml_parser_free($parser);
    	$group = Array();
    	$menus = Array();
    	$count = count($tags);
    	$menuSetting = array(
    			'index' => array('buyer', 'goods', 'manager'),
    			'account' => array('account'),
    			'message' => array('message'),
    	);
    	$menu = $menuSetting[$this->menuSetting];
    	foreach ($tags as $key => $item) {
    		if ($item['tag'] == 'menugroup' && in_array($item['attributes']['name'], $menu)) {
    			$menuItem = $item['attributes'];
    			for ($i = $key + 1; $i < $count; $i++) {
    				if ($tags[$i]['tag'] == 'menu') {
    					$tags[$i]['attributes']['label'] = $tags[$i]['value'];
    					$menuItem['items'][] = $tags[$i]['attributes'];
    					continue;
    				}
    				break;
    			}
    			$menus[] = $menuItem;
    		}
    	}
    	return $menus;
    }
    
    
}