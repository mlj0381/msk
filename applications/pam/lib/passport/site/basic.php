<?php

/*
 * 前台登录
 * */
class pam_passport_site_basic
{
    /*
     * 前台用户登录验证方法
     *
     * @params $login_account 登录账号
     * @params $login_password 登录密码
     * @params $vcode 验证码
     * */
    public function login($userData, $vcode = false, &$msg, $type = 'b2c')
    {
        $userData = utils::_filter_input($userData); //过滤xss攻击
        //快速登录不用验证码
        if($vcode != 'quick'){
            if (!$vcode || !base_vcode::verify('passport', $vcode)) {
            $msg = '验证码错误';

            return false;
            }
        }
      
        //如果指定了登录类型,则不再进行获取(邮箱登录，手机号登录，用户名登录)
        if (!$userData['login_type']) {
            $userPassport = vmc::singleton('b2c_user_passport');
            $userData['login_type'] = $userPassport->get_login_account_type($userData['login_account']);
        }
        $filter = array(
            'login_type' => $userData['login_type'],
            'login_account' => $userData['login_account'],
        );
        $model = 'members';
        $id = 'member_id';
        if($type == 'sellers')
        {
            $model = 'sellers';
            $id = 'seller_id';
        }
        $account = app::get('pam')->model($model)->getList($id . ',password_account,login_password,createtime', $filter);
        if (!$account) {
            $msg = '不存在的用户';

            return false;
        }
        $login_password = pam_encrypt::get_encrypted_password($userData['login_password'], 'member', array(
            'createtime' => $account[0]['createtime'],
            'login_name' => $account[0]['password_account'],
        ));
        if ($account[0]['login_password'] != $login_password) {
            $msg = '登录密码错误';

            return false;
        }

        return $account[0][$id];
    } //end function
}
