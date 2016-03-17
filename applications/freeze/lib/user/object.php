<?php

class freeze_user_object{

    public function __construct(&$app){
        $this->app = $app;
        if($_COOKIE['AUTO_LOGIN']){
            $minutes = 30*24*60;//30天
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
        $member_id = $this->get_member_session();
        return $member_id ? true : false;
    }

    /**
     * 获取当前用户ID
     */
    public function get_member_id(){
        return $member_id = $this->get_member_session();
    }

    //根据用户名得到会员ID
    public function get_member_id_by_username($login_account){
        $pam_members_model = app::get('pam')->model('freeze');
        $data = $pam_members_model->getList('freeze_id',array('login_account'=>$login_account));
        return $data[0]['freeze_id'];
    }

    /**
     * 设置会员登录session member_id
     */
    public function set_member_session($member_id){
        unset($_SESSION['error_count'][$this->app->app_id]);
        $_SESSION['account'][$this->app->app_id] = $member_id;
    }

    /**
     * 获取会员登录session member_id
     */
    public function get_member_session(){
        if($this->freeze_id)return $this->freeze_id;
        if(isset($_SESSION['account']['freeze']) &&  $_SESSION['account']['freeze']){
            return $_SESSION['account']['freeze'];
        }else{
            return false;
        }
    }

    /**
     * 得到当前登陆用户的信息
     *
     * @param null
     * @return array 用户信息
     */
    public function get_current_member(){
        if($this->member_info){
            return $this->member_info;
        }
        return $this->get_member_info( );
    }

    /**
     *当前会员用户信息
     */
    public function get_member_info( $member_id ) {
        if(!$member_id){
            $member_id = $this->freeze_id = $this->get_member_id();
        }
        $memberFilter = array(
            'account' => 'member_id,login_account,login_type',
            'freeze'=>'*',
        );
        $memberData = $this->get_members_data($memberFilter,$member_id);

        return $memberData;
    }

    /**
     * 获取当前会员信息(标准格式，按照表结构获取)
     * $columns = array(
     *      'account' => 'member_id',
     *      'members' => 'member_id',
     * );
     */
    public function get_members_data($columns,$member_id=null){
        if(!$member_id){
            $this->freeze_id = $this->get_member_id();
        }

        if( $columns['account'] ){
            $data['account'] = $this->_get_pam_members_data($columns['account'],$member_id);
        }

        if($columns['freeze']){
            $data['freeze'] = $this->_get_b2c_members_data($columns['freeze'],$member_id);
        }

        return $data;
    }

    /**
     * 获取当前会员用户基本信息(b2c_members)
     */
    private function _get_b2c_members_data($columns='*',$member_id=null){
        if(!$member_id){
            $member_id = $this->freeze_id;
        }
        $b2c_members_model = app::get('freeze')->model('freeze');
        if(is_array($columns) ){
            $columns = implode(',',$columns);
        }
        $membersData = $b2c_members_model->getList($columns,array('freeze_id'=>$member_id));
        return $membersData[0];
    }

    /**
     * 获取当前登录账号(pam_members)表信息
     */
    private function _get_pam_members_data($columns='*',$member_id){
        if(!$member_id){
            $member_id = $this->freeze_id;
        }
        $pam_members_model = app::get('pam')->model('freeze');
        if(is_array($columns)){
            $columns = implode(',',$columns);
        }
        if( $columns != '*' && !strpos($columns,'login_type') ){
            $columns .= ',login_type';
        }
        $accountData = $pam_members_model->getList($columns,array('freeze_id'=>$member_id));
        foreach((array)$accountData as $row){
            foreach((array)$row as $key=>$val){
                if($key == 'login_type'){
                    $arr_colunms[$val] = $row['login_account'];
                }else{
                    $arr_colunms[$key] = $val;
                }
            }
        }//end foreach

        //$arr_colunms['login_account'] = $arr_colunms['local'];
        return $arr_colunms;
    }

    public function get_pam_data($columns="*",$member_id){
        if(is_array($columns)){
            $columns = implode(',',$columns);
        }
        if( $columns != '*' && !strpos($columns,'login_type') ){
            $columns .= ',login_type';
        }
        $pam_members_model = app::get('pam')->model('freeze');
        $b2c_members_model = app::get('freeze')->model('freeze');
        $accountData = $pam_members_model->getList($columns,array('freeze_id'=>$member_id));
        $memberData = $b2c_members_model->getRow($columns,array('freeze_id'=>$member_id));
        foreach((array)$accountData as $row){
            $arr_colunms[$row['login_type']] = $row;
        }
        $arr_colunms['freezeData'] = $memberData;
        return $arr_colunms;
    }

    /**
     * 获取当前会员用户名/或指定用户的用户名
     */
    public function get_member_name($login_name=null,$member_id=null){
        if(!$login_name){
            $member_id = $member_id ? $member_id : $this->get_member_id();
            $pam_members_model = app::get('pam')->model('freeze');
            $data = $pam_members_model->getList('*',array('freeze_id'=>$member_id));

            foreach((array)$data as $row){
                $arr_name[$row['login_type']] = $row['login_account'];
            }

            if( isset($arr_name['local']) ){
                $login_name = $arr_name['local'];
            }elseif(isset($arr_name['email'])){
                $login_name = $arr_name['email'];
            }elseif(isset($arr_name['mobile'])){
                $login_name = $arr_name['mobile'];
            }else{
                $login_name = current($arr_name);
            }
        }
        return $login_name;
    }

    /*
     * 会员注册页面配置 企业联系人信息
     * return pageSetting array()
     * */
    public function page_company($uid = null)
    {
        //读取会员注册配置
        $conf = app::get('b2c')->getConf('main_products');
        //读取收货时间
        $conf['time'] = app::get('b2c')->getConf('receiving_time');
        //读取分类
        $conf['cat'] = app::get('b2c')->model('goods_cat')->get_tree();
        //获取页面信息
        $mdl_company = app::get('base')->model('company');
        $mdl_contact = app::get('base')->model('contact');
        $uid = $uid ? $uid : $this->get_member_id();
        $filter = array('uid' => $uid, 'from' => '0');
        $conf['info']['company'] = $mdl_company->getRow('*', $filter);
        $conf['info']['contact'] = $mdl_contact->getRow('*', $filter);
        $conf['info']['company_extra'] = app::get('base')->model('company_extra')->getList('*', $filter);
        return $conf;
    }

    /*
     * 会员注册页面配置  经营信息
     * @param $pageIndex 配置页面索引
     * return pageSetting array()
     * */
    public function page_manage($uid = null)
    {
        //使用方向  经营场所
        $uid = $uid ? $uid : $this->get_member_id();
        $conf['info'] = app::get('b2c')->getConf('main_products');
        $filter = array('uid' => $uid, 'from' => '0', 'key');
        $conf['info']['manageInfo'] = app::get('base')->model('company_extra')->getList('*', $filter);
        return $conf;
    }

    /*
     * 会员注册页面配置 配送信息
     * @param $pageIndex 配置页面索引
     * return pageSetting array()
     * */
    public function page_delivery()
    {
        //配送信息
        $conf['info'] = app::get('b2c')->getConf('main_products');
        //读取收货时间信息
        $conf['info']['time'] = app::get('b2c')->getConf('receiving_time');
        $filter = array('uid' => $this->get_member_id(), 'from' => '0');
        $conf['info']['deliveryInfo'] = app::get('base')->model('company_extra')->getList('*', $filter);
        return $conf;
    }

}
