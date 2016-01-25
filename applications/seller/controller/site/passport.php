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
// | 商家品牌申请、授权
// +----------------------------------------------------------------------

class seller_ctl_site_passport extends seller_frontpage
{

    public function __construct(&$app)
    {
        parent::__construct($app);
        $this->seller = $this->get_current_seller();
        $this->set_tmpl('passport');
    }

    public function index()
    {
        $this->check_login();
        $this->login();
    }

    //检查登录
    public function check_login()
    {
        if ($this->user_obj->is_login()) {
            $redirect = $this->gen_url(array(
                'app' => 'seller',
                'ctl' => 'site_seller',
                'act' => 'index',
            ));
            $this->splash('success', $redirect, '已经是登陆状态！');
        }
        return false;
    }

    //登录方法
    /**
     *
     */
    public function login()
    {
        $this->title = '商家登录';
        $this->check_login();
        $this->set_forward($forward);
        $mdl_toauth_pam = app::get('toauth')->model('pam')->getList('*', array('status' => 'true'));
        $this->pagedata['toauth'] = $mdl_toauth_pam;

        $this->page('site/passport/login.html');
    }

    public function post_login()
    {
        $login_url = $this->gen_url(array(
            'app' => 'seller',
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
        $seller_id = vmc::singleton('pam_passport_site_basic')->login($account_data, $params['vcode'], $msg, 'sellers');
        if (!$seller_id) {
            $this->splash('error', $login_url, $msg);
        }

        //设置session
        $this->user_obj->set_seller_session($seller_id);
        //设置客户端cookie
        $this->bind_seller($seller_id);
        $forward = $params['forward'];
        if (!$forward) {
            $forward = $this->gen_url(array(
                'app' => 'seller',
                'ctl' => 'site_seller',
                'act' => 'index',
            ));
        }
        $this->splash('success', $forward, '登录成功');
    }

//end function
    //注册页面
    public function signup($step)
    {
        $this->title = '注册成为商家';
        $this->set_tmpl('passport');
        //检查是否登录，如果已登录则直接跳转到会员中心
        //$this->check_login();
        //$this->set_forward($forward); //设置登录成功后跳转
        if ($_POST)
            $this->_signup($_POST, $step);
        switch ($step) {
            case '1':
                $tpl = 'signup_companyType';
                break;
            case '2':
                $tpl = 'signup_companyInfo';
                break;
            case '4':
                $tpl = 'signup_complete';
                break;
            default:
                $tpl = 'signup';
                break;
        }
        $this->page('site/passport/' . $tpl . '.html');
    }

    private function _signup($post, $step)
    {
        $redirect = $this->gen_url(array(
            'app' => 'seller',
            'ctl' => 'site_passport',
            'act' => 'signup',
            'args' => array($step),
        ));
        $return = false;
        switch ($step) {
            case '1':
                if (!$post['treaty']) {
                    $this->splash('error', '', '请详细阅读入驻协议');
                }
                $return = $this->_signup_account($post, $redirect);
                break;
        }
        if ($return) {
            $this->splash('success', $redirect, '注册成功');
        } else {
            $this->splash('error', null, '注册失败');
        }
    }

    //入驻进度
    public function complete(){
        $this->page('site/passport/signup_complete.html');
    }

    //入驻首页
    public function settled_index()
    {
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/settled.html');
    }

    //入驻流程
    public function settled_process()
    {
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/settled_process.html');
    }

    //招商标准
    public function insvestment()
    {
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/insvestment.html');
    }

    //资质要求
    public function aptitudes()
    {
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/aptitudes.html');
    }

    //资费标准
    public function tariff()
    {
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/tariff.html');
    }

    //联系方式
    public function contact()
    {
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/contact.html');
    }

    //注意事项
    public function payAttention()
    {
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/payAttention.html');
    }

    //关于美侍客
    public function aboutmsk()
    {
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/aboutmsk.html');
    }

    //入驻方法
    public function settled($step)
    {

        $this->verify();
        $this->pagedata['store'] = $this->user_obj->get_store($this->seller['seller_id']);
        if ($_POST)
            $this->_settled($_POST, $step);
        switch ($step) {
            case '1':
                $tpl = 'company'; //公司信息
                break;
            case '2':
                $tpl = 'shop'; //店铺信息
                break;
            case '3':
                $tpl = 'complete'; //完成
                break;
            case '4':
                $tpl = 'status'; //进度查询
                break;
            default:
                $tpl = 'account'; //帐号
                break;
        }
        $this->page("site/passport/apply.{$tpl}.html");
    }

    private function _settled($post, $step)
    {
        $redirect = $this->gen_url(array(
            'app' => 'seller',
            'ctl' => 'site_passport',
            'act' => 'settled',
            'args0' => $step,
        ));
        $post['seller']['seller_id'] = $this->seller['seller_id'];
        switch ($step) {
            case '2':
                $return = $this->passport_obj->settled_company($post['seller']); //公司信息
                break;
            case '3':
                $return = $this->passport_obj->signup_shop($post['seller']); //店铺
                break;
            case '4':

                break;
        }
        if ($return) {
            $this->splash('success', $redirect, '注册成功');
        } else {
            $this->splash('error', $redirect, '注册失败，数据保存异常');
        }
    }

    //商家入驻帐号注册
    private function _signup_account($post, $signup_url)
    {
        extract($post);
        if (!vmc::singleton('seller_user_vcode')->verify($smscode, $pam_account['mobile'], 'signup')) {
            $this->splash('error', $signup_url, '手机短信验证码不正确');
        }
        if (!$this->passport_obj->check_signup($post, $msg)) {
            $this->splash('error', $signup_url, $msg);
        }
        $seller_sdf_data = $this->passport_obj->pre_signup_process($post);

        if ($seller_id = $this->passport_obj->save_sellers($seller_sdf_data, $msg)) {
            /*
              //本站会员注册完成后做某些操作!
              foreach (vmc::servicelist('seller.create_after') as $object) {
              $object->create_after($seller_id);
              }
             */
            $this->user_obj->set_seller_session($seller_id);
            $this->bind_seller($seller_id);
            return true;
        } else {
            return false;
        }
    }

    //检查用户名
    public function check_login_name()
    {
        if ($this->passport_obj->check_signup_account(trim($_POST['pam_account']['login_name']), $msg)) {
            if ($msg == 'mobile') { //用户名为手机号码
                $this->splash('success', null, array(
                    'is_mobile' => 'true',
                ));
            }
            $this->splash('success', null, '该账号可以使用');
        } else {
            $this->splash('error', null, $msg, true);
        }
    }

    //发送短信验证码
    public function send_vcode_sms($type = 'signup')
    {
        $mobile = trim($_POST['mobile']);
        if ($_POST['type'] != 'securitycenter') {
            if (!$this->passport_obj->check_signup_account($mobile, $msg)) {
                $this->splash('error', null, $msg);
            }

            if ($msg != 'mobile') {
                $this->splash('error', null, '错误的手机格式');
            }
        } else {
            if ('mobile' != $this->passport_obj->get_login_account_type($_POST['mobile'])) {
                $this->splash('error', null, '错误的手机格式');
            }
        }

        $uvcode_obj = vmc::singleton('seller_user_vcode');
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

    //重置密码
    public function reset_password()
    {

        $redirect = $this->gen_url(array(
            'app' => 'seller',
            'ctl' => 'site_seller',
            'act' => 'securitycenter',
        ));
        extract($_POST);
        if (!vmc::singleton('seller_user_vcode')->verify($smscode, $pam_account['mobile'], 'signup')) {
            $this->splash('error', $redirect, '手机短信验证码不正确');
        }
        if ($pam_account['login_password'] != $pam_account['psw_confirm']) {
            $this->splash('error', $redirect, '确认密码输入不正确');
        }
        if (!$this->passport_obj->reset_password($this->seller['seller_id'], $pam_account['psw_confirm'])) {
            $this->splash('error', $redirect, '重置失败');
        }
        $this->splash('success', $redirect, '重置成功');
    }

    //退出登录
    public function logout($forward)
    {
        $this->unset_seller();
        if (!$forward) {
            $forward = $this->gen_url(array(
                'app' => 'site',
                'ctl' => 'index',
                'full' => 1,
            ));
        }
        $this->splash('success', $forward, '退出登录成功');
    }

    // 入驻
    public function entry($step = 0, $type)
    {
        $this->verify();
        if ($_POST) {
            $params = utils::_filter_input($_POST);
            unset($_POST);
            $this->_entry($params);
        }
        $step = $params['pageIndex'] ? $params['pageIndex'] : $step;
        $step = $type == 'up' ? $step - 1 : $step + 1;
        $step <= 1 && $step = 1;
        $step >= 10 && $step = 10;
        if ($step == '1') {
            $licence_type = $this->_new_or_old();
        }

        $columns = $this->passport_obj->page_setting($step, $licence_type);
        $this->pagedata['info'] = $this->edit_info($columns);
        $this->pagedata['page'] = $columns;
        $this->pagedata['pageIndex'] = $step;
        if ($step == 10) {
            $this->page('site/passport/signup_complete.html');
        } else {
            $this->page('site/passport/signup_companyInfo.html');
        }
    }

    //营业执照类型 老版or新版
    private function _new_or_old()
    {
        $licence_type = $this->_request->get_get('card');
        if ($licence_type)
            return $licence_type;
        $licence_type = $licence_type ? $licence_type : 'new';
        //查询入住营业执照信息判断是否是新版还是老版
        $checked = app::get('base')->model('company_extra')->getRow('*', array('uid' => $this->seller['seller_id'], 'from' => '1', 'key|in' => array('business_licence', 'three_lesstion')), '0', '1', 'content_id desc');
        $licence_type = $checked['key'] == 'three_lesstion' ? 'new' : 'old';
        return $licence_type;
    }

    //查询已注册的信息
    public function &edit_info($columns)
    {
        $info = array();
        $filter = array('uid' => $this->seller['seller_id'], 'from' => '1');
        $company_extra = app::get('base')->model('company_extra')->
        getList('*', array_merge($filter, array('key|in' => array_keys($columns))));
        $conf = $this->app->getConf('seller_entry');
        foreach ($company_extra as $value) {

            if (in_array($value['key'], $conf['array_info'])) {
                $info['company_extra'][$value['key']][] = $value;
                continue;
            }
            $info['company_extra'][$value['key']] = $value;
        }
        $info['company_extra']['store'] = app::get('store')->model('store')->getRow('*', array('seller_id' => $filter['uid']));
        $info['company_extra']['company'] = app::get('base')->model('company')->getRow('*', $filter);
        $info['company_extra']['contact'] = app::get('base')->model('contact')->getRow('*', $filter);
        $info['company_extra']['brand'] = $this->app->model('brand')->getRow('*', array('seller_id' => $this->seller['seller_id']));
        return $info;
    }

    //ajax提交保存电商团队成员
    public function save_ecgroup()
    {
        if (!$_POST) {
            $this->splash('error', '', '非法请求');
        }
        $params = utils::_filter_input($_POST);
        unset($_POST);
        $type = key($params);
        $data = array();
        foreach ($params[$type]['value'] as $key => $value) {
            $data[$type]['value'][$key] = $value[0];
        }

        $data[$type]['uid'] = $this->seller['seller_id'];
        $data[$type]['from'] = '1';
        $data[$type]['key'] = $type;
        $data[$type]['attach'] = $params[$type]['attach'][0];
        $func_name = $data[$type]['content_id'] ? 'save' : 'insert';
        $mdl_company_extra = app::get('base')->model('company_extra');
        $result = $mdl_company_extra->$func_name($data[$type]);
        $data[$type]['content_id'] = $func_name == 'insert' ? $result : $data[$type]['content_id'];
        if (!$result) {
            $this->splash('error', '', '操作失败');
        }
        $this->splash('success', '', $data[$type]);
    }

    private function _entry($params)
    {
        $db = vmc::database();
        $db->beginTransaction();
        $extra_columns = $this->passport_obj->page_setting($params['pageIndex']);

        //公司信息
        if (isset($params['company']) && !empty($params['company'])) {
            $params['company']['uid'] = $this->seller['seller_id'];
            $params['company']['from'] = '1';
            if (!app::get('base')->model('company')->save($params['company'])) {
                $db->rollback();
                $this->splash('error', $redirect, '注册失败');
            }
        }
        //联第人信息

        if (isset($params['contact']) && !empty($params['contact'])) {
            $params['contact']['uid'] = $this->seller['seller_id'];
            $params['contact']['from'] = '1';
            if (!app::get('base')->model('contact')->save($params['contact'])) {
                $db->rollback();
                $this->splash('error', $redirect, '注册失败');
            }
        }
        //品牌
        if (isset($params['brand']) && !empty($params['brand'])) {
            $params['brand']['seller_id'] = $this->seller['seller_id'];
            if (!$params['brand']['brand_id']) {
                if (!$barand_id = app::get('b2c')->model('brand')->insert($params['brand'])) {
                    $db->rollback();
                    $this->splash('error', $redirect, '注册失败');
                }
                $params['brand_id'] = $barand_id;
            } else if (!app::get('b2c')->model('brand')->save($params['brand'])) {
                $db->rollback();
                $this->splash('error', $redirect, '注册失败');
            }

            if (!$this->app->model('brand')->save($params['brand'])) {

                $db->rollback();
                $this->splash('error', $redirect, '注册失败');
            }
        }
        //店铺
        if (isset($params['store']) && !empty($params['store'])) {
            $params['store']['seller_id'] = $this->seller['seller_id'];
            if (!app::get('store')->model('store')->save($params['store'])) {
                $db->rollback();
                $this->splash('error', $redirect, '注册失败');
            }
        }
        //扩展

        $mdl_company_extra = app::get('base')->model('company_extra');
        foreach ($extra_columns as $key => $col) {
            if (isset($params[$key]) && !empty($params[$key])) {
                $params[$key]['content_id'] = $params[$key]['content_id'];
                $params[$key]['uid'] = $this->seller['seller_id'];
                $params[$key]['from'] = 1;
                //电商成员信息
                if (is_array(reset($params[$key]['value']))) {
                    if (!$this->_save_array($key, $params[$key])) {
                        $db->rollback();
                        $this->splash('error', $redirect, '注册失败');
                    }
                    continue;
                }
                if (!$mdl_company_extra->extra_save($key, $params)) {
                    $db->rollback();
                    $this->splash('error', $redirect, '注册失败');
                }
            }
        }
        $data = array('seller_id' => $this->seller['seller_id'], 'schedule' => $params['pageIndex']);
        if (!$this->app->model('sellers')->save($data)) {
            $db->rollback();
            $this->splash('error', $redirect, '注册失败');
        }
        $db->commit();
    }

    private function _save_array($key, $params = null)
    {
        if (!empty($params)) {
            $mdl_company_extra = app::get('base')->model('company_extra');
            $first_arr = reset($params['value']);
            $length = count($first_arr);
            for ($i = 0; $i < $length; $i++) {
                if (empty($first_arr[$i])) {
                    continue;
                }
                $data['uid'] = $this->seller['seller_id'];
                $data['from'] = 1;
                $data['content_id'] = $params['content_id'][$i];
                $data['attach'] = $params['attach'][$i];
                $data['key'] = $key;
                $data['attach'] = $params['attach'][$i];

                foreach ($params['value'] as $k => $v) {
                    $data['value'][$k] = $v[$i];

                }
                if (!$mdl_company_extra->save($data)) {
                    return false;
                }
            }
            return true;
        }
    }

    //ajax删除电商团队、主要设备
    public function del_extra()
    {
        if(!$_POST){
            $this->splash('error', '', '非法请求');
        }
        $data = array('content_id' => $_POST['content_id'], 'uid' => $this->member['member_id']);
        if(!app::get('base')->model('company_extra')->delete($data)){
            $this->splash('error', '', '操作失败');
        }
        $this->splash('success', '', '操作成功');
    }

    //商家入驻类型选择
    public function identity()
    {
        (!$_POST['ident'] || !is_numeric($_POST['ident'])) && $this->splash('error', '', '非法请求');
        if ($_POST) {
            $data = array('seller_id' => $this->seller['seller_id'], 'ident' => $_POST['ident']);
            if (!$this->app->model('sellers')->save($data)) {
                $this->splash('error', '', '操作失败');
            }
            $this->splash('success', '', '操作成功');
        }
        $this->splash('error', '', '非法请求');
    }

}
