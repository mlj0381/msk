<?php
class freeze_ctl_site_passport extends freeze_frontpage{

    function __construct(&$app)
    {
        parent::__construct($app);
        $this->passport_obj = vmc::singleton('freeze_user_passport');
        $this->user_obj = vmc::singleton('freeze_user_object');
    }

    /**
     * 注册冻品管家信息
     */
    public function signup()
    {
        $params = $_POST;
        $next = $this->gen_url(array(
            'app' => 'buyer',
            'ctl' => 'site_manager',
            'act' => 'index',
        )); //PC首页

        $signup_url = $this->gen_url(array(
            'app' => 'buyer',
            'ctl' => 'site_manager',
            'act' => 'manager_signup',
        ));
        $member_sdf_data = $this->passport_obj->pre_signup_process($params);

        //开启事务
        $db = vmc::database();
        $this->transaction_status = $db->beginTransaction();

        if ($member_id = $this->passport_obj->save_members($member_sdf_data, $msg)) {
//            $this->user_obj->set_member_session($member_id);
            $this->bind_freeze($member_id);

            $db->commit($this->transaction_status); //事务提交
            $this->splash('success', $next, '注册成功');
        } else {
            $db->rollback(); //事务回滚
            $this->splash('error', $signup_url, '注册失败,会员数据保存异常');
        }
    }

    /**
     * 登录冻品管家
     */
    public function login($forward)
    {
        //如果会员登录则直接跳转到会员中心
        $this->check_login();
        $this->set_forward($forward); //设置登录成功后跳转

        $this->page('site/passport/login.html');
    }

    /*
     * 登录验证
     * */
    public function post_login()
    {
        $login_url = $this->gen_url(array(
            'app' => 'freeze',
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

        //尝试登陆
        $member_id = vmc::singleton('pam_passport_site_basic')->login($account_data, $params['vcode'], $msg,'freeze');
        if (!$member_id) {
            $this->splash('error', $login_url, $msg);
        }
        //设置session
        $this->user_obj->set_member_session($member_id);

        $forward = $params['forward'];
        if (!$forward) {
            $forward = $this->gen_url(array(
                'app' => 'freeze',
                'ctl' => 'site_freeze',
                'act' => 'index',
            ));
        }
        $this->splash('success', $forward, '登录成功');
    }

    /**
     * 删除冻品管家
     */
    public function delete_freeze()
    {

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

    /*
     * 如果是登录状态则直接跳转到会员中心
     * */
    public function check_login()
    {
        if ($this->user_obj->is_login()) {
            $redirect = $this->gen_url(array(
                'app' => 'freeze',
                'ctl' => 'site_freeze',
                'act' => 'index',
            ));
            $this->splash('success', $redirect, '已经是登陆状态！');
        }

        return false;
    }
}

?>