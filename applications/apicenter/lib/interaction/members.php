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
     * @param post_data array
     * @return false | array
     */
    public function card_provide(&$post_data=array()){
        $action = array('ctl'=>'members','act'=>'card_provide');
        $post_url = $this->URL.'card_provide';
        // $post_data = array(
        //     'siteCode'=>'1',
        //     'auth'=>'1',
        //     'loginId'=>1,
        //     'param'=>array(
        //         'userID'=>'d',
        //         'userName'=>'e'
        //         )
        //     );
        $param = $this->request->dbdata($action,$post_data);
        if(is_array($param)){
            $data = $this->request->api_post($post_url,$post_data);
            return $data;
        }
        return false;
    }

    /**
     * 会员卡基本信息查询接口
     *
     * @param post_data array
     * @return false | array
     */
    public function msbasic($post_data=array()){
        $action = array('ctl'=>'members','act'=>'msbasic');
        $post_url = $this->URL.'msbasic';
        $param = $this->request->dbdata($action,$post_data);
        if(is_array($param)){
            $data = $this->request->api_post($post_url,$post_data);
            return $data;
        }
        return false;
    }

    /**
     * 会员卡基本信息查询接口
     *
     * @param msconsume array
     * @return false | array
     */

    public function msconsume($msconsume=array()){
        $action = array('ctl'=>'members','act'=>'msconsume');
        $post_url = $this->URL.'msconsume';
        $param = $this->request->dbdata($action,$post_data);
        if(is_array($param)){
            $data = $this->request->api_post($post_url,$post_data);
            return $data;
        }
        return false;
    }

}