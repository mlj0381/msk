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
    public function __construct(&$app){
        parent::__construct($app);
        $this->seller = $this->get_current_seller();
    }

    public function index(){
      $this->check_login();
      $this->login();
    }
    //检查登录
    public function check_login(){
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
    public function login(){
       $this->title = '商家登录';
       $this->check_login();
       $this->set_forward($forward);
       $mdl_toauth_pam = app::get('toauth')->model('pam')->getList('*',array('status'=>'true'));
       $this->pagedata['toauth'] = $mdl_toauth_pam;
       $this->set_tmpl('passport');
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
            $this->splash('error', $login_url,  $msg);
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
    } //end function

    /**
     * 新需求卖家注册项
     */
    
    public function new_signup(){
        $this->set_tmpl('passport');
        $this->page('site/passport/new_signup.html');
    }

    //注册页面
    public function signup($step)
    {
        $this->title = '注册成为商家';
        $this->set_tmpl('passport');
        //检查是否登录，如果已登录则直接跳转到会员中心
        //$this->check_login();
        //$this->set_forward($forward); //设置登录成功后跳转
        //获取会员注册项
        if ($this->app->getConf('member_signup_show_attr') == 'true') {
            $this->pagedata['attr'] = $this->passport_obj->get_signup_attr();
        }
        if($_POST) $this->_signup($_POST, $step);
        switch($step)
        {
            case '1':
                $tpl = 'signup_companyInfo';
                break;
            case '2':
                $tpl = 'signup_contactInfo';
                break;
            case '3':
                $tpl = 'signup_complete';
                break;
            default:
                $tpl = 'signup';
                break;
        }
        $this->page('site/passport/'.$tpl.'.html');

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
                $return = $this->_signup_account($post, $redirect);
                break;
            case '2':
                $return = $this->passport_obj->signup_company($post['seller']);
                break;
            case '3':
                $post['contact']['seller_id'] = $this->seller['seller_id'];
                $return = $this->passport_obj->signup_contactInfo($post['contact']);
                break;
        }
        if($return){
            $this->splash('success', $redirect, '注册成功');
        }else{
            $this->splash('error', null, '注册失败');
        }
    }

    //入驻首页
    public function settled_index(){
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/settled.html');
    }
    //入驻流程
    public function settled_process(){
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/settled_process.html');
    }

    //招商标准
    public function insvestment(){
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/insvestment.html');
    }

    //资质要求
    public function aptitudes(){
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/aptitudes.html');
    }

    //资费标准
    public function tariff(){
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/tariff.html');
    }

    //联系方式
    public function contact(){
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/contact.html');
    }

    //注意事项
    public function payAttention(){
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/payAttention.html');
    }

    //关于美侍客
    public function aboutmsk(){
        $this->set_tmpl('seller_settled');
        $this->page('site/passport/settled/aboutmsk.html');
    }

    //入驻方法
    public function settled($step){
        $this->verify();
        $this->pagedata['store'] = $this->user_obj->get_store($this->seller['seller_id']);
        $this->pagedata['company'] = $this->user_obj->get_company($this->seller['seller_id']);
        $this->pagedata['contact'] = $this->user_obj->get_contact($this->seller['seller_id']);
        if($_POST) $this->_settled($_POST, $step);
        switch ($step) {
           case '1':
               $tpl = 'company';//公司信息
               break;
           case '2':
               $tpl = 'shop';//店铺信息
               break;
           case '3':
               $tpl = 'complete';//完成
               break;
           case '4':
               $tpl = 'status';//进度查询
               break;
           default:
               $tpl = 'account';//帐号
               break;
        }
        $this->page("site/passport/apply.{$tpl}.html");
    }

    private function _settled($post, $step){
        $redirect = $this->gen_url(array(
          'app' => 'seller',
          'ctl' => 'site_passport',
          'act' => 'settled',
          'args0' => $step,
      ));
      $post['seller']['seller_id'] = $this->seller['seller_id'];
      switch ($step) {
          case '2':
              $return = $this->passport_obj->settled_company($post['seller']);//公司信息
              break;
          case '3':
              $return = $this->passport_obj->signup_shop($post['seller']); //店铺
              break;
          case '4':

              break;
    }
      if($return){
          $this->splash('success', $redirect, '注册成功');
      }else{
          $this->splash('error', $redirect, '注册失败，数据保存异常');
      }
    }

    //商家入驻帐号注册
   private function _signup_account($post, $signup_url){
       extract($post);
       if(!vmc::singleton('seller_user_vcode')->verify($smscode, $pam_account['mobile'], 'signup'))
       {
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
       }else{
           return false;
       }
   }
    //检查用户名
    public function check_login_name(){
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
    public function send_vcode_sms($type = 'signup'){
        $mobile = trim($_POST['mobile']);
        if($_POST['type'] != 'securitycenter'){
            if (!$this->passport_obj->check_signup_account($mobile, $msg)) {
              $this->splash('error', null, $msg);
            }

            if($msg != 'mobile'){
              $this->splash('error', null, '错误的手机格式');
            }
        }else{
            if('mobile' != $this->passport_obj->get_login_account_type($_POST['mobile'])){
                $this->splash('error', null, '错误的手机格式');
            }
        }

        $uvcode_obj = vmc::singleton('seller_user_vcode');
        $vcode = $uvcode_obj->set_vcode($mobile, $type , $msg);
        $this->splash('success', $vcode, '短信已发送'); // 2015/9/7 短信直接显示

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
    //重置密码
    public function reset_password(){

        $redirect = $this->gen_url(array(
          'app' => 'seller',
          'ctl' => 'site_seller',
          'act' => 'securitycenter',
        ));
        extract($_POST);
        if(!vmc::singleton('seller_user_vcode')->verify($smscode, $pam_account['mobile'], 'signup'))
        {
            $this->splash('error', $redirect, '手机短信验证码不正确');
        }
        if($pam_account['login_password'] != $pam_account['psw_confirm']){
            $this->splash('error', $redirect, '确认密码输入不正确');
        }
        if(!$this->passport_obj->reset_password($this->seller['seller_id'], $pam_account['psw_confirm'])){
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
}
