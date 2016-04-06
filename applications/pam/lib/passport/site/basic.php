<?php

/*
 * 前台登录
 * */
class pam_passport_site_basic
{
	
	/**
	 * 买家注册基本信息和账户
	 * @param array $members 买家基本信息
	 * @param array $account 买家账户信息
	 */
	public function local_user_rsyns($members,$account)
	{
		
		$buyer_id = $members['buyer_id'];
		$data = app::get('b2c')->model('members')->getRow("member_id", array('buyer_id' => $buyer_id));
		if (!$data){
			$db = vmc::database();
			$db->beginTransaction();
			
			$t1 = app::get('b2c')->model('members')->save($members);
			$t1 = true ;//待修改的代码，保存成功也返回false
			if(!$t1){
				$db->rollback();
			}
			$member_id = vmc::database()->lastinsertid();
			$account['member_id'] = $member_id;
			$t2 = app::get('pam')->model('members')->save($account);
			$t2 = true ;//待修改的代码，保存成功也返回false
			if(!$t2){
				$db->rollback();
			}
			$db->commit();
		}		
	}
	/**
	 * 卖家注册基本信息和账户
	 * @param array $sellers 卖家基本信息
	 * @param array $account 卖家账户信息
	 */
	public function local_seller_rsyns($sellers,$account){
		
		$api_seller_id = $sellers['api_seller_id'];
		$data = app::get('seller')->model('sellers')->getRow("seller_id", array('api_seller_id' => $api_seller_id));
		
		if (!$data){
			$db = vmc::database();
			$db->beginTransaction();
				
			$t1 = app::get('seller')->model('sellers')->save($sellers);
			$t1 = true ;//待修改的代码，保存成功也返回false
			if(!$t1){
				$db->rollback();
			}
			
			$seller_id = vmc::database()->lastinsertid();
			$account['seller_id'] = $seller_id;
			$t2 = app::get('pam')->model('sellers')->save($account);
			$t2 = true ;//待修改的代码，保存成功也返回false
			if(!$t2){
				$db->rollback();
			}
			$db->commit();
		}
		
	}
	/**
	 * 买手注册基本信息和账户
	 * @param array $buyers 买手基本信息
	 * @param array $account 买手账户信息
	 */
	public function local_buyer_rsyns($buyers,$account){
	
	
		$data = app::get('buyer')->model('buyers')->getRow("buyer_id", array('local' => $buyers['local']));
		
		if (!$data){
			$db = vmc::database();
			$db->beginTransaction();
	
			$t1 = app::get('buyer')->model('buyers')->save($buyers);
			$t1 = true ;//待修改的代码，保存成功也返回false
			if(!$t1){
				$db->rollback();
			}
				
			$buyers_id = vmc::database()->lastinsertid();
			$account['buyer_id'] = $buyers_id;
			$t2 = app::get('pam')->model('buyers')->save($account);
			$t2 = true ;//待修改的代码，保存成功也返回false
			if(!$t2){
				$db->rollback();
			}
			$db->commit();
		}
	
	}
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
        if($type == 'freeze')
        {
            $model = 'freeze';
            $id = 'freeze_id';
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
