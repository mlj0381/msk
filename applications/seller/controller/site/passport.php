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
      
        /**
         * 润和接口 卖家登入  【查询卖家账户 - ISL231105】
         */
//         $result = $this->app->rpc('select_seller_info')->request(array('login_account' =>  $params['uname'] ));
//         if(!$result['status']){
//         	$this->splash('error', $login_url, '登录失败！');
//         }else{
//         	/* 用户基本信息 */
//         	$seller	= array();
//         	$seller['mobile'] = $result['result']['slAccount']['slTel'];
//         	$seller['api_seller_id'] = $result['result']['slSeller']['epId'];
        	
//         	/* 用户账户信息 */
//         	$account = array();
//         	$account['login_account'] 	 = $params['uname'];
//         	$account['createtime'] 		 = time();
//         	$account['login_password']	 = $login_password = pam_encrypt::get_encrypted_password($result['result']['slAccount']['accountPsd'], 'seller', array(
//         			'createtime' => $account['createtime'],
//         			'login_name' => $params['uname'],
//         	));
//         	$account['password']	 = $result['result']['slAccount']['accountPsd'];
//         	$account['password_account'] = $params['uname'];
//         	$account['login_type'] 		 = $this->passport_obj->get_login_account_type($params['uname']);;
//         	$account['api_seller']		 = $result['result']['slSeller']['epId'];
//         	vmc::singleton('pam_passport_site_basic')->local_seller_rsyns($seller,$account);
//         }
       
       
        //尝试登陆
        $seller_id = vmc::singleton('pam_passport_site_basic')->login($account_data, $params['vcode'], $msg, 'sellers');
        if (!$seller_id) {
            $this->splash('error', $login_url, $msg);
        }

        //设置session
        $this->user_obj->set_session($seller_id);
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


    //添加品牌资质
    public function brand_aptitude($step = 0, $type)
    {
        $this->verify();
        $params = $this->_request->get_get();
        $identity = $params['identity'];
        $business_type = $params['card'] ?: 'new';
        $tpl = 'brand_companyType';
        $this->passport_obj->entryType = 'brand';
        if ($_POST) {
            $params = utils::_filter_input($_POST);
            unset($_POST);
            $result = $this->passport_obj->entry($params, $msg);
            if (!$result) $this->splash('error', '', $msg . '信息注册失败');
            //$step ++;
        }
        if (is_numeric($identity)) {
            $tpl = 'brand_companyInfo';
            $columns = $this->app->getConf('seller_entry');
            $countPage = count($columns[$identity]['pageSet']);
            $step = $params['pageIndex'] ?: $step;
            $step = $type == 'up' ? $step - 1 : $step + 1;
            $step <= 1 && $step = 1;
            $step > $countPage && $step = $countPage + 1;
            $selfPage['page'] = array_flip($columns[$identity]['pageSet'][$step]['page']);
            $this->passport_obj->unsetColumns($business_type, $selfPage);
            $selfPage['page'] = array_flip($selfPage['page']);
            $this->pagedata['pageSet'] = $selfPage;
            $this->pagedata['identity'] = $identity;
            if ($params['type'] != 'add')
                $this->pagedata['info'] = $this->passport_obj->edit_info($selfPage, $this->seller['seller_id'], $identity);
            $this->pagedata['pageIndex'] = $step;
            $this->pagedata['info']['company_extra']['page_setting'] = $this->passport_obj->columns();
            if ($step > $countPage) {
                $sumPage = $this->passport_obj->countPage();
                $store_id = app::get('store')->model('store')->getRow('store_id', array('seller_id' => $this->seller['seller_id']));
                $redirect = array('app' => 'seller', 'ctl' => 'site_passport', 'act' => 'entry', 'args0' => ($sumPage['sum'] - 1));
                if (is_numeric($store_id) && $store_id > 0) {
                    //商家中心添加品牌
                    $redirect = array('app' => 'seller', 'ctl' => 'site_brand', 'act' => 'add');
                }
                $url = $this->gen_url($redirect);
                $this->splash('success', $url, '资质添加成功');
            }
        }
        $this->pagedata['ident'] = $this->seller['ident'];
        $this->pagedata['type'] = $params['type'];
        $this->page('site/passport/' . $tpl . '.html');
    }

    //end function
    //注册页面
    public function signup($step, $type)
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
                $this->verify();
                $tpl = 'signup_companyType';
                $this->pagedata['type'] = $type;
                $this->pagedata['seller'] = $this->seller;
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
    public function complete()
    {
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
        /**
         * 润和接口
         * 卖家注册 ISL231180
         *
         */
        extract($post);
       /* if (!vmc::singleton('seller_user_vcode')->verify($smscode, $pam_account['mobile'], 'signup')) {
            $this->splash('error', $signup_url, '手机短信验证码不正确');
        }*/
     
        if ( !vmc::singleton('b2c_user_smscode')->bool_sms($post['pam_account']['mobile'],$post['smscode'],'signup')) {
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
            $this->user_obj->set_session($seller_id);
            $this->bind_seller($seller_id);
            return true;
        } else {
            return false;
        }
    }

    //检查验证码
    public function vcode_verify()
    {
        if (!$_POST) $this->splash('error', '', '请填写验证码');
        extract($_POST);
        if (!vmc::singleton('seller_user_vcode')->verify($smscode, $pam_account['mobile'], 'signup')) {
            $this->splash('error', '', '手机短信验证码不正确');
        }
        
        
        
        $this->splash('success', '', '验证成功');
    }

    //检查用户名
    public function check_login_name()
    {
        if (isset($_POST['pam_account']['login_name'])) {
            $name = trim($_POST['pam_account']['login_name']);
        } else {
            $name = trim($_POST['pam_account']['mobile']);
        }

        if ($this->passport_obj->check_signup_account($name, $msg)) {
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

    /*
     * 判断前台用户联系手机是否存在
     */

    public function is_exists_mobile()
    {
        $mobile = $_POST['pam_account']['mobile'];
        if (empty($mobile)) {
            $this->splash('error', '', '手机号不能为空');
        }
        $mobile_type = $this->passport_obj->get_login_account_type($mobile);

        if ($mobile_type != 'mobile') {
            $this->splash('error', '', '请填写正确的手机号');
        }
        $mdl_sellers = $this->app->model('sellers');
        $flag = $mdl_sellers->getList('seller_id', array(
            'mobile' => trim($mobile),
        ));
        if ($flag) {
            $this->splash('error', '', '该手机号已被使用');
        }
        $this->splash('success', '', '该手机号可以使用');
    }


    //发送短信验证码
    public function send_vcode_sms($type = 'signup')
    {
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

     	$msg = $this->passport_obj->get_login_account_type($mobile);
        if ($msg != 'mobile') {
            $this->splash('error', null, '错误的手机格式');
        }
        
    	$smscode_obj = vmc::singleton('b2c_user_smscode');
		$smscode = $smscode_obj->send_smscode($mobile,'signup',$msg);
		if($smscode){
			$this->splash('success', $smscode, '短信已发送');
		}else{
			$this->splash('error', null, $msg);
		}
    }


    //重置密码
    public function reset_password()
    {
        /**
         * 润和接口 卖家修改密码
         * ISL231183 卖家账号密码修改
         */
        if (!empty($_POST)) {
            $redirect = $this->gen_url(array(
                'app' => 'seller',
                'ctl' => 'site_passport',
                'act' => 'login',
            ));
            extract($_POST);
            $seller = $this->app->model('sellers')->getRow('seller_id', array('mobile' => $pam_account['mobile']));

            if (empty($seller)) {
                $this->splash('error', $redirect, '不存在的用户');
            }
            
             /* if (!vmc::singleton('seller_user_vcode')->verify($smscode, $pam_account['mobile'], 'signup')) {
                $this->splash('error', $redirect, '手机短信验证码不正确');
            }  */
          
            if (!vmc::singleton('b2c_user_smscode')->bool_sms($pam_account['mobile'],$smscode,'signup')) {
            	$this->splash('error', $redirect, '手机短信验证码不正确');
            }
            
            
            if ($pam_account['login_password'] != $pam_account['psw_confirm']) {
                $this->splash('error', $redirect, '确认密码输入不正确');
            }
            if (!$this->passport_obj->reset_password($seller['seller_id'], $pam_account['psw_confirm'])) {
                $this->splash('error', $redirect, '重置失败');
            }
            $this->unset_seller();
            $this->splash('success', $redirect, '重置成功,请重新登录');
        }
        $this->pagedata['reset'] = 'reset';
        $this->page('site/seller/reset_password.html');
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
        /**
         * 润和接口 商家入驻
         * ISL231180 编辑卖家信息All
         * ISL231181 查询卖家信息All
         *
         * 电商团队 检测设备 企业荣誉 车间概况 可以添加多条数据接口待定
         *
         * 添加多个品牌资质
         * ISL231146 增加企业产品品牌 添加别人的
         * ISL231149 查询企业产品品牌
         * ISL231150 增加卖家产品品牌 添加自己的
         * ISL231153 查询卖家产品品牌
         *
         * 填写申请店铺
         * ISL231109 查询卖家产品和标准
         * ISL231106 编辑卖家产品和标准
         *
         * 店铺信息本地保存不提交到接口
         */
        $this->verify();
        $redirect = $this->gen_url(array(
            'app' => 'seller',
            'ctl' => 'site_passport',
            'act' => 'entry',
            'args0' => $step,
        ));
        if ($_POST) {
            $params = utils::_filter_input($_POST);
            unset($_POST);
            $result = $this->passport_obj->entry($params, $msg, $params['pageIndex']);

            if (!$result) $this->splash('error', $redirect, '操作失败');
        }
        $licence_type = $this->_request->get_get('card');
        if (!$licence_type) {
            $licence_type = $this->passport_obj->new_or_old($this->seller['seller_id']);
        }
        //页面总步骤
        $countPage = $this->passport_obj->countPage();
        $step = $params['pageIndex'] ?: $step;
        $step = $type == 'up' ? $step - 1 : $step + 1;
        $step <= 1 && $step = 1;
        $step > $countPage['sum'] && $step = $countPage['sum'] + 1;
        if ($params['typeId']) $storeType = $params['typeId'];
        if (!$storeType && $this->seller['ident'] & 1) $storeType = 1;
        if (!$storeType && $this->seller['ident'] & 2) $storeType = 2;
        if (!$storeType && $this->seller['ident'] & 4) $storeType = 4;
        $columns = $this->passport_obj->page_setting($step, $licence_type, $storeType);
        $this->pagedata['leftMenu'] = $this->app->getConf('seller_group');
        $index = $step;
        $this->passport_obj->_entry($step, $storeType, $index);
        $this->pagedata['info'] = $this->passport_obj->edit_info($columns, $this->seller['seller_id'], $storeType, 1, $step);
        $this->pagedata['info']['company_extra']['page_setting'] = $this->passport_obj->columns();
        $this->pagedata['info']['company_extra']['pageIndex'] = $step;
        $this->pagedata['info']['company_extra']['identity'] = $this->seller['ident'];
        $this->pagedata['menu'] = array('storeType' => $storeType, 'activeMenu' => $index);
        $this->pagedata['pageSet'] = $columns;
        $this->pagedata['pageIndex'] = $step;
        if ($step > $countPage['sum']) {
            $redirect = $this->gen_url(array('app' => 'seller', 'ctl' => 'site_passport', 'act' => 'entry'));
            $result = $this->passport_obj->apiEntry();
            !$result && $this->splash('error', $redirect, '注册失败');
            $this->page('site/passport/signup_complete.html');
        } else {
            //信息全部已提交全部
            $this->page('site/passport/signup_companyInfo.html');
        }
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

    //ajax删除电商团队、主要设备
    public function del_extra()
    {
        if (!$_POST) {
            $this->splash('error', '', '非法请求');
        }
        $data = array('content_id' => $_POST['content_id'], 'uid' => $this->seller['seller_id']);
        if (!app::get('base')->model('company_extra')->delete($data)) {
            $this->splash('error', '', '操作失败');
        }
        $this->splash('success', '', '操作成功');
    }

    //商家入驻类型选择
    public function identity()
    {
        (!is_numeric($_POST['ident']) && empty($_POST)) && $this->splash('error', '', '非法请求');
        $redirect = array('app' => 'seller', 'ctl' => 'site_passport', 'act' => 'entry');
        if ($_POST['type'] == '1') {
            $redirect = array('app' => 'buyer', 'ctl' => 'site_passport', 'act' => 'signup');
        }
        $redirect = $this->gen_url($redirect);
        $_POST['seller_id'] = $this->seller['seller_id'];
        $result = $this->passport_obj->identity_update($_POST);
        if ($result && $_POST['type'] == '1') {
            //返回成功 并且 选择成功买手身份
            $this->user_obj->set_session(null);
            $result['buyer_code'] = '';
            vmc::singleton('buyer_user_object')->set_session($result);
            //设置cookie
        }
        $this->splash($result ? 'success' : 'error', $redirect, $result ? '操作成功' : '操作失败');
    }


    //ajax判断所填写的营业执照号是否已经填写过并返回信息
    public function check_company()
    {
        if (!is_numeric($_POST['business'])) $this->splash('error', '', '请输入正确的格式');
        $mdl_company = app::get('base')->model('company');
        $mdl_company_extra = app::get('base')->model('company_extra');
        $company = $mdl_company->getRow('*', array('business' => $_POST['business'], 'business_type' => $_POST['business_type']));
        if (!empty($company)) {
            $company['extra'] = $mdl_company_extra->getList('*', array('extra_id' => $company['company_id'], 'identity' => ''));
        }
    }

    //添加品牌资质
    public function add_brand()
    {

        if ($_POST) {
            $params = utils::_filter_input($_POST);
            unset($_POST);
            $this->_post_brand($params);
        }
        //查询商家所有的公司
        $this->pagedata['company'] = app::get('base')->model('company_seller')->getList('company_id, company_name',
            array('uid' => $this->seller['seller_id'], 'from' => 1));
        $this->pagedata['type'] = 'entry';
        $this->display('ui/brand_add_modal.html');
    }

    private function _post_brand($post)
    {
        $count = vmc::singleton('seller_user_passport')->countPage();
        $redirect = Array('app' => 'seller', 'ctl' => 'site_passport', 'act' => 'entry', 'args0' => ($count['sum'] - 1));
        $redirect = $this->gen_url($redirect);
        $post['brand']['seller_id'] = $this->seller['seller_id'];

        if (!app::get('b2c')->model('brand')->save($post['brand'])) {
            $this->splash('error', $redirect, '操作失败');
        }
        $this->splash('success', $redirect, array('name' => $post['brand']['brand_name'], 'id' => $post['brand']['brand_id']));
    }

    /*
     * 商家入驻添加经营类别
     * 
     */

    public function display_type($html_type)
    {
        empty($html_type) && $html_type = 'apt_common';
        $html_arr = array(
            'apt_common', 'apt_prove', //apt_pack包装规格
            'apt_quality', 'apt_raise',
            'apt_safety', 'apt_stock',
            'apt_technology', 'apt_transport');
        if (in_array($html_type, $html_arr)) {
            $this->pagedata['card'] = app::get('b2c')->model('goods')->fileCard($html_type, $this->_request->get_get('cat'));

            $this->display('ui/aptitude/' . $html_type . '.html');
        }
    }


    public function add_cat()
    {
        //获取分类
        $this->display('ui/add-category.html');
    }

    //选择商品类目填写相关资质
    public function write_aptitude($cat_id = 0)
    {
        if (!is_numeric($cat_id)) $cat_id = 0;
        $this->pagedata['aptitude'] = app::get('b2c')->model('cat_aptitudes')->getRow('*', array('cat_id' => $cat_id));
        $this->pagedata['cat'] = app::get('store')->model('goods_cat')->getRow('*', array('cat_id' => $cat_id, 'seller_id' => $this->seller['seller_id']));
        $this->pagedata['type'] = 'entry';
        $this->display('site/goods/write_aptitude.html');
    }

    /**
     * 保存分类所需资质
     */
    public function saveAptitude()
    {
        if (!$_POST) {
            $this->splash('error', '', '非法请求');
        }
        $updateValue = array('extra' => $_POST['cat']);
        $filter = array('id' => $_POST['id']);
        if (!app::get('store')->model('goods_cat')->update($updateValue, $filter)) {
            $this->splash('error', '', '添加失败');
        }
        $this->splash('success', '', '添加成功');
    }

}