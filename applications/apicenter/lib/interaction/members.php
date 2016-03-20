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
 * 会员相关
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
     *        ->   
     * @param   userID   String  Y 买家用户登录ID    
     * @param   userName String  Y 买家用户名称 
     *   
     * @return false | array
     */
    public function card_provide(&$post_data=array()){
        $action = array('ctl'=>'members','act'=>'card_provide');
        $post_url = $this->URL.'card_provide';
        $post_data = array('siteCode'=>'1','auth'=>'1','loginId'=>1,'param'=>array('userID'=>'d','userName'=>'e'));
        $param = $this->request->dbdata($action,$post_data);
        if(is_array($param)){
            $data = $this->request->api_post($post_url,$post_data);
            var_dump($data,$post_data);exit;
            return $data;
        }
        return false;
    }

    /**
     * 会员卡基本信息查询接口
     *
     * @param siteCode  Integer  Y   例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台 1
     * @param auth      String   Y   分配给各个平台的身份识别码   MSK00001
     * @param loginId   String          登陆的用户ID msk01
     * @param param     Object          业务参数
     *        ->
     * @param   userID    String     Y   查询用户的用户ID
     *   
     * @return false | array
     */
    public function msbasic($post_data=array()){
        $post_url = 'msk-web/api/v1/by/account/register';//$this->URL.'msbasic';

        $post_data = array(
            'siteCode' => 1,
            'auth' => 'MSK00001',
            'param' => array(
                'telNo' => '1234567891'
                )
            );
        $data = $this->request->api_post($post_url,$post_data);
        var_dump($post_data,$data);exit;
        return $data;
    }

    /**
     * 会员卡基本信息查询接口
     *
     * @param siteCode Integer     Y   例如：平台区分：1：神农客平台；2：美侍客平台；3：大促会平台 1
     * @param auth    String      Y   分配给各个平台的身份识别码   MSK00001
     * @param loginId String          登陆的用户ID msk01
     * @param param   Object          业务参数
     *        ->
     * @param   userID    String      Y   查询用户的用户ID   
     * @param   startDate     Datetime        Y   查询开始日期  
     * @param   endDate   Datetime        Y   查询结束日期
     *        
     * @return false | array
     */

    public function msconsume($post_data=array()){
        $post_url = $this->URL.'msconsume';

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