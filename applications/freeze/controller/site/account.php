<?php

class freeze_ctl_site_account extends freeze_frontpage
{
    function __construct(&$app)
    {
        parent::__construct($app);
        $this->verify_member();
        $this->menuSetting = 'account';
    }

    /**
     * 冻品管家基本信息
     */
    public function index()
    {

        $user_obj = vmc::singleton('freeze_user_object');
        $info = $user_obj->get_members_data(array('account' => 'login_account', 'freeze' => '*'));

        $this->pagedata['login_account'] = $info['account']['login_account'];
        $this->pagedata['info'] = $info['freeze'];
        $this->output();
    }

    /**
     * 冻品管家基本信息保存
     */
    public function basic_info()
    {
        $error_url = $this->gen_url(array(
            'app' => 'freeze',
            'ctl' => 'site_account',
            'act' => 'index',
        ));
        $url = $this->gen_url(array(
            'app' => 'freeze',
            'ctl' => 'site_account',
            'act' => 'index',
        ));
        $data = $_POST;
        $freeze_model = app::get('freeze')->model('freeze');
        if (!$this->generate($data, $msg)) {
            $this->splash('error', $error_url, $msg);
        };

        if (!$freeze_model->save($data)) {
            $this->splash('error', $error_url, '信息保存失败');
        }

        $this->splash('success', $url, '信息保存成功');
    }

    /**
     * 买手店信息
     */
    public function buyer_info()
    {
        $this->is_complete_info();
        $mdl_buyer = app::get('buyer')->model('buyers');
        $mdl_freeze_buyer = app::get('freeze')->model('freeze_buyer');
        $buyer_id = $mdl_freeze_buyer->getRow('*', array('freeze_id' => $this->app->freeze_id));

        $buyer_info = $mdl_buyer->getRow('*', array('buyer_id' => $buyer_id['buyer_id']));
        $this->pagedata['buyer'] = $buyer_info;
        $this->output();
    }

    /**
     * 安全设置
     */
    public function security()
    {
        $this->is_complete_info();
        $user_obj = vmc::singleton('freeze_user_object');
        $this->pagedata['pam_data'] = $user_obj->get_pam_data('*', $this->app->freeze_id);
        $this->output();
    }

    /**
     * 设置手机号码
     */
    public function set_pam_mobile($action)
    {
        if ($action == 'save') {
            $redirect_here = array('app' => 'freeze', 'ctl' => 'site_account', 'act' => 'set_pam_mobile');
            $redirect = $this->gen_url(array('app' => 'freeze', 'ctl' => 'site_account', 'act' => 'security'));
            $model_freeze = app::get('freeze')->model('freeze');
            $params = $_POST;
            $mobile = $params['mobile'];
            if (!vmc::singleton('b2c_user_vcode')->verify($params['vcode'], $params['mobile'], 'freeze_reset')) {
                $this->splash('error', $redirect_here, '手机短信验证码不正确');
            }
//            !vmc::singleton('freeze_user_passport')->set_mobile($mobile, $msg) //该方法添加多个登录账号的时候
            $data = array(
                'freeze_id' => $params['freeze_id'],
                'mobile' => $mobile
            );
            if (!$model_freeze->save($data)) {
                $this->splash('error', $redirect_here, $msg);
            } else {
                $this->splash('success', $redirect, $msg);
            }
        } else {
            $user_obj = vmc::singleton('freeze_user_object');
            $info = $user_obj->get_members_data(array('account' => 'login_account', 'freeze' => 'mobile,freeze_id'));
//            if($mobile = $user_obj->_get_pam_type_data('login_account','mobile'))  //该方法取的是手机为登录账号
//            {
//                $info['freeze']['mobile'] = $mobile['login_account'];
//            };
            $this->pagedata['info'] = $info;
            $this->output();
        }
    }

    /**
     * 设置身份证号码
     */
    public function set_ID($action)
    {
        if ($action == 'save') {
            $redirect_here = array('app' => 'freeze', 'ctl' => 'site_account', 'act' => 'set_ID');
            $redirect = $this->gen_url(array('app' => 'freeze', 'ctl' => 'site_account', 'act' => 'security'));
            $mdl_freeze = app::get('freeze')->model('freeze');
            $user_obj = vmc::singleton('freeze_user_object');
            $freeze_id = $this->app->freeze_id;
            $data = $_POST;
            $data['freeze_id'] = $freeze_id;
            if (!$mdl_freeze->save($data)) {
                $this->splash('error', $redirect_here, $msg);
            } else {
                $this->splash('success', $redirect, '身份保存成功');
            }
        } else {
            $user_obj = vmc::singleton('freeze_user_object');
            $info = $user_obj->get_members_data(array('freeze' => '*'));
            $this->pagedata['info'] = $info;
            $this->output();
        }
    }

    /**
     * 设置邮箱
     */
    public function set_email($action)
    {
        if ($action == 'save') {
            $redirect_here = array('app' => 'freeze', 'ctl' => 'site_account', 'act' => 'set_email');
            $redirect = $this->gen_url(array('app' => 'freeze', 'ctl' => 'site_account', 'act' => 'security'));
            $mdl_freeze = app::get('freeze')->model('freeze');
            $user_obj = vmc::singleton('freeze_user_object');
            $freeze_id = $this->app->freeze_id;
            $data = $_POST;
            $data['freeze_id'] = $freeze_id;
            if (!$mdl_freeze->save($data)) {
                $this->splash('error', $redirect_here, $msg);
            } else {
                $this->splash('success', $redirect, '邮箱保存成功');
            }
        } else {
            $user_obj = vmc::singleton('freeze_user_object');
            $info = $user_obj->get_members_data(array('freeze' => '*'));
            $this->pagedata['info'] = $info;
            $this->output();
        }
    }

    /**
     * 修改登录密码
     */
    public function reset_password($action)
    {
        $this->title = '重置密码';
        if ($action == 'doreset') {
            $passport_obj = vmc::singleton('freeze_user_passport');
            $redirect_here = array('app' => 'freeze', 'ctl' => 'site_account', 'act' => 'reset_password');
            $params = $_POST;
            $forward = $params['forward'];
            if (!$forward) {
                $forward = $this->gen_url(array(
                    'app' => 'freeze',
                    'ctl' => 'site_account',
                    'act' => 'security'
                ));
            }
            if (empty($params['new_password'])) {
                $this->splash('error', $redirect_here, '请输入新密码!');
            }
            if ($params['new_password1'] != $params['new_password']) {
                $this->splash('error', $redirect_here, '两次输入的密码不一致!');
            }

            if (!vmc::singleton('b2c_user_vcode')->verify($params['vcode'], $params['mobile'], 'freeze_reset')) {
                $this->splash('error', $redirect_here, '手机短信验证码不正确');
            }

            $result = app::get('pam')->model('freeze')->getRow('freeze_id', array('login_account' => $params['mobile'], 'login_type' => 'mobile'));
            if (empty($result)) {
                $this->splash('error', $redirect_here, '未知帐号!');
            }
            $member_id = $result['freeze_id'];
            if (!$passport_obj->reset_password($member_id, $params['new_password'])) {
                $this->splash('error', $redirect_here, '密码重置失败!');
            }

            //退出当前登录状态
            $auth = pam_auth::instance(pam_account::get_account_type($this->app->app_id));
            if (!$auth->type) {
                $auth->type = $this->app->app_id;
            }
            foreach (vmc::servicelist('passport') as $k => $passport) {
                $passport->loginout($auth);
            }

            $redirect = $this->gen_url(array('app' => 'freeze', 'ctl' => 'site_passport', 'act' => 'login'));
            $this->splash('success', $redirect, '密码重置成功，请重新登录');
        } else {
            $user_obj = vmc::singleton('freeze_user_object');
            $mobile = $user_obj->_get_pam_type_data('login_account', 'mobile');

            $this->pagedata['mobile'] = $mobile['login_account'];
            $this->output();
        }
    }


    /**
     * 管家信息管理数据组织
     */
    public function generate(&$data, &$msg)
    {
        $user_obj = vmc::singleton('freeze_user_object');
        $freeze_model = app::get('freeze')->model('freeze');
        $generate_data = array();
        $generate_data['self_image'] = $data['self_image'];
        $generate_data['email'] = $data['email'];
        $generate_data['name'] = $data['name'];
        $generate_data['sex'] = $data['sex'];
        $generate_data['ID'] = $data['ID'];
        $generate_data['area'] = $data['area'];
        $generate_data['address'] = $data['address'];
        $generate_data['manage_area'] = $data['manage_area'];
        $generate_data['manage_address'] = $data['manage_address'];
        $generate_data['QQ'] = $data['QQ'];
        $generate_data['WeChat'] = $data['WeChat'];
        $generate_data['head_image'] = $data['head_image'];

        //处理3种情况：管家直接更改信息，管家自己修改信息，买手管家信息更改
        if (!$data['freeze_id']) {
            if ($freeze_id = $this->app->freeze_id) {
                $generate_data['freeze_id'] = $freeze_id;
            } else {
                $freeze_buyer_model = app::get('freeze')->model('freeze_buyer');
                $buyer_user_object = vmc::singleton('buyer_user_object');
                $buyer_id = $buyer_user_object->get_id();
                $freeze_id = $freeze_buyer_model->getRow('freeze_id', array('buyer_id' => $buyer_id));
                $generate_data['freeze_id'] = $freeze_id['freeze_id'];
            }
        }
        if (!$generate_data['freeze_id']) {
            $msg = '无效基本信息';
            return false;
        }
//        if($freeze_model->count(array('ID'=>$data['ID'],'freeze_id|notin'=>$generate_data['freeze_id'])) >0)
//        {
//            $msg  = '身份证已存在';
//            return false;
//        };
        $data = $generate_data;
        return true;
    }

    //发送短信验证码
    public function send_vcode($type = 'freeze_reset')
    {
        $this->passport_obj = vmc::singleton('freeze_user_passport');
        $mobile = trim($_POST['mobile']);
        if ($_POST['type'] != 'securitycenter') {
            /*
             * 不用检查手机号是否存在
            if (!$this->passport_obj->check_signup_account($mobile, $msg)) {
                $this->splash('error', null, $msg);
            }
            */
            $msg = $this->passport_obj->get_login_account_type($mobile);
            if ($msg != 'mobile') {
                $this->splash('error', null, '错误的手机格式');
            }
        } else {
            if ('mobile' != $this->passport_obj->get_login_account_type($_POST['mobile'])) {
                $this->splash('error', null, '错误的手机格式');
            }
        }

        $uvcode_obj = vmc::singleton('b2c_user_vcode');
        $vcode = $uvcode_obj->set_vcode($mobile, $type, $msg);
        $this->splash('success', $vcode, '短信已发送'); // 2015/9/7 短信直接显示

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

}

?>