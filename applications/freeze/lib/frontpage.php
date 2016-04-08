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


class freeze_frontpage extends site_controller
{

    protected $member = array();

    function __construct(&$app)
    {
        parent::__construct($app);
        $this->action = $this->_request->get_act_name();
        $this->controller = $this->_request->get_ctl_name();
        $this->menuSetting = 'index';
        $this->set_tmpl('freeze');
    }
    public function bind_member($member_id) {
//        $columns = array(
//            'account' => 'freeze_id',
//        );
        $user_obj = vmc::singleton('freeze_user_object');
        $cookie_expires = $user_obj->cookie_expires ? time() + $user_obj->cookie_expires * 60 : 0;
//        $member_data = $user_obj->get_members_data($columns,$member_id);
        $login_name = $user_obj->get_member_name(null,$member_id);
        $this->cookie_path = vmc::base_url() . '/';
        $this->set_cookie('UNAME', $login_name, $cookie_expires);
        $this->set_cookie('MEMBER_IDENT', $member_id, $cookie_expires);
//        $this->set_cookie('MEMBER_LEVEL_ID', $member_data['members']['member_lv_id'], $cookie_expires);
    }

    public function is_complete_info()
    {
        $user_obj = vmc::singleton('freeze_user_object');
        $data = $user_obj->get_members_data(array('freeze'=>'*'));
        $data = $data['freeze'];
        if(!$data['name'])
        {
            $redirect = $this->gen_url(array(
                'app' => 'freeze',
                'ctl' => 'site_account',
                'act' => 'index',
            ));

            $this->splash('error', $redirect,'完善个人信息');
        }
        if(!$data['mobile'])
        {
            $redirect = $this->gen_url(array(
                'app' => 'freeze',
                'ctl' => 'site_account',
                'act' => 'set_pam_mobile',
            ));

            $this->splash('error', $redirect,'完善手机号码');
        }
    }

    /**
     * 检测用户是否登陆
     *
     * 当用户没有登陆则跳转到登陆错误页面
     *
     * @param      none
     * @return     void
     */
    function verify_member() {
        $this->user_obj = $user_obj = vmc::singleton('freeze_user_object');
        if ($this->app->freeze_id = $user_obj->get_member_id()) {
            $data = $user_obj->get_members_data(array(
                'freeze' => 'freeze_id'
            ));
            if ($data) {
                    return true;
            }
        }
        $this->splash('error', $this->gen_url(array(
            'app' => 'freeze',
            'ctl' => 'site_passport',
            'act' => 'login'
        )) , '未登录');
    }



    public function get_menu()
    {
        $xmlfile = $this->app->app_dir . "/menu.xml";
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, file_get_contents($xmlfile), $tags);
        xml_parser_free($parser);
        $group = Array();
        $menus = Array();
        $count = count($tags);
        $menuSetting = array(
            'index' => array('index'),
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

    /**
     * 会员中心框架统一输出.
     */
    protected function output($app_id = '') {
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

    function set_cookie($name, $value, $expire = false, $path = null) {
        if (!$this->cookie_path) {
            $this->cookie_path = vmc::base_url() . '/';
            #$this->cookie_path = substr(PHP_SELF, 0, strrpos(PHP_SELF, '/')).'/';
            $this->cookie_life = app::get('b2c')->getConf('system.cookie.life');
        }
        $this->cookie_life = $this->cookie_life > 0 ? $this->cookie_life : 315360000;
        $expire = $expire === false ? time() + $this->cookie_life : $expire;
        setcookie($name, $value, $expire, $this->cookie_path);
        $_COOKIE[$name] = $value;
    }
//    public function bind_freeze($member_id) {
//        $user_obj = vmc::singleton('buyer_user_object');
//        $buyer_id = $user_obj->get_id();
//        if(!$buyer_id && !$member_id)
//        {
//            $url = $this->gen_url(array(
//                'app' => 'buyer',
//                'ctl' => 'site_passport',
//                'act' => 'login',
//            ));
//            $this->splash('error', $url, '未登陆');
//        }
//        $data = array(
//            'freeze_id' => $member_id,
//            'buyer_id' => $buyer_id,
//        );
//        $freeze_model = app::get('freeze')->model('freeze_buyer');
//        if(!$freeze_model->save($data))
//        {
//            $signup_url = $this->gen_url(array(
//                'app' => 'buyer',
//                'ctl' => 'site_manager',
//                'act' => 'manager_signup',
//            ));
//            $this->splash('error', $signup_url, '冻品管家绑定失败');
//        };
//    }


}
