<?php

/**
 * 登录注册流程/逻辑处理类.
 */
class seller_user_passport
{
    public function __construct(&$app)
    {
        $this->company = Array();
        $this->app = $app;
        $this->entryType = 'entry'; //entry 商家入驻 brand 品牌添加资质  centre 商家中心
        $this->user_obj = vmc::singleton('seller_user_object');
        $this->seller = vmc::singleton('seller_user_object')->get_current_seller();
        vmc::singleton('base_session')->start();
    }

    /*
     * 获取前台登录用户类型(用户名,邮箱，手机号码)
     *
     * @params $login_account 登录账号
     * @return $account_type
     * */
    public function get_login_account_type($login_account)
    {
        $login_type = 'local';
        if ($login_account && strpos($login_account, '@')) {
            $login_type = 'email';
            return $login_type;
        }
        if (preg_match('/^1[34578]{1}[0-9]{9}$/', $login_account)) {
            $login_type = 'mobile';

            return $login_type;
        }

        return $login_type;
    } //end function

    /*
     * 检查注册账号合法性
     * */
    public function check_signup_account($login_name, &$msg)
    {
        if (empty($login_name)) {
            $msg = ('请输入用户名');
            return false;
        }

        //获取到注册时账号类型
        $login_type = $this->get_login_account_type($login_name);
        //$login_type = 'mobile'; // 只允许手机登录、注册
        switch ($login_type) {
            case 'local':
                if (strlen(trim($login_name)) < 6) {
                    $msg = $this->app->_('登录账号最少6个字符');
                    return false;
                } elseif (strlen($login_name) > 19) {
                    $msg = $this->app->_('登录账号过长，请换一个重试');
                }
                if (is_numeric($login_name)) {
                    $msg = $this->app->_('请输入正确的手机号');
                    return false;
                }
                if (!preg_match('/^[^\x00-\x2d^\x2f^\x3a-\x3f]+$/i', trim($login_name))) {
                    $msg = $this->app->_('该登录账号包含非法字符');

                    return false;
                }
                $exists_msg = $this->app->_('用户名' . $login_name . '已经被占用，请换一个重试');
                break;
            case 'email':
                if (!preg_match('/^(?:[a-z\d]+[_\-\+\.]?)*[a-z\d]+@(?:([a-z\d]+\-?)*[a-z\d]+\.)+([a-z]{2,})+$/i', trim($login_name))) {
                    $msg = $this->app->_('邮件格式不正确');

                    return false;
                }
                $exists_msg = $this->app->_('该邮箱已被注册，请更换一个');
                break;
            case 'mobile':
                $exists_msg = $this->app->_('该手机号已被注册，请更换一个');
                break;
        }
        //判断账号是否存在
        if ($this->is_exists_login_name($login_name)) {
            $msg = $exists_msg;

            return false;
        }
        $msg = $login_type;

        return true;
    } //end function

    /*
     * 判断前台用户名是否存在
     * */
    public function is_exists_login_name($login_account)
    {
        if (empty($login_account)) {
            return false;
        }
        $pam_sellers_model = app::get('pam')->model('sellers');
        $flag = $pam_sellers_model->getList('seller_id', array(
            'login_account' => trim($login_account),
        ));

        return $flag ? true : false;
    }

    /**
     *组织注册需要的数据.
     */
    public function pre_signup_process($data)
    {

        if ($data['pam_account']) {
            $accountData = $this->pre_account_signup_process($data['pam_account']);
        }

        //$data['currency'] = $arrDefCurrency['cur_code'];
        $seller['reg_ip'] = base_request::get_remote_addr();
        $seller['regtime'] = time();
        $seller['mobile'] = $data['pam_account']['mobile'];
        $seller['contact']['area'] = $data['pam_account']['area'];
        //--防止恶意修改
        foreach ($data as $key => $val) {
            if (strpos($key, 'box:') !== false) {
                $aTmp = explode('box:', $key);
                $data[$aTmp[1]] = serialize($val);
            }
        }
        $arr_colunm = array(
            'regtime',
            'reg_ip',
            'currency',
            'contact',
            'profile',
            // 'seller_lv',
        );

        if ($accountData['login_type'] == 'mobile') {
            $data['contact']['phone']['mobile'] = $accountData['login_account'];
        }
        if ($accountData['login_type'] == 'email') {
            $data['contact']['email'] = $accountData['login_account'];
        }
        $accountData['password'] = $data['pam_account']['psw_confirm'];
        //---end
        $return = array(
            'pam_account' => $accountData,
            'seller_sellers' => $seller,
        );
        $return = vmc::singleton('seller_site_filter')->check_input($return);
        return $return;

    }

    /**
     * 检查会员注册数据合法性.
     */
    public function check_signup($data, &$msg)
    {
        //检查注册账号合法性
        if (!$this->check_signup_account(trim($data['pam_account']['login_name']), $msg)) {
            return false;
        }
        $password = $data['pam_account']['login_password'];
        $password_cfm = $data['pam_account']['psw_confirm'];
        //检查密码合法性
        if (strlen($password) < 6) {
            $msg = $this->app->_('密码长度不能小于6位');

            return false;
        }
        if (strlen($password) > 20) {
            $msg = $this->app->_('密码长度不能大于20位');

            return false;
        }
        if ($password != $password_cfm) {
            $msg = $this->app->_('两次输入的密码不一致');

            return false;
        }

        return true;
    }//end function


    /**
     * 注册pam_sellers 表数据结构.
     */
    public function pre_account_signup_process($accountData, $password_account = null)
    {
        $login_account = strtolower($accountData['login_name']);
        $password_account = $password_account ? $password_account : $login_account;
        $use_pass_data['login_name'] = $password_account;
        $use_pass_data['createtime'] = time();

        $login_password = pam_encrypt::get_encrypted_password(trim($accountData['login_password']), 'seller', $use_pass_data);
        $login_type = $this->get_login_account_type($login_account);
        $account = array(
            'login_type' => $login_type,
            'login_account' => $login_account,
            'login_password' => $login_password,
            'password_account' => $password_account, //登录密码加密账号
            'disabled' => $login_type == 'email' ? 'true' : 'false', //邮箱需要到会员中心进行验证
            'createtime' => $use_pass_data['createtime'],
        );

        return $account;
    }

    /*
     * 修改密码
     *
     * @params $seller_id int
     * @params $data array
     * */
    public function save_security($seller_id, $data, &$msg)
    {
        $pamsellersModel = app::get('pam')->model('sellers');
        $pamData = $pamsellersModel->getList('login_password,password_account,createtime', array(
            'seller_id' => $seller_id,
        ));
        $use_pass_data['login_name'] = $pamData[0]['password_account'];
        $use_pass_data['createtime'] = $pamData[0]['createtime'];
        $login_password = pam_encrypt::get_encrypted_password(trim($data['old_passwd']), 'seller', $use_pass_data);
        if ($login_password !== $pamData[0]['login_password']) {
            $msg = ('输入的旧密码与原密码不符！');

            return false;
        }
        if ($this->reset_passport($seller_id, trim($data['passwd']))) {
            $msg = ('密码修改成功');
        } else {
            $msg = ('密码修改失败！');

            return false;
        }
        $arr_colunms = $this->user_obj->get_pam_data('*', $seller_id);
        $aData['email'] = $arr_colunms['email'] ? $arr_colunms['email']['login_account'] : '';
        $aData['uname'] = $arr_colunms['local'] ? $arr_colunms['local']['login_account'] : $arr_colunms['mobile'] ? $arr_colunms['mobile']['login_account'] : '';
        $aData['uname'] = $aData['uname'] ? $aData['uname'] : $arr_colunms['email'] ? $arr_colunms['email']['login_account'] : '';
        $aData['passwd'] = $data['passwd'];
        //发送邮件或者短信
        //$obj_account = $this->app->model('seller_account');
        //TODO $obj_account->fireEvent('chgpass', $aData, $seller_id);
        return true;
    }

    /*
     * 根据会员ID 修改用户密码
     **/
    public function reset_password($seller_id, $password)
    {
        return $this->reset_passport($seller_id, $password);
    }

    public function reset_passport($seller_id, $password)
    {
        $pamsellersModel = app::get('pam')->model('sellers');
        $pamData = $pamsellersModel->getList('login_account,password_account,createtime', array(
            'seller_id' => $seller_id,
        ));
        $db = vmc::database();
        $db->beginTransaction();
        foreach ($pamData as $row) {
            $use_pass_data['login_name'] = $row['password_account'];
            $use_pass_data['createtime'] = $row['createtime'];
            $login_password = pam_encrypt::get_encrypted_password(trim($password), 'seller', $use_pass_data);
            if (!$pamsellersModel->update(array(
                'login_password' => $login_password,
            ), array(
                'login_account' => $row['login_account'],
            ))
            ) {
                $db->rollBack();

                return false;
            }
        }
        $db->commit();

        return true;
    }

    //设置当前用户名
    public function set_local_uname($local_uname, &$msg)
    {
        $local_uname = strtolower($local_uname);
        $seller_id = $this->user_obj->get_id();
        if (!$seller_id) {
            $msg = ('页面已过期，请重新登录，到会员中心设置');

            return false;
        }
        $sellersData = $this->user_obj->get_pam_data('*', $seller_id);
        if ($sellersData['local']) {
            $msg = ('用户名已设置，不可更改');

            return false;
        }
        if (!$this->check_signup_account($local_uname, $msg)) {
            return false;
        }
        if ($msg != 'local') {
            $type = ($msg == 'mobile') ? ('手机号') : ('邮箱');
            $msg = ('用户名不能为') . $type;

            return false;
        }
        $pamsellersModel = app::get('pam')->model('sellers');
        $row = $pamsellersModel->getList('login_account,login_password,password_account,createtime', array(
            'seller_id' => $seller_id,
        ));
        $row = $row[0];
        $data['seller_id'] = $seller_id;
        $data['login_account'] = strtolower($local_uname);
        $data['login_type'] = 'local';
        $data['login_password'] = $row['login_password'];
        $data['password_account'] = $row['password_account'];
        $data['createtime'] = $row['createtime'];
        if ($pamsellersModel->insert($data)) {
            $msg = ('用户名设置成功');

            return true;
        } else {
            $msg = ('用户名设置失败');

            return false;
        }
    }

    //设置绑定手机号
    public function set_mobile($mobile, &$msg)
    {
        $seller_id = $this->user_obj->get_id();
        if (!$seller_id) {
            $msg = ('页面已过期，请重新登录，到会员中心设置');

            return false;
        }
        $sellersData = $this->user_obj->get_pam_data('*', $seller_id);
        if ($sellersData['mobile']) {
            $msg = ('手机号已设置，不可更改');

            return false;
        }
        if (!$this->check_signup_account($mobile, $msg)) {
            return false;
        }
        if ($msg != 'mobile') {
            $msg = '错误的手机号!';

            return false;
        }
        $pamsellersModel = app::get('pam')->model('sellers');
        $row = $pamsellersModel->getList('login_account,login_password,password_account,createtime', array(
            'seller_id' => $seller_id,
        ));
        $row = $row[0];
        $data['seller_id'] = $seller_id;
        $data['login_account'] = $mobile;
        $data['login_type'] = 'mobile';
        $data['login_password'] = $row['login_password'];
        $data['password_account'] = $row['password_account'];
        $data['createtime'] = $row['createtime'];
        if ($pamsellersModel->insert($data)) {
            $msg = ('手机号设置成功');

            return true;
        } else {
            $msg = ('手机号设置失败');

            return false;
        }
    }

    //设置绑定邮箱
    public function set_email($email, &$msg)
    {
        $seller_id = $this->user_obj->get_id();
        if (!$seller_id) {
            $msg = ('页面已过期，请重新登录，到会员中心设置');

            return false;
        }
        $sellersData = $this->user_obj->get_pam_data('*', $seller_id);
        if ($sellersData['email']) {
            $msg = ('邮箱已设置，不可更改');

            return false;
        }
        if (!$this->check_signup_account($email, $msg)) {
            return false;
        }
        if ($msg != 'email') {
            $msg = '错误的邮箱地址!';

            return false;
        }
        $pamsellersModel = app::get('pam')->model('sellers');
        $row = $pamsellersModel->getList('login_account,login_password,password_account,createtime', array(
            'seller_id' => $seller_id,
        ));
        $row = $row[0];
        $data['seller_id'] = $seller_id;
        $data['login_account'] = $email;
        $data['login_type'] = 'email';
        $data['login_password'] = $row['login_password'];
        $data['password_account'] = $row['password_account'];
        $data['createtime'] = $row['createtime'];
        if ($pamsellersModel->insert($data)) {
            $msg = ('邮箱设置成功');

            return true;
        } else {
            $msg = ('邮箱设置失败');

            return false;
        }
    }

    //获取会员注册项加载
    public function get_signup_attr($seller_id = null)
    {
        if ($seller_id) {
            $seller_model = $this->app->model('sellers');
            $mem = $seller_model->dump($seller_id);
        }
        $seller_model = $this->app->model('sellers');
        $mem_schema = $seller_model->_columns();
        $attr = array();
        foreach ($this->app->model('seller_attr')->getList() as $item) {
            if ($item['attr_show'] == 'true') {
                $attr[] = $item;
            } //筛选显示项
        }
        foreach ((array)$attr as $key => $item) {
            $sdfpath = $mem_schema[$item['attr_column']]['sdfpath'];
            if ($sdfpath) {
                $a_temp = explode('/', $sdfpath);
                if (count($a_temp) > 1) {
                    $name = array_shift($a_temp);
                    if (count($a_temp)) {
                        foreach ($a_temp as $value) {
                            $name .= '[' . $value . ']';
                        }
                    }
                }
            } else {
                $name = $item['attr_column'];
            }
            if ($mem && $item['attr_group'] == 'defalut') {
                switch ($attr[$key]['attr_column']) {
                    case 'area':
                        $attr[$key]['attr_value'] = $mem['contact']['area'];
                        break;
                    case 'birthday':
                        $attr[$key]['attr_value'] = $mem['profile']['birthday'];
                        break;
                    case 'name':
                        $attr[$key]['attr_value'] = $mem['contact']['name'];
                        break;
                    case 'mobile':
                        $attr[$key]['attr_value'] = $mem['contact']['phone']['mobile'];
                        break;
                    case 'tel':
                        $attr[$key]['attr_value'] = $mem['contact']['phone']['telephone'];
                        break;
                    case 'zip':
                        $attr[$key]['attr_value'] = $mem['contact']['zipcode'];
                        break;
                    case 'addr':
                        $attr[$key]['attr_value'] = $mem['contact']['addr'];
                        break;
                    case 'sex':
                        $attr[$key]['attr_value'] = $mem['profile']['gender'];
                        break;
                    case 'pw_answer':
                        $attr[$key]['attr_value'] = $mem['account']['pw_answer'];
                        break;
                    case 'pw_question':
                        $attr[$key]['attr_value'] = $mem['account']['pw_question'];
                        break;
                }
            }
            if ($item['attr_group'] == 'contact' || $item['attr_group'] == 'input' || $item['attr_group'] == 'select') {
                $attr[$key]['attr_value'] = $mem['contact'][$attr[$key]['attr_column']];
                if ($item['attr_sdfpath'] == '') {
                    $attr[$key]['attr_value'] = $mem[$attr[$key]['attr_column']];
                    if ($attr[$key]['attr_type'] == 'checkbox') {
                        $attr[$key]['attr_value'] = unserialize($mem[$attr[$key]['attr_column']]);
                    }
                }
            }
            if ($attr[$key]['attr_type'] == 'select' || $attr[$key]['attr_type'] == 'checkbox') {
                $attr[$key]['attr_option'] = unserialize($attr[$key]['attr_option']);
            }
            $attr[$key]['attr_column'] = $name;
            if ($attr[$key]['attr_column'] == 'birthday') {
                $attr[$key]['attr_column'] = 'profile[birthday]';
            }
        }

        return $attr;
    } //end function

    /*
     * 保存会员信息sellers表和注册扩展项数据
     *
     **/
    public function save_sellers($saveData, &$msg)
    {
        $saveData = vmc::singleton('seller_site_filter')->check_input($saveData);
        $seller_model = $this->app->model('sellers');
        $db = vmc::database();
        $db->beginTransaction();
        if ($seller_model->save($saveData['seller_sellers'])) {
            $seller_id = $saveData['seller_sellers']['seller_id'];
            $saveData['pam_account']['seller_id'] = $seller_id;
            if (!app::get('pam')->model('sellers')->save($saveData['pam_account'])) {
                $db->rollBack();
                $msg = '账户数据保存异常!';
                return false;
            }
            $db->commit();
        } else {
            $msg = '保存失败!';
            return false;
        }
        return $seller_id;
    }


    public function unset_seller()
    {
        $auth = pam_auth::instance(pam_account::get_account_type('seller'));
        foreach (vmc::servicelist('passport') as $k => $passport) {
            $passport->loginout($auth);
        }
        $this->app->seller_id = 0;
        vmc::singleton('base_session')->set_cookie_expires(0);
        $this->cookie_path = vmc::base_url() . '/';
        $this->set_cookie('UNAME', '', time() - 3600); //用户名
        $this->set_cookie('SELLER_IDENT', 0, time() - 3600);//会员ID
        foreach (vmc::servicelist('seller.logout_after') as $service) {
            $service->logout();
        }
    }

    //商家入驻页面配置
    public function page_setting($step, $licence_type, $storeType)
    {
        //最后2步为品牌店铺页面 只需要填写1次
        $seller_info = vmc::singleton('seller_user_object')->get_current_seller();
        $conf = $this->app->getConf('seller_entry');
        $countPage = $this->countPage();
        $columns = Array();
        $index = $step;
        if ($step > count($conf[$storeType]['pageSet'])) {
            $this->_entry($step, $storeType, $index);
        }
        if ($step <= $countPage['sum'] - count($conf['comm']['pageSet'])) {
            if (!$seller_info['ident'] & $storeType) return array();
            if ($storeType && $conf[$storeType]['pageSet'][$index]) {
                //$columns['page'] = array_flip($conf[$storeType]['pageSet'][$index]['page']);
                $columns['page'] = $conf[$storeType]['pageSet'][$index]['page'];
                $columns['label'] = $conf[$storeType]['pageSet'][$index]['label'];
                $columns['companyType'] = $conf[$storeType]['companyType'];
                $columns['typeId'] = $storeType;
            }
            $this->unsetColumns($licence_type, $columns);
            if ($step != '1') unset($columns['page']['bank_lesstion']);
            //$columns['page'] = array_flip($columns['page']);
        } else {
            //最后两步品牌添加店铺申请
            //$index = $step - ($countPage['sum'] - count($conf['comm']['pageSet']));
            $columns['page'] = $conf['comm']['pageSet'][$index]['page'];
            $columns['label'] = $conf['comm']['pageSet'][$index]['label'];
            $columns['companyType'] = $countPage['label'];
            $columns['typeId'] = 'comm';//$storeType;
        }
        $columns['identityLabel'] = $countPage['label'];
        return $columns;
    }

    //判断营业执照是否为新版并移除不相关字段
    public function unsetColumns($licence_type, &$columns)
    {
        $columns['page'] = array_flip($columns['page']);
        if ($licence_type == 'new') {
            unset($columns['page']['business_licence']);
            unset($columns['page']['tax_licence']);
            unset($columns['page']['organization_licence']);
        } else if ($licence_type == 'old') {
            unset($columns['page']['three_lesstion']);
        }
        $columns['page'] = array_flip($columns['page']);
    }

    //判断组合身份当前填写到哪一种身份
    public function _entry($step, &$storeType, &$index)
    {
        $seller_info = vmc::singleton('seller_user_object')->get_current_seller();
        $conf = $this->app->getConf('seller_entry');
        $storeGroup = Array();
        if ($seller_info['ident'] & 1) {
            $storeGroup[] = 1;
        }
        if ($seller_info['ident'] & 2) {
            $storeGroup[] = 2;
        }
        if ($seller_info['ident'] & 4) {
            $storeGroup[] = 4;
        }
        $countPage = 0;
        foreach ($storeGroup as $key => $value) {
            $countPage += count($conf[$storeGroup[$key - 1]]['pageSet']);
            if ($storeType != $value && $step > $countPage) {
                $storeType = $value;
                $index = $step - $countPage;
            }
        }
        $sumPage = $this->countPage();
        if ($step > $sumPage['sum'] - count($conf['comm']['pageSet'])) {
            $storeType = 'comm';
            $index = $step - ($sumPage['sum'] - count($conf['comm']['pageSet']));
        }
    }

    //获取当前身份所需填写资料页面总数
    public function countPage()
    {
        $conf = $this->app->getConf('seller_entry');
        $seller_info = vmc::singleton('seller_user_object')->get_current_seller();
        $sum = Array();
        if ($seller_info['ident'] & 1) {
            $sum['sum'] += count($conf[1]['pageSet']);
            $sum['label'] .= $conf[1]['companyType'] . '+';
        }
        if ($seller_info['ident'] & 2) {
            $sum['sum'] += count($conf[2]['pageSet']);
            $sum['label'] .= $conf[2]['companyType'] . '+';
        }
        if ($seller_info['ident'] & 4) {
            $sum['sum'] += count($conf[4]['pageSet']);
            $sum['label'] .= $conf[4]['companyType'];
        }
        $sum['label'] = trim($sum['label'], '+');
        $sum['sum'] += count($conf['comm']['pageSet']);
        return $sum;
    }

    //获取基本信息页面配置
    public function columns()
    {
        $result['company'] = app::get('seller')->getConf('company_type');
        $result['store'] = app::get('seller')->getConf('store_type');
        //$sql = "SELECT * FROM vmc_base_company WHERE company_type = '0' AND ep_id > 0";
        //$result['agent_company'] = app::get('base')->model('company')->getList('*', array('company_type' => '0', 'ep_id|than' => 0));
        $agent = app::get('seller')->rpc('select_company_qualifications')->request('', 259000);
        $result['agent_company'] = $agent['result']['epInfoList'];
        return $result;
    }

    //查询已注册的信息
    /**
     * @params $colums 所需字段
     * @params $seller_id 商家id
     * @params $storeType 店铺类型
     * @params $company_index 查询该商家第几个公司下标 多重身份
     * @parmas $step 所需查询页面信息下标
     */
    public function &edit_info($columns, $seller_id, $storeType, $company_index = 1, $step = 0)
    {

        $info = array();
        $company_type = $step == 1 ? 1 : 0;
        $company = app::get('base')->model('company_seller')->getList('company_id', array(
            'uid' => $seller_id, 'from' => '1', 'identity' => $this->seller['ident']), ($company_index - 1), '1', 'cs_id DESC');
        if (!$company[0]['company_id']) Return array();

        //$extra_id = app::get('seller')->model('sellers')->getRow('company_extra', array('seller_id' => $seller_id));
//        foreach($companys as $value){
//            $company['company_id'][] = $value['company_id'];
//        }
        $filter = array('extra_id' => $company[0]['company_id'], 'identity' => $storeType);
        if ($storeType == 'comm') {
            $filter = array('uid' => $seller_id, 'from' => 1);
        }
//        if($this->entryType == 'brand'){
//            $filter['extra_id'] = $company['company_id'][count($company['company_id']) - 1];
//        }
        $mdl_base_extra = app::get('base')->model('company_extra');
        $conf = $this->app->getConf('seller_entry');
        $mdl_company = app::get('base')->model('company');
        $company_extra = $mdl_base_extra->getList('*', array_merge($filter, array('key|in' => array_values($columns['page']))));
        foreach ($conf['array_info'] as $value) {
            if (in_array($value, $columns['page'])) {
                $company_extra[$value] = $mdl_base_extra->arrayInfo('*', array_merge($filter, array('key' => $value)));
            }
        }

        $info['company_extra'] = $company_extra;
        $info['company_extra']['company'] = $mdl_company->getRow('*', array('company_id' => $company[0]['company_id'], 'info_type' => $storeType));
        unset($company_extra);
        if ($storeType == 'comm') {
            $this->_getStoreConf($info, $seller_id);
        }
        $info['company_extra']['contact'] = app::get('base')->model('contact')->getRow('*', array('uid' => $seller_id, 'from' => '1'));
        return $info;
    }

    /**
     * 获取店铺页面所需配置与信息
     **/
    private function _getStoreConf(&$info, $seller_id)
    {
        $info['company_extra']['store'] = app::get('store')->model('store')->getRow('*', array('seller_id' => $seller_id));
        $info['company_extra']['brand'] = app::get('b2c')->model('brand')->getList('*', array('seller_id' => $seller_id));
        $store_type = $this->countPage();
        $info['company_extra']['store']['store_type'] = $store_type['label'];
        //获取商品类目信息
        //调用接口获取分类下的档案卡信息
        $info['company_extra']['store']['cat'] = app::get('b2c')->model('goods_cat')->get_tree('', null);
        $selectedCat = app::get('store')->model('goods_cat')->get_tree($this->seller['seller_id'], '', null);
        $info['company_extra']['store']['selectedCat'] = $this->changeKey($selectedCat);
    }

    private function &changeKey(&$cat)
    {
        $tmp = Array();
        if (is_array($cat)) {
            foreach ($cat as $v) {
                $tmp[$v['cat_id']] = $v;
                if (is_array($v['children'])) {
                    $this->changeKey($v['children']);
                }
            }
        }
        return $tmp;
    }


    //保存注册信息
    public function entry($params, &$msg, $step)
    {
        $company_type = $step == 1 ? 1 : 0;
        $db = vmc::database();
        $db->beginTransaction();
        $extra_columns = $this->page_setting($params['pageIndex'], '', $params['typeId']);
        $sqlType = false;
        $seller = vmc::singleton('seller_user_object')->get_current_seller();
        $mdl_seller = $this->app->model('sellers');
        $mdl_company_seller = app::get('base')->model('company_seller');
        $company_extra = $mdl_company_seller->getList('company_id', array(
            'uid' => $seller['seller_id'], 'identity' => $this->seller['ident'], 'from' => '1'), '0', '1', 'cs_id desc');
        $company_info = array(
            array('key' => 'company', 'label' => '公司信息', 'app' => 'base'),
            array('key' => 'contact', 'label' => '联系人信息', 'app' => 'base'),
            array('key' => 'brand', 'label' => '品牌信息', 'app' => 'b2c'),
            array('key' => 'store', 'label' => '店铺信息', 'app' => 'store'),
            array('key' => 'extra', 'label' => '扩展信息', 'app' => 'base'),
        );
        $company_id = 0;
        foreach ($company_info as $value) {
            if (isset($params[$value['key']]) && !empty($params[$value['key']])) {
                switch ($value['key']) {
                    case 'company':
                        $params[$value['key']]['business_type'] = '1';
                        $params[$value['key']]['info_type'] = $params['typeId'];
                        $params[$value['key']][$value['key'] . '_id'] && $sqlType = true;
                        if ($params['organization_licence'] && $params['tax_licence']) {
                            $params[$value['key']]['business_type'] = '0';
                        }
                    case 'contact':
                        $params[$value['key']]['uid'] = $seller['seller_id'];
                        $params[$value['key']]['from'] = '1';
                        $params[$value['key']][$value['key'] . '_id'] && $sqlType = true;
                        continue;
                    case 'brand':
                        $store_brand = true;
                    case 'store':
                        $params[$value['key']]['store_id'] && $sqlType = true;
                        $params[$value['key']]['seller_id'] = $seller['seller_id'];
                        $params[$value['key']]['store_type'] = $seller['ident'];
                        //添加经营分类
                        if (array_filter($params['cat_id']) &&
                            !$params['id'] &&
                            !app::get('store')->model('goods_cat')->addCat($params['cat_id'], $seller['seller_id'])
                        ) {
                            $db->rollback();
                            $msg = '经营分类添加失败';
                            return false;
                        }
                        continue;
                }
                $mdlObj = app::get($value['app'])->model($value['key']);
                if (!$mdlObj->save($params[$value['key']])) {
                    $db->rollback();
                    $msg = $value['label'];
                    return false;
                }
                if ($value['key'] == 'company') {
                    $company_id = $mdl_company_seller->db->lastinsertid();
                    $mdl_company_seller = app::get('base')->model('company_seller');
                    $company_seller = array(
                        'uid' => $seller['seller_id'],
                        'from' => '1',
                        'identity' => $params['typeId'],
                        'company_id' => $company_id ?: $company_extra[0]['company_id'],
                        'company_name' => $params[$value['key']]['name'],
                        'createtime' => time(),
                        'company_type' => $params[$value['key']]['company_type'] ?: '0',
                    );

                    $cs_id = $mdl_company_seller->getRow('cs_id', array('company_id' => $company_seller['company_id'], 'uid' => $seller['seller_id'], 'from' => '1'));
                    $company_seller['cs_id'] = $cs_id['cs_id'];
                    if (!$mdl_company_seller->save($company_seller)) {
                        $db->rollback();
                        return false;
                    }
                }
                if (!$store_brand) {
                    continue;
                }
                $params['brand_id'] = app::get('b2c')->model('brand')->db->lastinsertid();
                if (!$this->app->model('brand')->save($params['brand'])) {
                    $msg = '品牌信息';
                    $db->rollback();
                    return false;
                }
            }
        }

        $mdl_company_extra = app::get('base')->model('company_extra');

        foreach ($extra_columns['page'] as $key => $col) {
            if (isset($params[$col]) && !empty($params[$col])) {
                
                $params[$col]['content_id'] && $sqlType = true;
                $params[$col]['identity'] = $params['typeId'] == 'comm' ? null : $params['typeId'];
                $params[$col]['extra_id'] = $company_id ?: $company_extra[0]['company_id'];
                $params[$col]['uid'] = $seller['seller_id'];
                $params[$col]['createtime'] = time();
                $params[$col]['from'] = 1;

                //电商成员信息
                
                if (is_array(reset($params[$col]['value']))) {

                    if (!$this->_save_array($col, $params[$col], $seller['seller_id'])) {
                        $db->rollback();
                        $msg = $value['label'];
                        return false;
                    }
                    continue;
                }
                if (!$mdl_company_extra->extra_save($col, $params)) {
                    $db->rollback();
                    return false;
                }
            }
        }
        if (!$sqlType) {
            $company_extra['company_id'] = $company_id ?: $company_extra[0]['company_id'];
            $extra_data = array(
                'seller_id' => $seller['seller_id'],
                'schedule' => $params['pageIndex'],
                'company_extra' => $company_extra['company_id'],
                'sl_code' => $this->seller['sl_code']);

            if (!$mdl_seller->save($extra_data)) {
                $db->rollback();
                return false;
            }
        }
        $db->commit();
        return true;
    }


    private function _save_array($key, $params = null, $seller_id)
    {
        if (!empty($params)) {
            $mdl_company_extra = app::get('base')->model('company_extra');
            $first_arr = reset($params['value']);
            $length = count($first_arr);
            for ($i = 0; $i < $length; $i++) {

                if (empty($first_arr[$i])) {
                    continue;
                }
                $data['uid'] = $seller_id;
                $data['from'] = 1;
                $data['content_id'] = $params['content_id'][$i];
                $data['attach'] = $params['attach'][$i];
                $data['key'] = $key;
                $data['extra_id'] = $params['extra_id'];
                $data['identity'] = $this->seller['ident'];
                $data['createtime'] = time();
                foreach ($params['value'] as $k => $v) {
                    if(!$v && $k != 'trait') continue 2; //trait 车间工艺流程特点可以为空非必填
                    $data['value'][$k] = $v[$i];

                }
                if (!$mdl_company_extra->save($data)) {
                    return false;
                }
            }
            return true;
        }
    }

    /**
     * 营业执照类型 老版or新版
     * @params $seller_id 商家id
     * @params $type 公司类型
     * @params $index 公司下标
     * return  string new 新版 old 老版
     **/

    public function new_or_old($seller_id, $type, $index)
    {
        //查询入住营业执照信息判断是否是新版还是老版
        $company = app::get('base')->model('company_seller')->getList('company_id', array('from' => '1',
            'identity' => $type, 'uid' => $seller_id), $index - 1, '1', 'cs_id desc');
        $checked = app::get('base')->model('company')->getRow('business_type', array('company_id' => $company[0]['company_id']));
        $licence_type = $checked['business_type'] == '1' ? 'new' : 'old';
        return $licence_type;
    }


    /**
     * 提交商家入驻信息
     */
    public function apiEntry($type)
    {
        //取得商家已绑定的公司
        $company_id = app::get('base')->model('company_seller')->getList('company_id', array('uid' => $this->seller['seller_id'], 'from' => '1'));
        $mdl_company_extra = app::get('base')->model('company_extra');
        $api_data = Array();
        $mdl_company = app::get('base')->model('company');

        $conf = $this->app->getConf('seller_entry');
        foreach ($company_id as $key => $value) {
            //查询公司信息
            $this->company[$value['company_id']] = $mdl_company->getRow('*', array('company_id' => $value['company_id']));
            $api_data[$value['company_id']] = $mdl_company_extra->getList('*', array('uid' => $this->seller['seller_id'], 'from' => '1'));
            //查询可以添加多次的公司信息
            foreach ($conf['array_info'] as $v) {
                $api_data[$value['company_id']][$v] = $mdl_company_extra->arrayInfo('*', array('uid' => $this->seller['seller_id'], 'from' => '1', 'key' => $v));
            }
        }
        $data = $this->pre_entry_process($api_data);
        $rpc = $this->_checkData($data, $type);
        $result = app::get('seller')->rpc($rpc)->request($data);
        if ($result['result']) {
            $filter = array('company_id' => $company_id[0]['company_id']);
            $update_value = array('ep_id' => $result['result']['epId']);
            $db = vmc::database();
            $db->beginTransaction();
            if (!$mdl_company->update($update_value, $filter)) {
                $db->rollback();
                return false;
            }
            $filter = array('seller_id' => $this->seller['seller_id']);
            $update_value = array('sl_code' => $this->seller['sl_code'] ?: $result['result']['slCode']);
            if (!app::get('seller')->model('sellers')->update($update_value, $filter)) {
                $db->rollback();
                return false;
            }

            $apiBrand = $this->app->rpc('select_company_brand')->request(array('epId' => $result['result']['epId']));

            $filter = array('seller_id' => $this->seller['seller_id']);//api_company_id api_brand_id
            $update_value = array('api_brand_id' => $apiBrand['result']['slEpBrandList'][0]['brandId'],
                'api_company_id' => $result['result']['epId']);
            if (!app::get('b2c')->model('brand')->update($update_value, $filter)) {
                $db->rollback();
                return false;
            }
            $db->commit();
            return true;
        }
        return $result['message'];
    }

    private function _checkData(&$data, $type)
    {
        $rpc = '';
        if($type == 'update')
        {
            unset($data['slAccount']);
            unset($data['slSeller']);
            unset($data['insertFlag']);
            $rpc = 'edit_seller_info1';
            switch ($this->seller['ident']) {
                case '1' :
                    $rpc = 'edit_seller_info1';
                    break;
                case '2' :
                    $rpc = 'edit_seller_info2-2';
                    break;
                case '4' :
                    $rpc = 'edit_seller_info2-2';
                    break;
            }
        }
        else
        {
            switch ($this->seller['ident']) {
                case '1' :
                    $rpc = 'edit_seller_info';
                    break;
                case '2' :
                    $rpc = 'edit_seller_info2';
                    break;
                case '4' :
                    $rpc = 'edit_seller_info2';
                    break;
            }
        }

        return $rpc;
    }


    /**
     * 组织提交给接口的数据
     */
    public function &pre_entry_process(&$api_data)
    {
        $result = Array();
        $this->_process_account($result);
        $this->_process_company($api_data, $result);
        $result['loginId'] = 'adsf';
        $result['delFlg'] = '0';
        $result['ver'] = '1';
        $result['insertFlag'] = '0';
        return $result;
    }

    /**
     * 整理帐户基本信息
     */
    private function _process_account(&$result)
    {
        $tmp['pam'] = app::get('pam')->model('sellers')->getRow('*', array('seller_id' => $this->seller['seller_id']));
        $result['slAccount'] = array(
            'login_account' => $tmp['pam']['login_account'],
            'mobile' => $this->seller['mobile'],
            'show_name' => $tmp['pam']['login_account'],
            'contact_person' => $tmp['pam']['login_account'],
            'login_password' => $tmp['pam']['password'],
            'authStatus' => 2,
            'fromFlg' => '2',
        );
        $seller_type = Array();
        if ($this->seller['ident'] & 1) {
            $seller_type['selfFlg'] = '1';
        }
        if ($this->seller['ident'] & 2) {
            $seller_type['agentFlg'] = '2';
        }
        if ($this->seller['ident'] & 4) {
            $seller_type['oemFlg'] = '3';
        }

        $region = app::get('ectools')->model('regions')->region_decode($this->seller['area']); //todo地区三级联动
        $result['slSeller'] = array(
            'login_account' => $tmp['pam']['login_account'],
            'slCode' => $this->seller['sl_code'],
            'slConFlg' => '1',
            'provinceCode' => $region['province']['code'],
            'cityCode' => $region['city']['code'],
            'districtCode' => $region['district']['code'],
            'slMainClass' => $this->seller['type'] == '1' ? 4 : (int)$seller_type[array_rand($seller_type)],
            'snkFlg' => '0',
            'selfFlg' => $seller_type['selfFlg'] ? '1' : '0',
            'agentFlg' => $seller_type['agentFlg'] ? '1' : '0',
            'oemFlg' => $seller_type['oemFlg'] ? '1' : '0',
            'buyerFlg' => $this->seller['type'] == '1' ? '1' : '0',
            'sqaStatus' => '1',
            'distQua' => '1',
            'shopQua' => '1',
        );
    }

    /**
     * 整理公司信息
     */
    private function _process_company(&$api_data, &$result)
    {
        $tmp = Array();
        $brand = app::get('b2c')->model('brand')->getList('*', array('seller_id' => $this->seller['seller_id']));
        $mdl_cat = app::get('store')->model('goods_cat');
        $cat = $mdl_cat->getList('*', array('seller_id' => $this->seller['seller_id']));

        $conf = $this->app->getConf('education');

        foreach ($api_data as $key => $value) {
            //卖家产品类别
            $catList = Array();
            foreach ($cat as $v) {
                $cat_id = explode(',', $v['cat_path']);
                if (count($cat_id) >= 3) continue;
                if (count($cat_id) == 2) {
                    $parent = $mdl_cat->getRow('addon', array('cat_id' => $cat_id[0], 'seller_id' => $this->seller['seller_id']));
                    $catList[] = array(
                        'pdClassesCode' => $parent['addon'],
                        'machiningCode' => $v['addon'],
                        'slCode' => $this->seller['sl_code'],
                    );
                }
            }

            $tmp[$key]['pdClassesCodeList'] = $catList;
            //企业基本资质
            $company_id = $value['business_licence']['extra_id'];
            $apiCompanyId = app::get('base')->model('company')->getRow('ep_id', array('company_id' => $company_id));
            $tmp[$key]['slEnterprise'] = array(
                'slCode' => $this->seller['sl_code'],
                'epId' => $apiCompanyId['ep_id'],
                'epName' => $this->company[$company_id]['name'],
                'licType' => $this->company[$company_id]['business_type'],
                'licName' => $this->company[$company_id]['name'],
                'licNo' => $this->company[$company_id]['business'],
                'licAddr' => $this->company[$company_id]['address'],
                'licBusiType' => '',
                'licBusiScope' => $this->company[$company_id]['operating_period'],
                'licLegalPerson' => $value['business_licence']['value']['name'],
                'licRegCapital' => $this->company[$company_id]['registered_capital'],
                'licPaidinCapital' => $this->company[$company_id]['reality_capital'],
                'licCrtDate' => $this->company[$company_id]['establishment_date'],
                'licTermBegin' => $this->company[$company_id]['establishment_date']['value']['begin'],
                'licTermEnd' => $this->company[$company_id]['establishment_date']['value']['end'],
                'licTermUnliimited' => '0',
                'taxNo' => $value['tax_licence']['value']['code'],
                'taxVatNo' => $value['tax_licence']['value']['num'],
                'orgNo' => $value['organization_licence']['value']['code'],
                'orgTermBegin' => $value['organization_licence']['value']['date_start'],
                'orgTermEnd' => $value['organization_licence']['value']['date_end'],

                //银行开户许可证
                'balLegalPerson' => $value['bank_lesstion']['value']['legal'],
                'balBank' => $value['bank_lesstion']['value']['name'],
                'balAccount' => $value['bank_lesstion']['value']['code'],
                //食品流通许可证
                'fdlNo' => $value['food_flow_licence']['value']['code'],
                'fdlTermBegin' => $value['food_flow_licence']['value']['date_start'],
                'fdlTermEnd' => $value['food_flow_licence']['value']['date_end'],
            );

            //企业专业资质
//            $result[$key]['certInfoList'] = array(
//                array(
//                    'epId' => '',
//                    'certId' => '',
//                    'certName' => '',
//                    'certItemList' => array(
//                        'certId' => '',
//                        'certItemId' => '',
//                        'certItemName' => '',
//                        'certItemValue' => '',
//                    ),
//                ),
//            );

            //企业荣誉
            $slEpHonorList = Array();
            $apiSellerInfo = $this->app->rpc('select_seller_info')->request(array('login_account' => $this->seller['login_account']));
            foreach ($value['company_touted'] as $k => $v) {
                $slEpHonorList[] = array(
                    'epId' => $apiCompanyId['ep_id'],
                    'honorId' => $apiSellerInfo['result']['slEpHonorList'][$k]['honorId'],
                    'honorDesc' => $v['value']['desc'],
                    'certDate' => $v['value']['date'],
                    'certIssuer' => '',
                );
            }
            $tmp[$key]['slEpHonorList'] = $slEpHonorList;

            //企业产品品牌
            foreach ($brand as $v) {
                $brand_list[] = array(
                    'epId' => $apiCompanyId['ep_id'],
                    'brandId' => $v['api_brand_id'],
                    'brandClass' => '0',
                    'brandName' => $v['brand_name'],
                    'brandNo' => '123456',
                    'brandTermBegin' => '',
                    'brandTermEnd' => '',
                );
            }
            $tmp[$key]['slEpBrandList'] = $brand_list;

            //卖家产品品牌
//            $result[$key]['slPdBrandList'] = array(
//                'slCode' => '',
//                'brandEpId' => '',
//                'brandId' => '',
//                'brandName' => '',
//                'brandType' => '',
//                'brandClass' => '',
//                'contractNo' => '',
//                'termBegin' => '',
//                'termEnd' => '',
//            );

            //企业车间
            $slEpWorkshopList = Array();
            foreach ($value['workshop'] as $k => $v) {
                $slEpWorkshopList[] = array(
                    'epId' => $apiCompanyId['ep_id'],
                    'workshopId' => $apiSellerInfo['result']['slEpWorkshopList'][$k]['workshopId'],
                    'workshopName' => $v['value']['name'],
                    'product' => $v['value']['pro'],
                    'process' => $v['value']['trait'],
                );
            }
            $tmp[$key]['slEpWorkshopList'] = $slEpWorkshopList;

            //企业生产能力
            $tmp[$key]['slEpCap'] = array(
                'slCode' => $this->seller['sl_code'],
                'epId' => $apiCompanyId['ep_id'],
                'ftyAsset' => $value['factory']['value']['general'],
                'ftyRegCapital' => $value['factory']['value']['general'], // ???
                'ftyLandArea' => $value['factory']['value']['soil_area'],
                'ftyFloorArea' => $value['factory']['value']['plant_area'],
                'ftyEquipment' => $value['factory']['value']['main_device'],
                'ftyDesignCap' => $value['factory']['value']['design_capacity'],
                'ftyActualCap' => $value['factory']['value']['actual_capacity'],
                'ftyFtRate' => $value['factory']['value']['foreign_trade'],
                'ftyDsRate' => $value['factory']['value']['direct_selling'],
                'ftyAsRate' => $value['factory']['value']['seller_agency'],
                'scapMaterial' => $value['storage']['value']['material'],
                'scapProduct' => $value['storage']['value']['end_pro'],
                'labArea' => $value['laboratory']['value']['area'],
                'labFunction' => $value['laboratory']['value']['fun'],
                'labInvestment' => $value['laboratory']['value']['invest'],
                'labMember' => $value['laboratory']['value']['staff'],
                //'ddEquipment' => '',
            );

            //生产商
            $agent = app::get('base')->model('company_extra')->getList('*', array(
                'key' => 'agent_auth_lesstion',
                'uid' => $this->seller['seller_id'],
                'form' => '1'));

            if ($this->seller['ident'] == 2) {
                $identity = 1;
            }
            if ($this->seller['ident'] == 4) {
                $identity = 2;
            }
            $tmp[$key]['slEpAuthList'] = array(
                array(
                    'flag' => $identity,
                    'slCode' => $this->seller['sl_code'],
                    'producerEpId' => $agent['agent_auth_lesstion']['value']['agent'] ?: $agent['oem_auth_lesstion']['value']['agent'],
                    'contractNo' => $agent['agent_auth_lesstion']['value']['num'] ?: $agent['oem_auth_lesstion']['value']['num'],
                    'authEpName' => $agent['agent_auth_lesstion']['value']['unit'] ?: $agent['oem_auth_lesstion']['value']['unit'],
                    'authTermBegin' => $agent['agent_auth_lesstion']['value']['start'] ?: $agent['oem_auth_lesstion']['value']['start'],
                    'authTermEnd' => $agent['agent_auth_lesstion']['value']['end'] ?: $agent['oem_auth_lesstion']['value']['end'],
                    'authTermUnliimited' => '1',
                ));
            $manage[0] = $value['president'];
            $manage[0]['duties'] = '董事长';
            $manage[1] = $value['general_manager'];
            $manage[1]['duties'] = '总经理';
            $manage[2] = $value['vice_general_manager'];
            $manage[2]['duties'] = '副总经理';
            $manage[3] = $value['sale_manager'];
            $manage[3]['duties'] = '销售部经理';
            $manage[4] = $value['qa_manager'];
            $manage[4]['duties'] = '品控部经理';
            $manage[5] = $value['finance_manager'];
            $manage[5]['duties'] = '财务部经理';
            //企业管理团队
            $slEpManagerList = Array();

            foreach ($manage as $k => $v) {
                $slEpManagerList[] = array(
                    'epId' => $apiCompanyId['ep_id'],
                    'memberId' => $apiSellerInfo['result']['slEpManagerList'][$k]['memberId'],
                    'memberDuties' => $v['duties'],
                    'memberName' => $v['value']['name'],
                    'memberAge' => $v['value']['age'],
                    'memberEduc' => $conf[$v['value']['edu']],
                    'memberTel' => $v['value']['contact'],
                );
            }
            $tmp[$key]['slEpManagerList'] = $slEpManagerList;


            //卖家电商团队
            $slEcTeamList = Array();
            //ec_group_manager
            $value['ec_group_employees'][] = $value['ec_group_manager'];
            foreach ($value['ec_group_employees'] as $k => $v) {
                $slEcTeamList[] = array(
                    'slCode' => $this->seller['sl_code'],
                    'memberId' => $apiSellerInfo['result']['slEcTeamList'][$k]['memberId'],
                    'leaderFlg' => $v['key'] == 'ec_group_manager' ? '1' : '0',
                    'memberName' => $v['value']['name'],
                    'memberAge' => (int)$v['value']['age'],
                    'birthday' => '',
                    'memberEduc' => $conf[$v['value']['edu']],
                    'memberTel' => $v['value']['contact'],
                );

                $tmp[$key]['slEcTeamList'] = $slEcTeamList;
            }
            //企业检测设备
            $slEpDdList = Array();
            foreach ($value['equipment'] as $k => $v) {
                $slEpDdList[] = array(
                    'epId' => (int)$apiCompanyId['ep_id'],
                    'ddId' => (int)$apiSellerInfo['result']['slEpDdList'][$k]['ddId'],
                    'ddName' => $v['value']['main_device'],
                    'ddEquipment' => $v['value']['use']
                );

                $tmp[$key]['slEpDdList'] = $slEpDdList;
            }
            $result = array_merge($result, current($tmp));
        }
    }

    /**
     * 添加企业资质提交到接口
     **/
    public function apiAptitudes($cat)
    {
        //aptitudes

        $filter = array('seller_id' => $this->seller['seller_id']);
        if ($cat) {
            $filter['cat_id'] = $cat;
        }
        $catList = app::get('store')->model('goods_cat')->getList('*', $filter);
        $apiAptitudes = $this->app->getConf('aptitudes');
        $apiData = array();
        $j = 0;
        foreach ($catList as $value) {
            if (empty($value['extra'])) continue;
            $i = 0;
            foreach ($value['extra']['extra'] as $k => $v) {
                if(!join('', $v)) continue;
                $apiData[$j]['certInfoList'][$i] = array(
                    'epId' => $this->seller['sl_code'],
                    'certId' => $apiAptitudes[$k]['id'],
                    'certName' => $apiAptitudes[$k]['label'],
                );
                switch ($k) {
                    case 'muslim':
                        $v = array(
                            'code' => $v['code'],
                            'date' => $v['start'] . '-' . $v['end'],
                            'approve_org' => $v['approve_org'],
                        );
                        break;
                    case 'iso14001';
                    case 'iso9001';
                    case 'iso22000';
                        $v = array(
                            'code' => $v['code'] ?: $v['name'],
                            'stand' => $v['stand'],
                            'range' => $v['range'],
                            'date' => $v['start'] . '-' . $v['end'],
                            'approve_org' => $v['approve_org'],
                        );
                        break;
                }
                foreach ($apiAptitudes[$k]['item'] as $k1 => $v2) {
                    $apiData[$j]['certInfoList'][$i]['certItemList'][] = array(
                        'certId' => '',
                        'certItemId' => 1,
                        'certItemName' => $apiAptitudes[$k]['item'][$k1],
                        'certItemValue' => current($v),
                    );
                    next($v);
                }
                $i++;
            }
			$prentCatId = app::get('b2c')->model('goods_cat')->getRow('addon', array('cat_id' => $value['parent_id']));
			$apiData[$j]['pdClassesCodeList'][] = array(
				'pdClassesCode'	=> $prentCatId['addon'],
				'machiningCode'	=> $value['addon'],
				'slCode' => $this->seller['sl_code'],
			);
            $j++;
        }
        foreach ($apiData as $key => $value) {
            $result = app::get('seller')->rpc('edit_seller_aptitudes')->request($value);
            if (!$result['status']) {
                return $result['message'];
            }
        }
        return true;
    }


    /**
     * 商家身份更新
     **/
    public function identity_update(&$post)
    {
        $db = vmc::database();
        $db->beginTransaction();
        $result = false;
        switch ($post['type']) {
            case '0':
                $result = $this->_seller_update($post);
                break;
            case '1':
                $result = $this->_insert_buyer($post);
                break;
        }
        !$result && $db->rollback();
        $result && $db->commit();
        return $result;
    }

    private function _seller_update(&$post)
    {
        $dataValue = array('ident' => $post['ident'], 'type' => $post['type']);
        $filter = array('seller_id' => $post['seller_id']);
        if (!$this->app->model('sellers')->update($dataValue, $filter)) {
            return false;
        }

        return true;
    }

    private function _insert_buyer(&$post)
    {
        $mdl_pam_seller = app::get('pam')->model('sellers');
        $pam_data = $mdl_pam_seller->getRow('*', array('seller_id' => $post['seller_id']));
        if (empty($pam_data)) return false;
        unset($pam_data['seller_id']);
        unset($pam_data['type']);
        $mdl_seller = $this->app->model('sellers');
        $seller_data = $mdl_seller->getRow('*', array('seller_id' => $post['seller_id']));
        if (empty($seller_data)) return false;
        unset($seller_data['seller_id']);
        unset($seller_data['type']);
        if (!$mdl_pam_seller->delete(array('seller_id' => $post['seller_id']))) {
            return false;
        }
        if (!$mdl_seller->delete(array('seller_id' => $post['seller_id']))) {
            return false;
        }
        $return = $this->add_buyer($seller_data, $pam_data);
        return $return;
    }

    /**
     * 买手注册走pam_member表,
     * @param unknown $seller_data
     * @param unknown $pam_data
     */
    public function add_buyer($seller_data, $pam_data)
    {
        $check_buyer_account = app::get('buyer')->model('buyers')->getRow($pam_data['login_type'], array($pam_data['login_type'] => $pam_data['login_account']));
        //buyer_buyers不存在
        if (empty($check_buyer_account[$pam_data['login_type']])) {
            $check_member_account = app::get('pam')->model('members')->getRow('member_id', array('login_account' => $pam_data['login_account']));
            //pam_members存在
            $seller_data['phone'] = $seller_data['mobile'];
            $seller_data[$pam_data['login_type']] = $pam_data['login_account'];
            if ($check_member_account['member_id']) {
                $seller_data['member_id'] = $check_member_account['member_id'];
                app::get('buyer')->model('buyers')->save($seller_data);
            } else {
                app::get('b2c')->model('members')->save($seller_data);
                $pam_data['member_id'] = $seller_data['member_id'];
                app::get('pam')->model('members')->save($pam_data);
                app::get('buyer')->model('buyers')->save($seller_data);
            }
            return $seller_data ?: null;
        }
    }


}
