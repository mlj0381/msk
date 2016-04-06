<?php

class buyer_user_object{

    public function __construct(&$app){
        $this->app = $app;
        if($_COOKIE['AUTO_LOGIN']){
            $minutes = 7*24*3600;//7天
            vmc::singleton('base_session')->set_sess_expires($minutes);
            vmc::singleton('base_session')->set_cookie_expires($minutes);
            $this->cookie_expires = $minutes;
        }//如果有自动登录，设置session过期时间，单位：分
        vmc::singleton('base_session')->start();
    }

    /**
     * 判断当前用户是否登录
     */
    public function is_login(){
        return $this->get_session();
    }
    
    
    /**
     * 设置会员登录session seller_id
     */
    public function set_session($buyer_data, $buyer_code=''){
        $_SESSION['account'] = ['member' => $buyer_data['member_id'],'buyer_id' => $buyer_data['buyer_id'], 'buyer_code' => $buyer_code];
    }

    /**
     * 获取会员登录session seller_id
     */
    public function get_session(){
        if($_SESSION['account']['buyer_id'] &&  isset($_SESSION['account']['buyer_code'])){
        	return $_SESSION['account'];
        }else{
            return false;
        }
    }
    
    public function get_id(){
    	return $_SESSION['account']['buyer_id'] ?: false;
    }
    
    
}
