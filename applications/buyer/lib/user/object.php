<?php

class buyer_user_object extends base_user_object{

    public function __construct(&$app){
    	parent::__construct($app);
        $this->app = $app; 
    }

    /**
     * 判断当前用户是否登录
     */
    public function is_login(){
        return $this->get_session();
    }
    
    
   

    
   
    
    
}
