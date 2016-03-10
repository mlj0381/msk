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


class vmcadmin_api_init extends base_api
{
    //设置站点名称
    public function sitename($params){
        if(!$params['title']){
            $this->success(array('sitename'=>app::get('site')->getConf('site_name')));
        }
        app::get('site')->setConf('site_name',$params['title']);
        app::get('site')->setConf('page_default_title',$params['title']);
        app::get('mobile')->setConf('mobile_name',$params['title']);
        $this->success();
    }

    //重置超级管理员密码,只重置第一个用户（即初创用户）的密码。
    public function reset_op_password($params){
        $users = app::get('desktop')->model('users');
        $sdf = $users->dump(1, '*', array(
            ':account@pam' => array(
                '*'
            )
        ));
        $use_pass_data['login_name'] = $sdf['account']['login_name'];
        $use_pass_data['createtime'] = $sdf['account']['createtime'];
        $_save_data['pam_account']['login_password'] = pam_encrypt::get_encrypted_password(trim($params['new_password']) , pam_account::get_account_type('desktop') , $use_pass_data);
        $_save_data['pam_account']['account_id'] = $_save_data['user_id'] = 1;
        $users->save($_save_data);
        $this->success();
    }

}
