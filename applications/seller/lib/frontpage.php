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

class seller_frontpage extends site_controller {

    protected $seller = array();
    protected $store = array();

    function __construct(&$app) {
        parent::__construct($app);
        $this->_response->set_header('Cache-Control', 'no-store');
        $this->_response->set_header('Cache-Control', 'no-cache');
        $this->_response->set_header('Cache-Control', 'must-revalidate');

        // header('cache-control: no-store, no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // 强制查询etag

        vmc::singleton('base_session')->start();
        //$this->verify();
        $this->action = $this->_request->get_act_name();
        $this->controller = $this->_request->get_ctl_name();
        if($this->controller != 'site_passport'){
            $this->_schedule();
        }
        $this->menuSetting = 'index';
        $this->seller = $this->get_current_seller();
        $this->store = $this->get_current_store();
        $this->set_tmpl('seller');
        $this->user_obj = vmc::singleton('seller_user_object');
        $this->passport_obj = vmc::singleton('seller_user_passport');
    }

    //查询入驻进度
    private function _schedule() {
        $this->verify();
        $seller = $this->get_current_seller();
        $store = app::get('store')->model('store')->getRow('store_id', array('seller_id' => $seller['seller_id']));
        if (empty($store)) {
            $redriect = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_passport', 'act' => 'entry', 'args0' => $seller['schedule']));
            $this->splash('success', $redriect, '登录成功,请先完善入驻信息');
        }
    }

    protected function redirect_url($params = array()) {
        extract($params);
        empty($app) && $app = $this->app->app_id;
        empty($ctl) && $ctl = $this->controller;
        empty($app) && $act = 'index';
        $args = empty($args) ? array() : (array) $args;
        return $this->gen_url(compact('app', 'ctl', 'act', 'args'));
    }

    final public function gen_url($params = array()) {
        return app::get('seller')->router()->gen_url($params);
    }

    //End Function

    /*
     * 如果是登录状态则直接跳转到商家中心
     *
     */
    public function set_forward(&$forward) {
        $params = $this->_request->get_params(true);
        $forward = ($forward ? $forward : $params['forward']);
        if (!$forward) {
            $forward = $_SERVER['HTTP_REFERER'];
        }
        if (!strpos($forward, 'passport')) {
            $this->pagedata['forward'] = $forward;
        }
    }

    function verify() {
        $user_obj = vmc::singleton('seller_user_object');
        if ($this->app->seller_id = $user_obj->get_seller_id()) {
            $data = $user_obj->get_sellers_data(array(
                'sellers' => 'seller_id'
            ));
            if ($data) {
                //登录受限检测
                $res = $this->loginlimit($data['sellers']['seller_id'], $redirect);
                if ($res) {
                    $this->splash('error', $redirect, '登陆受限');
                } else {
                    return true;
                }
            }
        }
        $this->splash('error', $this->gen_url(array(
                    'app' => 'seller',
                    'ctl' => 'site_passport',
                    'act' => 'login' //
                )), '请用分销商帐号登录');
    }

    // 是否开店
    protected function verify_store() {
        return true;
        $this->store = app::get('store')->model('store')->getRow('*', array(
            'seller_id' => $this->seller['seller_id']
        ));
        if (!$this->store)
            $this->splash('error', $this->redirect_url(), '店铺尚未开启！');
        if ($this->store['disable'] == false)
            $this->splash('Error', $this->redirect_url(), '店铺正在审核');
        $this->pagedata['store'] = $this->store;
        return true;
    }

    /**
     * loginlimit-登录受限检测
     *
     * @param      none
     * @return     void
     */
    function loginlimit($mid, &$redirect) {
        $services = vmc::servicelist('loginlimit.check');
        if ($services) {
            foreach ($services as $service) {
                $redirect = $service->checklogin($mid);
            }
        }
        return $redirect ? true : false;
    }

//End Function

    public function bind_seller($seller_id) {
        $columns = array(
            'account' => 'seller_id,login_account,login_password,checkin',
            'sellers' => 'seller_id',
        );
        $user_obj = vmc::singleton('seller_user_object');
        $cookie_expires = $user_obj->cookie_expires ? time() + $user_obj->cookie_expires * 60 : 0;
        /*
          $seller_data = $user_obj->get_sellers_data($columns,$seller_id); */
        $login_name = $user_obj->get_seller_name($data['account']['login_name'], $seller_id);

        $this->cookie_path = vmc::base_url() . '/';
        $this->set_cookie('UNAME', $login_name, $cookie_expires);
        $this->set_cookie('SELLER_IDENT', $seller_id, $cookie_expires);
    }

    public function unset_seller() {
        $auth = pam_auth::instance(pam_account::get_account_type($this->app->app_id));
        foreach (vmc::servicelist('passport') as $k => $passport) {
            $passport->loginout($auth);
        }
        $this->app->seller_id = 0;
        vmc::singleton('base_session')->set_cookie_expires(0);
        $this->cookie_path = vmc::base_url() . '/';
        $this->set_cookie('UNAME', '', time() - 3600); //用户名
        $this->set_cookie('SELLER_IDENT', 0, time() - 3600); //会员ID
        foreach (vmc::servicelist('seller.logout_after') as $service) {
            $service->logout();
        }
    }

    public function get_current_seller() {
        return vmc::singleton('seller_user_object')->get_current_seller();
    }

    public function get_current_store() {
        return vmc::singleton('seller_user_object')->get_store($this->seller['seller_id'], 'store_id, store_name');
    }

    function set_cookie($name, $value, $expire = false, $path = null) {
        if (!$this->cookie_path) {
            $this->cookie_path = vmc::base_url() . '/';
            #$this->cookie_path = substr(PHP_SELF, 0, strrpos(PHP_SELF, '/')).'/';
            $this->cookie_life = $this->app->getConf('system.cookie.life');
        }
        $this->cookie_life = $this->cookie_life > 0 ? $this->cookie_life : 315360000;
        $expire = $expire === false ? time() + $this->cookie_life : $expire;
        setcookie($name, $value, $expire, $this->cookie_path);
        $_COOKIE[$name] = $value;
    }

    // 检查登录
    protected function check_login() {
        vmc::singleton('base_session')->start();
        if ($_SESSION['account'][pam_account::get_account_type($this->app->app_id)]) {
            return true;
        } else {
            return false;
        }
    }

    function setSeo($app, $act, $args = null) {
        $seo = vmc::singleton('site_seo_base')->get_seo_conf($app, $act, $args);
        $this->title = $seo['seo_title'];
        $this->keywords = $seo['seo_keywords'];
        $this->description = $seo['seo_content'];
        $this->nofollow = $seo['seo_nofollow'];
        $this->noindex = $seo['seo_noindex'];
    }

//End Function

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
            'index' => array('store', 'deal', 'goods', 'service'),
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

    //
    protected function output($app_id) {
        $app_id || $app_id = $this->app->app_id;
        $this->pagedata['seller'] = $this->seller;
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

    public function end($result = true, $message = null, $ajax = false, $data = null) {
        if (!$this->transaction_start) {
            trigger_error('The transaction has not started yet', E_USER_ERROR);
        }
        $this->transaction_start = false;
        restore_error_handler();
        if (is_null($url)) { //如果是错误则在当前页面返回错误信息
            $url = $this->_action_url;
        }
        $db = vmc::database();
        if ($result) {
            $db->commit($this->transaction_status);
        } else {
            $db->rollback();
        }
        $this->splash(($result ? 'success' : 'failed'), $url, ($result ? $message : ($message ? $message : '操作失败')), $ajax, $data);
    }

}
