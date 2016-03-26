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


class freeze_mdl_freeze extends dbeav_model
{

    public function save(&$data, $mustUpdate = null, $mustInsert = false)
    {
        parent::save($data, $mustUpdate = null, $mustInsert = false);

        //调用接口推送全部最新信息
        $api_data = $this->getRow('*',array('freeze_id',$data['freeze_id']));
        $api_pam_data = app::get('pam')->model('freeze')->getRow('*',array('*',$data['freeze_id']));
        $buyer_id = app::get('freeze')->model('freeze_buyer')->getRow('*',array('buyer_id',$data['freeze_id']));
        $buyer_code = app::get('buyer')->model('buyers')->getRow('buyer_code',array('*',$buyer_id['buyer_id']));
        $api_data['buyer_code'] = $buyer_code['buyer_code']?$buyer_code['buyer_code']:'7010900117';
        $api_data = array_merge($api_data,$api_pam_data);

        //调用接口更新数据
        $rpc_editor = app::get('freeze')->rpc("editor");
        $result = $rpc_editor->request(array('account_data'=>$api_data));
        if(!$result['status'])
        {
            //暂时不做什么处理
        }
        return true;
    }




}
