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

class b2c_ctl_site_passport extends b2c_frontpage
{

    public $title = '账户';

    public function __construct(&$app)
    {
        parent::__construct($app);
        $this->_response->set_header('Cache-Control', 'no-store');
        vmc::singleton('base_session')->start();
        $this->user_obj = vmc::singleton('b2c_user_object');
        $this->passport_obj = vmc::singleton('b2c_user_passport');
        $this->members = $this->get_current_member();
    }

    /*
     * 如果是登录状态则直接跳转到会员中心
     * */

    public function check_login()
    {
        if ($this->user_obj->is_login()) {
            $redirect = $this->gen_url(array(
                'app' => 'b2c',
                'ctl' => 'site_member',
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
        $this->page('site/passport/login.html');
    }

//end function

    /*
     * 登录验证
     * */

    public function post_login()
    {
        $login_url = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_passport',
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

        /**
         * 润和接口 会员登录 IBY121201
         * */
        $result = $this->app->rpc('login')->request($account_data);
        if(!$result['status']){
            $this->splash('error', $login_url, '登录失败！');
        }
        //end 接口
        //尝试登陆
        $member_id = vmc::singleton('pam_passport_site_basic')->login($account_data, $params['vcode'], $msg);
        if (!$member_id) {
            $this->splash('error', $login_url, $msg);
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
                'ctl' => 'site_member',
                'act' => 'index',
            ));
        }
        $this->splash('success', $forward, '登录成功');
    }

//end function
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
        $this->page('site/passport/signup_accoutSet.html');
    }

    //注册页面--审核信息
    public function signup_baseInfo($pageIndex = 1)
    {

        $this->page('site/passport/signup_baseInfo.html');
    }

    /*
     * 会员注册页面配置
     * @param $pageIndex 配置页面索引
     * return pageSetting array()
     * */
    private function _page_setting($pageIndex)
    {
        switch ($pageIndex) {
            case 1:
                $conf = $this->user_obj->page_company();
                break;
            case 2:
                $conf = $this->user_obj->page_manage();
                break;
            case 3:
                $conf = $this->user_obj->page_delivery();
                break;
        }
        $page_setting = $this->app->getConf('member_extra_column');
        $conf['page_setting'] = $page_setting[$pageIndex];
        foreach ($conf['page_setting'] as $key => $page) {
            $path = $this->app->app_dir . '/view/site/passport/baseInfo/' . $page . '.html';
            if (!file_exists($path)) {
                unset($conf['page_setting'][$key]);
            }
        }

        return $conf;
    }





    //注册经营信息
    public function business_info($pageIndex = 0, $type = null)
    {
        /**
         * 润和接口 会员详细信息提交
         * IBY121202 更新买家基本信息
         * IBY121203 更新买家经营产品类别
         * IBY121204 更新买家销售对象
         * IBY121203 更新买家经营产品类别
         * IBY121204 更新买家销售对象
         * IBY121205 更新证照信息
         * IBY121206 更新证照图片
         * IBY121207 更新雇员信息
         */
        $this->verify_member();
        if (!is_numeric($pageIndex)) $pageIndex = 1;
        $page_setting = $this->app->getConf('member_extra_column');
        $pageIndex = $type == 'up' ? $pageIndex -1 : $pageIndex +1;
        $pageIndex <= 1 && $pageIndex = 1;
        $pageIndexMax = count($page_setting) + 1;
        $pageIndex >=  $pageIndexMax && $pageIndex = $pageIndexMax;
        $this->pagedata['conf'] = $this->_page_setting($pageIndex);
        if ($_POST) {
            $_POST['pageIndex'] = $pageIndex;
            $_POST['member_id'] = $this->member['member_id'];
            $result = $this->passport_obj->save_company($_POST);
            $redirect = $this->gen_url(array(
                'app' => 'b2c',
                'ctl' => 'site_passport',
                'act' => 'business_info',
                'args0' => $pageIndex - 1,
            ));
            if(!$result){
                $this->splash('error', $redirect, '注册失败');
            }
        }
        $this->set_tmpl('passport');
        $this->pagedata['pageIndex'] = $pageIndex;
        if($pageIndex >= $pageIndexMax){
            $this->page('site/passport/signup_complete.html');
        }else{
            $this->page('site/passport/signup_baseInfo.html');
        }
    }

    //注册页面--注册完成
    public function signup_complete($forward)
    {
        $this->set_tmpl('passport');
        if ($_POST) {
            $redirect = $this->gen_url(array('app' => 'b2c', 'ctl' => 'site_passport', 'act' => 'business_info'));
            $params = $_POST;
            $mdl_company_extra = app::get('base')->model('company_extra');
            $extra_columns = $this->app->getConf('member_extra_column');
            foreach ($extra_columns as $col) {
                if (isset($params[$col]) && !empty($params[$col])) {
                    $params[$col]['uid'] = $this->member['member_id'];
                    $params[$col]['from'] = 0;
                    if (!$mdl_company_extra->extra_save($col, $params)) {
                        $this->splash('error', $redirect, '注册失败');
                    }
                }
            }
        }
        $this->page('site/passport/signup_complete.html');
    }

    //注册的时，检查用户名
    public function check_login_name()
    {
        if ($this->passport_obj->check_signup_account(trim($_POST['pam_account']['login_name']), $msg)) {
            if ($msg == 'mobile') { //用户名为手机号码
                $this->splash('success', null, array(
                    'is_mobile' => 'true',
                ));
            }
            if ($msg == 'email') { //用户名为邮箱
                $this->splash('success', null, array(
                    'is_email' => 'true',
                ));
            }
            $this->splash('success', null, '该账号可以使用');
        } else {
            $this->splash('error', null, $msg, true);
        }
    }

    /*
     * 判断前台用户联系手机是否存在
     */

    public function is_exists_mobile() {
        $mobile = $_POST['pam_account']['mobile'];
        if (empty($mobile)) {
            $this->splash('error', '', '手机号不能为空');
        }
        $mobile_type = $this->passport_obj->get_login_account_type($mobile);

        if($mobile_type != 'mobile'){
            $this->splash('error', '', '请填写正确的手机号');
        }
        $mdl_members = $this->app->model('members');
        $flag = $mdl_members->getList('member_id', array(
            'mobile' => trim($mobile),
        ));
        if($flag){
            $this->splash('error', '', '该手机号已被使用');
        }
        $this->splash('success', '', '该手机号可以使用');
    }

    /**
     * create
     * 创建会员
     */
    public function create()
    {
        $params = $_POST;
        $forward = $params['forward'];

        $next = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_passport',
            'act' => 'business_info',
            'args0' => '0'
        )); //PC首页

        unset($_POST['forward']);
        $signup_url = $this->gen_url(array(
            'app' => 'b2c',
            'ctl' => 'site_passport',
            'act' => 'signup',
            'args' => array(
                $forward,
            ),
        ));
        $login_type = $this->passport_obj->get_login_account_type($params['pam_account']['mobile']);

        //$login_type == 'mobile' &&
        if ($login_type == 'mobile' &&!vmc::singleton('b2c_user_vcode')->verify($params['smscode'], $params['pam_account']['mobile'], 'signup')) {
            $this->splash('error', $signup_url, '手机短信验证码不正确');
        }
//        elseif ($login_type != 'mobile' && !base_vcode::verify('passport', $params['vcode'])) {
//            $this->splash('error', $signup_url, '验证码不正确');
//        }
        if (!$this->passport_obj->check_signup($params, $msg)) {
            $this->splash('error', $signup_url, $msg);
        }
        $member_sdf_data = $this->passport_obj->pre_signup_process($params);
        /**
         * 润和接口买家注册 IBY121201
         * */
        $rpc_data = array(
            'login_account' => $member_sdf_data['pam_account']['login_account'],
            'login_password' => $params['pam_account']['login_password'],
            'mobile' => $member_sdf_data['b2c_members']['contact']['phone']['mobile'],
        );
        $result = $this->app->rpc('register')->request($rpc_data);
        if(!$result['status']){
            $this->splash('error', $signup_url, '注册失败,会员数据保存异常');
        }
        //end 调用接口
        $member_sdf_data['b2c_members']['buyer_id'] = $result['result']['buyer_id'];
        $member_sdf_data['pam_account']['password'] = $params['pam_account']['login_password'];
        if ($member_id = $this->passport_obj->save_members($member_sdf_data, $msg)) {
            $this->user_obj->set_member_session($member_id);
            $this->bind_member($member_id);
            /* 本站会员注册完成后做某些操作! */
            foreach (vmc::servicelist('member.create_after') as $object) {
                $object->create_after($member_id);
            }
            $this->splash('success', $next, '注册成功');
        } else {
            $this->splash('error', $signup_url, '注册失败,会员数据保存异常');
        }
    }

    /**
     * 重置密码操作
     */
    public function reset_password($action)
    {

        $this->title = '重置密码';
        if ($action == 'doreset') {
            $redirect_here = array('app' => 'b2c', 'ctl' => 'site_passport', 'act' => 'reset_password');
            $params = $_POST;
            $forward = $params['forward'];
            if (!$forward) {
                $forward = $this->gen_url(array(
                    'app' => 'site',
                    'ctl' => 'index',
                ));
            }
            if (empty($params['new_password'])) {
                $this->splash('error', $redirect_here, '请输入新密码!');
            }
            if ($params['new_password1'] != $params['new_password']) {
                $this->splash('error', $redirect_here, '两次输入的密码不一致!');
            }

//            if (!vmc::singleton('b2c_user_vcode')->verify($params['vcode'], $params['account'], 'reset')) {
//                $this->splash('error', $redirect_here, '验证码错误！');
//            }
            $result = $this->app->model('members')->getRow('member_id', array('mobile' => $params['account']));
            if(empty($result)){
                $this->splash('error', $redirect_here, '未知帐号!');
            }
            $p_m = app::get('pam')->model('members')->getRow('member_id', array('member_id' => $result['member_id']));
            if (empty($p_m['member_id'])) {
                $this->splash('error', $redirect_here, '帐号异常!');
            }
            $member_id = $p_m['member_id'];
            if (!$this->passport_obj->reset_password($member_id, $params['new_password'])) {
                $this->splash('error', $redirect_here, '密码重置失败!');
            }
            /**
             * 润和接口 修改密码 IBY121201
             */
            $buyer_id = app::get('b2c')->model('members')->getRow('buyer_id',array('member_id'=>$member_id));
            $password = app::get('pam')->model('members')->getRow('password,login_account',array('member_id'=>$member_id));
            $api_data = array(
                'buyerId' => $buyer_id['buyer_id'],
                'accountName' => $password['login_account'],
                'oldAccountPass' => $password['password'],
                'newAccountPass' => $params['new_password'],
            );
            $rpc_password = app::get('b2c')->rpc('edit_password');
            $result = $rpc_password->request($api_data);


            /**
             * 直接登录操作
             */
//            $this->unset_member();
//            //设置session
//            $this->user_obj->set_member_session($member_id);
//            //设置客户端cookie
//            $this->bind_member($member_id);
            $redirect = $this->gen_url(array('app' => 'b2c', 'ctl' => 'site_passport', 'act' => 'login'));
            $this->splash('success', $redirect, '密码重置成功，请重新登录');
        } else {
            $this->set_tmpl('passport');
            $this->page('site/passport/reset_password.html');
        }
    }

    //发送身份识别验证码
    public function member_vcode()
    {
        $account = $_POST['account'];
        $login_type = $this->passport_obj->get_login_account_type($account);
        if ($login_type != 'email' && $login_type != 'mobile') {
            $this->splash('error', null, '请输入正确的手机或邮箱!');
        }
        if (!$this->passport_obj->is_exists_mobile($account)) {
            $this->splash('error', null, '验证手机不正确!');
        }
        if (!$vcode = vmc::singleton('b2c_user_vcode')->set_vcode($account, 'reset', $msg)) {
            $this->splash('error', null, $msg);
        }
        $this->splash('success', $vcode, '短信已发送');
        //$data[$login_type] = $account;
        $data['vcode'] = $vcode;
        switch ($login_type) {
            case 'email':
                $send_flag = vmc::singleton('b2c_user_vcode')->send_email('reset', (string)$account, $data);
                break;
            case 'mobile':
                $send_flag = vmc::singleton('b2c_user_vcode')->send_sms('reset', (string)$account, $data);
                break;
        }
        if (!$send_flag) {
            $this->splash('error', null, '发送失败');
        }
        $this->splash('success', null, '发送成功');
    }

    //发送邮件验证码
    public function send_vcode_email($type = "activation")
    {
        $email = $_POST['email'];

//        if (!$this->passport_obj->check_signup_account(trim($email), $msg)) {
//            $this->splash('error', null, $msg);
//        }
        $msg = $this->passport_obj->get_login_account_type($email);
        if ($msg != 'email') {
            $this->splash('error', null, '邮箱格式错误');
        }
        $uvcode_obj = vmc::singleton('b2c_user_vcode');
        $vcode = $uvcode_obj->set_vcode($email, $type, $msg);
        if ($vcode) {
            //发送邮箱验证码
            $data['vcode'] = $vcode;
            if (!$uvcode_obj->send_email($type, (string)$email, $data)) {
                $this->splash('error', null, '邮件发送失败');
            }
        } else {
            $this->splash('failed', null, $msg);
        }
        $this->splash('success', null, '邮件已发送');
    }

    //短信发送验证码
    public function send_vcode_sms($type = 'signup')
    {

        $mobile = trim($_POST['mobile']);
        /*
         * 不用判断手机唯一性
        if (!$this->passport_obj->check_signup_account($mobile, $msg)) {
            $this->splash('error', null, $msg);
        }
        */
        $msg = $this->passport_obj->get_login_account_type($mobile);
        if ($msg != 'mobile') {
            $this->splash('error', null, '错误的手机格式');
        }
        $uvcode_obj = vmc::singleton('b2c_user_vcode');
        $vcode = $uvcode_obj->set_vcode($mobile, $type, $msg);
        $this->splash('success', $vcode, '短信已发送');
        if ($vcode) {
            //发送验证码 发送短信
            $data['vcode'] = $vcode;
            if (!$uvcode_obj->send_sms($type, (string)$mobile, $data)) {
                $this->splash('error', null, '短信发送失败');
            }
        } else {
            $this->splash('failed', null, $msg);
        }
        $this->splash('success', null, '短信已发送');
    }

    public function logout($forward)
    {
        /**
         * 润和接口 退出登录  IBY121201
         */
        $this->unset_member();
        if (!$forward) {
            $forward = $this->gen_url(array(
                'app' => 'site',
                'ctl' => 'index',
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
        $this->cookie_path = vmc::base_url() . '/';
        $this->set_cookie('UNAME', '', time() - 3600); //用户名
        $this->set_cookie('MEMBER_IDENT', 0, time() - 3600); //会员ID
        $this->set_cookie('MEMBER_LEVEL_ID', 0, time() - 3600); //会员等级ID
        foreach (vmc::servicelist('member.logout_after') as $service) {
            $service->logout();
        }
    }

}
