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

class b2c_ctl_mobile_passport extends b2c_mfrontpage
{
    public $title = '账户';
    public function __construct(&$app)
    {
        parent::__construct($app);
        $this->_response->set_header('Cache-Control', 'no-store');
        vmc::singleton('base_session')->start();
        $this->user_obj = vmc::singleton('b2c_user_object');
        $this->passport_obj = vmc::singleton('b2c_user_passport');
    }
    /*
     * 如果是登录状态则直接跳转到会员中心
     * */
    public function check_login()
    {
        if ($this->user_obj->is_login()) {
            $redirect = $this->gen_url(array(
                'app' => 'b2c',
                'ctl' => 'mobile_member',
                'act' => 'index',
            ));
            $this->splash('success', $redirect, '已经是登陆状态！');
        }

        return false;
    }
    public function set_forward(&$forward)
    {
        $params = $this->_request->get_params(true);
        $forward = ($forward ? $forward : $params['forward']);
        if (!$forward) {
            $forward = $_SERVER['HTTP_REFERER'];
        }
        if (!strpos($forward, 'passport')) {
            $this->pagedata['forward'] = $forward;
        }
    }
    public function index()
    {
        //如果会员登录则直接跳转到会员中心
        $this->check_login();
        $this->login();
    }
    /*
     * 登录view
     * */
    public function login($forward)
    {
        $this->title = '会员登录';
        //如果会员登录则直接跳转到会员中心
        $this->check_login();
        $this->set_forward($forward); //设置登录成功后跳转
        //信任登录
        $mdl_toauth_pam = app::get('toauth')->model('pam')->getList('*', array('status' => 'true'));

        $this->pagedata['toauth'] = $mdl_toauth_pam;

        $this->set_tmpl('passport');
        $this->page('mobile/passport/login.html');
    } //end function
    /*
     * 登录验证
     * */
    public function post_login()
    {
        $login_url = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'mobile_passport',
            'act' => 'login',
        ));
        //_POST过滤
        $params = utils::_filter_input($_POST);
        unset($_POST);
        $account_data = array(
            'login_account' => $params['uname'],
            'login_password' => $params['password'],
        );
        if (empty($params['vcode'])) {
            $this->splash('error', $login_url, '请输入验证码');
        }

        //尝试登陆
        $member_id = vmc::singleton('pam_passport_site_basic')->login($account_data, $params['vcode'], $msg);
        if (!$member_id) {
            $this->splash('error', $login_url,  $msg);
        }
        $mdl_members = $this->app->model('members');
        $member_data = $mdl_members->getRow('member_lv_id,experience', array(
            'member_id' => $member_id,
        ));
        if (!$member_data) {
            $this->splash('error', $login_url, '会员数据异常！');
        }
        $member_data['order_num'] = $this->app->model('orders')->count(array(
            'member_id' => $member_id,
        ));

        //更新会员数据
        $mdl_members->update($member_data, array(
            'member_id' => $member_id,
        ));
        //设置session
        $this->user_obj->set_member_session($member_id);
        //设置客户端cookie
        $this->bind_member($member_id);
        $forward = $params['forward'];
        if (!$forward) {
            $forward = $this->gen_url(array(
                'app' => 'b2c',
                'ctl' => 'mobile_member',
                'act' => 'index',
            ));
        }
        $this->splash('success', $forward, '登录成功');
    } //end function
    //注册页面
    public function signup($forward)
    {
        $this->title = '注册成为会员';
        //检查是否登录，如果已登录则直接跳转到会员中心
        $this->check_login();
        $this->set_forward($forward); //设置登录成功后跳转
        //获取会员注册项
        if ($this->app->getConf('member_signup_show_attr') == 'true') {
            $this->pagedata['attr'] = $this->passport_obj->get_signup_attr();
        }
        $this->set_tmpl('passport');
        $this->page('mobile/passport/signup.html');
    }
    //注册的时，检查用户名
    public function check_login_name()
    {
        if($this->passport_obj->get_login_account_type(trim($_POST['pam_account']['login_name']))!='mobile'){
            $this->splash('error', null, '请输入正确的手机号码', true);
        }
        if ($this->passport_obj->check_signup_account(trim($_POST['pam_account']['login_name']), $msg)) {
            if ($msg == 'mobile') { //用户名为手机号码
                $this->splash('success', null, array(
                    'is_mobile' => 'true',
                ));
            }else{
                $this->splash('error', null, $msg, true);
            }

        } else {
            $this->splash('error', null, $msg, true);
        }
    }
    /**
     * create
     * 创建会员.
     */
    public function create()
    {
        $params = $_POST;
        $forward = $params['forward'];
        if (!$forward) {
            $forward = $this->gen_url(array(
                'app' => 'site',
                'ctl' => 'default',
            )); //PC首页
        }
        unset($_POST['forward']);
        $signup_url = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'mobile_passport',
            'act' => 'signup',
            'args' => array(
                $forward,
            ),
        ));
        $login_type = $this->passport_obj->get_login_account_type($params['pam_account']['login_name']);
        if ($login_type == 'mobile' && !vmc::singleton('b2c_user_vcode')->verify($params['vcode'], $params['pam_account']['login_name'], 'signup')) {
            $this->splash('error', $signup_url, '手机短信验证码不正确');
        } elseif ($login_type != 'mobile' && !base_vcode::verify('passport', $params['vcode'])) {
            $this->splash('error', $signup_url, '验证码不正确');
        }
        if (!$this->passport_obj->check_signup($params, $msg)) {
            $this->splash('error', $signup_url, $msg);
        }
        $member_sdf_data = $this->passport_obj->pre_signup_process($params);

        if ($member_id = $this->passport_obj->save_members($member_sdf_data, $msg)) {
            $this->user_obj->set_member_session($member_id);
            $this->bind_member($member_id);
            /*本站会员注册完成后做某些操作!*/
            foreach (vmc::servicelist('member.create_after') as $object) {
                $object->create_after($member_id);
            }
            $this->splash('success', $forward, '注册成功');
        } else {
            $this->splash('error', $signup_url, '注册失败,会员数据保存异常');
        }
    }
    /**
     * 重置密码操作
     */
    public function reset_password($action){
        $this->title= '重置密码';
        if($action == 'doreset' ){
            $redirect_here = array('app' => 'b2c','ctl' => 'mobile_passport','act' => 'reset_password');
            $params = $_POST;
            $forward = $params['forward'];
            if (!$forward) {
                $forward = $this->gen_url(array(
                    'app' => 'mobile',
                    'ctl' => 'index',
                ));
            }
            // if(!vmc::singleton('b2c_user_passport')-is_exists_login_name($params['account'])){
            //     $this->splash('error', null, '未知账号!');
            // }
            if(empty($params['new_password'])){
                $this->splash('error',$redirect_here,'请输入新密码!');
            }
            if($params['new_password1'] != $params['new_password']){
                $this->splash('error',$redirect_here,'两次输入的密码不一致!');
            }

            if(!vmc::singleton('b2c_user_vcode')->verify($params['vcode'], $params['account'], 'reset')){
                $this->splash('error',$redirect_here,'验证码错误！');
            }
            $p_m = app::get('pam')->model('members')->getRow('member_id',array('login_account'=>$params['account']));
            if(empty($p_m['member_id'])){
                $this->splash('error',$redirect_here,'账号异常!');
            }
            $member_id = $p_m['member_id'];
            if(!$this->passport_obj->reset_password($member_id,$params['new_password'])){
                $this->splash('error',$redirect_here,'密码重置失败!');
            }

            /**
             * 直接登录操作
             */
            $this->unset_member();
            //设置session
            $this->user_obj->set_member_session($member_id);
            //设置客户端cookie
            $this->bind_member($member_id);

            $this->splash('success', $forward, '密码重置成功');


        }else{
            $this->set_tmpl('passport');
            $this->page('mobile/passport/reset_password.html');
        }



    }

    //发送身份识别验证码
    public function member_vcode(){
        $account = $_POST['account'];
        $login_type = $this->passport_obj->get_login_account_type($account);
        if($login_type != 'mobile'){
            $this->splash('error', null, '请输入正确的手机号码!');
        }
        if(!$this->passport_obj->is_exists_login_name($account)){
            $this->splash('error', null, '未知账号!');
        }
        if(!$vcode = vmc::singleton('b2c_user_vcode')->set_vcode($account,'reset',$msg)){
            $this->splash('error', null, $msg);
        }
        //$data[$login_type] = $account;
        $data['vcode'] = $vcode;
        switch ($login_type) {
            case 'mobile':
                $send_flag = vmc::singleton('b2c_user_vcode')->send_sms('reset',(string)$account,$data);
                break;
        }
        if(!$send_flag){
            $this->splash('error', null, '发送失败');
        }
        $this->splash('success', null, '发送成功');

    }

    //短信发送验证码
    public function send_vcode_sms($type = 'signup')
    {

        $mobile = trim($_POST['mobile']);
        if($this->passport_obj->get_login_account_type($mobile)!='mobile'){
            $this->splash('error', null, '请输入正确的手机号码', true);
        }
        if(!$this->passport_obj->check_signup_account($mobile, $msg)){
            $this->splash('error', null, $msg);
        }
        $uvcode_obj = vmc::singleton('b2c_user_vcode');
        $vcode = $uvcode_obj->set_vcode($mobile, $type , $msg);
        if ($vcode) {
            //发送验证码 发送短信
            $data['vcode'] = $vcode;
            if (!$uvcode_obj->send_sms($type, (string) $mobile, $data)) {
                $this->splash('error', null, '短信发送失败');
            }
        } else {
            $this->splash('failed', null, $msg);
        }
        $this->splash('success', null, '短信已发送');
    }
    public function logout($forward)
    {
        $this->unset_member();
        if (!$forward) {
            $forward = $this->gen_url(array(
                'app' => 'site',
                'ctl' => 'default',
                'act' => 'index',
                'full' => 1,
            ));
        }
        $this->splash('success', $forward, '退出登录成功');
    }
    private function unset_member()
    {
        $auth = pam_auth::instance(pam_account::get_account_type($this->app->app_id));
        foreach (vmc::servicelist('passport') as $k => $passport) {
            $passport->loginout($auth);
        }
        $this->app->member_id = 0;
        vmc::singleton('base_session')->set_cookie_expires(0);
        $this->cookie_path = vmc::base_url().'/';
        $this->set_cookie('UNAME', '', time() - 3600); //用户名
        $this->set_cookie('MEMBER_IDENT', 0, time() - 3600);//会员ID
        $this->set_cookie('MEMBER_LEVEL_ID', 0, time() - 3600);//会员等级ID
        foreach (vmc::servicelist('member.logout_after') as $service) {
            $service->logout();
        }
    }
}
