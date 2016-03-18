<?php

/**
 * 登录注册流程/逻辑处理类.
 */
class freeze_user_passport {

    public function __construct(&$app) {
        $this->app = $app;
        $this->user_obj = vmc::singleton('b2c_user_object');
        vmc::singleton('base_session')->start();
    }

    /*
     * 判断前台用户名是否存在
     * */

    public function is_exists_login_name($login_account) {
        if (empty($login_account)) {
            return false;
        }
        $pam_members_model = app::get('pam')->model('members');
        $flag = $pam_members_model->getList('member_id', array(
            'login_account' => trim($login_account),
        ));

        return $flag ? true : false;
    }

    /*
    * 判断前台用户名是否存在
    * */

    public function is_exists_mobile($mobile) {
        if (empty($mobile)) {
            return false;
        }
        $mdl_members = app::get('b2c')->model('members');
        $flag = $mdl_members->getList('member_id', array(
            'login_account' => trim($mobile),
        ));

        return $flag ? true : false;
    }

    /*
     * 获取前台登录用户类型(用户名,邮箱，手机号码)
     *
     * @params $login_account 登录账号
     * @return $account_type
     * */

    public function get_login_account_type($login_account) {
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
    }


    /**
     * 组织注册需要的数据.
     */
    public function pre_signup_process($data) {
        if ($data['pam_account']) {
            $accountData = $this->pre_account_signup_process($data['pam_account']);
        }

        //---end
        $return = array(
            'pam_account' => $accountData,
            'freeze' => array(
                'updatetime' => time(),
            ),
        );
        return $return;
    }

    /**
     * 检查会员注册数据合法性.
     */
    public function check_signup($data, &$msg) {

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
    }

//end function

    /**
     * 注册pam_members 表数据结构.
     */
    public function pre_account_signup_process($accountData, $password_account = null) {
        $login_account = strtolower($accountData['login_name']);
        $password_account = $password_account ? $password_account : $login_account;
        $use_pass_data['login_name'] = $password_account;
        $use_pass_data['createtime'] = time();
        $login_password = pam_encrypt::get_encrypted_password(trim($accountData['login_password']), 'member', $use_pass_data);
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



    //获取会员注册项加载
    public function get_signup_attr($member_id = null) {
        if ($member_id) {
            $member_model = $this->app->model('members');
            $mem = $member_model->dump($member_id);
        }
        $member_model = $this->app->model('members');
        $mem_schema = $member_model->_columns();
        $attr = array();
        foreach ($this->app->model('member_attr')->getList() as $item) {
            if ($item['attr_show'] == 'true') {
                $attr[] = $item;
            } //筛选显示项
        }
        foreach ((array) $attr as $key => $item) {
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
    }

//end function

    /*
     * 保存会员信息members表和注册扩展项数据
     *
     * */

    public function save_members($saveData, &$msg) {
        $freeze_model = $this->app->model('freeze');
//        $db = vmc::database();
//        $db->beginTransaction();
        if ($freeze_model->save($saveData['freeze'])) {
            $freeze_id = $saveData['freeze']['freeze_id'];
            $saveData['pam_account']['freeze_id'] = $freeze_id;
            if (!app::get('pam')->model('freeze')->save($saveData['pam_account'])) {
//                $db->rollBack();
                $msg = '账户数据保存异常!';

                return false;
            }
//            $db->commit();
        } else {
            $msg = '保存失败!';

            return false;
        }

        return $freeze_id;
    }

}
