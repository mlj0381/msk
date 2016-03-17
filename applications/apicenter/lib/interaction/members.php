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

/**
 * 接口会员相关信息
 */
class apicenter_interaction_members
{
    private $URL;
    private $request;
    public function __construct()
    {
        header("Content-type:text/html;charset=utf-8");
        $this->URL = 'msk-web/api/v1/ms/';
        $this->request = vmc::singleton('apicenter_api');
    }

    /**
     * 会员发卡
     *
     * @param siteCode Integer Y 例如：平台区分：1神农客平台；2美侍客平台；3大促会平台
     * @param auth     String  Y 分配给各个平台的身份识别码   MSK00001
     * @param loginId  String    登陆的用户ID msk01
     * @param param    Object    业务参数    
     * @param userID   String  Y 买家用户登录ID    
     * @param userName String  Y 买家用户名称 
     * @return false | array
     */
    public function card_provide($data=array()){
        $post_url = $this->URL.'card_provide';

        $post_data = array(
            'siteCode'=>'102',
            'auth'=>'',
            'DateTime'=>'2016-03-15 18:00:00'
            );
        $data = $this->request->api_post($post_url,$post_data);
        //var_dump($post_data,$data);exit;
        return $data;
    }

}