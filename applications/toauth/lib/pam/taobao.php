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


final class toauth_pam_taobao extends toauth_abstract implements toauth_interface
{
    /**
     * login_type 可选值
     *     'local' => '用户名',
     *     'mobile' => '手机号码',
     *     'email' => '邮箱',
     *     'wechat'=>'微信',
     *     'qq'=>'QQ',
     *     'weibo'=>'新浪微博',
     *     'taobao'=>'淘宝',
     *     'baidu'=>'百度',
     *     'alipay'=>'支付宝',
     *     '163'=>'网易',
     *     'renren'=>'人人',
     *     'sohu'=>'搜狐',
     *     'douban'=>'豆瓣',
     *     'kaixin'=>'开心网',
     *     '360'=>'开心网',
     *     'toauth01'=>'合作账户01',
     *     'toauth02'=>'合作账户02',
     *     'toauth03'=>'合作账户03',
     *     'toauth04'=>'合作账户04',
     *     'toauth04'=>'合作账户05'.
     */
    public $login_type = 'taobao';

    public $name = '淘宝信任登录';
    public $version = '';

    /**
     * 构造方法.
     *
     * @param null
     *
     * @return bool
     */
    public function __construct($app)
    {
        parent::__construct($app);
        if (!$this->login_type) {
            trigger_error('login_type 未定义!', E_USER_ERROR);
        }
        $this->callback_url = vmc::openapi_url('openapi.toauth', 'callback', array(
            __CLASS__ => 'callback',
        ));
    }
    /**
     * 后台配置参数设置.
     *
     * @param null
     *
     * @return array 配置参数列表
     */
    public function setting()
    {
        return array(
            'display_name' => array(
                'title' => '信任登录名称' ,
                'type' => 'text',
                'default' => $this->name
            ) ,
            'order_num' => array(
                'title' => '排序' ,
                'type' => 'number',
                'default' => 0,
            ) ,
            /*个性化字段开始*/
            'app_id' => array(
                'title' => 'client_id' ,
                'type' => 'text',
            ) ,
            'app_secret' => array(
                'title' => 'client_secret' ,
                'type' => 'text',
            ) ,
            'redirect_uri'=>array(
                'title'=>'redirect_uri(回调地址)',
                'type'=>'textarea',
                'default'=>$this->callback_url,
                'readonly'=>'true'
            ),
            /*个性化字段结束*/
            'status' => array(
                'title' => '是否开启' ,
                'type' => 'radio',
                'options' => array(
                    'true' => '是' ,
                    'false' => '否' ,
                ) ,
                'default' => 'true',
            ),

        );
    }

    public function authorize_url()
    {
        $app_id = $this->getConf('app_id', __CLASS__);
        $app_secret = $this->getConf('app_secret', __CLASS__);
        $redirect_uri = $this->callback_url;
        //state=STATE 在前台会被跟踪替换成state=$forward;
        $url = "https://oauth.taobao.com/authorize?response_type=code&client_id=$app_id&redirect_uri=$redirect_uri&state=STATE";
        //手机中
        if (base_mobiledetect::is_mobile()) {
            return $url.= '&view=wap';
        }
        return $url;
    }
    /**
     * 同步跳转处理.
     *
     * @see /applications/toauth/lib/api.php
     * @params array - 所有第三方回调参数，包括POST和GET
     */
    public function callback(&$params)
    {
        $code = $params['code'];
        $forward = $params['state']; //最终转向目标
        //获得token
        $userinfo = $this->get_token($code, $error_msg);
        if ($error_msg) {
            die($error_msg);
        }

        if ($error_msg) {
            die($error_msg);
        }
        $cur_time = time();
        /*
         * 会员SDF
         */
        $member_sdf = array(
            'addon' => serialize($userinfo),//信任登录返回数据
            'concat'=>array(
                'name' => urldecode($userinfo['taobao_user_nick']), //昵称
            ),
            'pam_account' => array(//会员登录账号信息
                'openid'=>$userinfo['openid'],
                'login_account' => 'wx_'.substr(md5($userinfo['openid']),-5), //OPEN账号名
                'login_type' => $this->login_type,//登录类型
                'login_password' => md5($cur_time),//自动密码
                'password_account' => $userinfo['openid'],//用唯一openid ，微信unionid是跨应用唯一
                'createtime' => $cur_time//账号创建时间
            ),
            'regtime' => $cur_time, //会员注册时间
            'source' => 'api', //注册方式
            'reg_ip' => base_request::get_remote_addr(), //注册来源IP
        );
        //call abstract method
        $member_id = $this->dologin($member_sdf, $error_msg);
        if ($member_id) {
            if (!$forward) {
                $app = base_mobiledetect::is_mobile() ? 'mobile' : 'site';
                $forward = app::get($app)->router(array(
                    'app' => $app,
                    'ctl' => 'index',
                    'full' => 1,
                ));
            }
            header('Location: '.$forward);
        } else {
            die($error_msg);
        }
    }

    /**
     * 根据用户授权的code 获得access_token.
     */
    private function get_token($code, &$msg)
    {
        $this->app_id = $app_id = $this->getConf('app_id', __CLASS__);
        $app_secret = $this->getConf('app_secret', __CLASS__);
        $action_url = "https://oauth.taobao.com/token";
        $query = array(
            'grant_type' => 'authorization_code',
            'client_id' => $app_id,
            'client_secret' => $app_secret,
            'code' => $code,
            'redirect_uri' => $this->callback_url
        );
        $http_client = vmc::singleton('base_httpclient');
        $res = $http_client->get($action_url,$query);
        $res_arr = json_decode($res,1);
        if (!$res_arr['taobao_user_id']) {
            $msg = 'access_token获取失败!'.$res['errmsg'];
            return false;
        }
        $res_arr['openapi'] = $res_arr['taobao_user_id'];
        return $res_arr;
    }



}
