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


class b2c_mfrontpage extends mobile_controller
{
    protected $member = array();
    public function __construct(&$app)
    {
        parent::__construct($app);
    }
    /**
     * 检测用户是否登陆.
     *
     * 当用户没有登陆则跳转到登陆错误页面
     *
     * @param      none
     */
    public function verify_member()
    {
        $user_obj = vmc::singleton('b2c_user_object');
        if ($this->app->member_id = $user_obj->get_member_id()) {
            $data = $user_obj->get_members_data(array(
                'members' => 'member_id',
            ));
            if ($data) {
                //登录受限检测
                $res = $this->loginlimit($data['members']['member_id'], $redirect);
                if ($res) {
                    $this->splash('error', $redirect, '登陆受限');
                } else {
                    return true;
                }
            }
        }
        $this->splash('error', $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'mobile_passport',
            'act' => 'login',
        )), '未登录');
    }
    /**
     * loginlimit-登录受限检测.
     *
     * @param      none
     */
    public function loginlimit($mid, &$redirect)
    {
        $services = vmc::servicelist('loginlimit.check');
        if ($services) {
            foreach ($services as $service) {
                $redirect = $service->checklogin($mid);
            }
        }

        return $redirect ? true : false;
    } //End Function
    public function bind_member($member_id)
    {
        $columns = array(
            'members' => 'member_id,member_lv_id,cur,lang',
        );
        $user_obj = vmc::singleton('b2c_user_object');
        $cookie_expires = $user_obj->cookie_expires ? time() + $user_obj->cookie_expires * 60 : 0;
        $member_data = $user_obj->get_members_data($columns,$member_id);
        $login_name = $user_obj->get_member_name(null,$member_id);
        $this->cookie_path = vmc::base_url().'/';
        $this->set_cookie('UNAME', $login_name, $cookie_expires);
        $this->set_cookie('MEMBER_IDENT', $member_id, $cookie_expires);
        $this->set_cookie('MEMBER_LEVEL_ID', $member_data['members']['member_lv_id'], $cookie_expires);
    }
    public function get_current_member()
    {
        return vmc::singleton('b2c_user_object')->get_current_member();
    }
    public function set_cookie($name, $value, $expire = false, $path = null)
    {
        if (!$this->cookie_path) {
            $this->cookie_path = vmc::base_url().'/';
            #$this->cookie_path = substr(PHP_SELF, 0, strrpos(PHP_SELF, '/')).'/';
            $this->cookie_life = $this->app->getConf('system.cookie.life');
        }
        $this->cookie_life = $this->cookie_life > 0 ? $this->cookie_life : 315360000;
        $expire = $expire === false ? time() + $this->cookie_life : $expire;
        setcookie($name, $value, $expire, $this->cookie_path);
        $_COOKIE[$name] = $value;
    }
    public function check_login()
    {
        vmc::singleton('base_session')->start();
        if ($_SESSION['account'][pam_account::get_account_type($this->app->app_id) ]) {
            return true;
        } else {
            return false;
        }
    }
    /*获取当前登录会员的会员等级*/
    public function get_current_member_lv()
    {
        vmc::singleton('base_session')->start();
        if ($member_id = $_SESSION['account'][pam_account::get_account_type($this->app->app_id) ]) {
            $member_lv_row = app::get('pam')->model('account')->db->selectrow('select member_lv_id from vmc_b2c_members where member_id='.intval($member_id));

            return $member_lv_row ? $member_lv_row['member_lv_id'] : -1;
        } else {
            return -1;
        }
    }
}
