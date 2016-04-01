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
        $api_data = $this->getRow('*',array('freeze_id'=>$data['freeze_id']));
        $api_pam_data = app::get('pam')->model('freeze')->getRow('*',array('freeze_id'=>$data['freeze_id']));
        $buyer_code = app::get('buyer')->model('buyers')->getRow('buyer_code',array('buyer_id'=>$api_data['buyer_id']));
        $api_data['buyer_code'] = $buyer_code['buyer_code']?$buyer_code['buyer_code']:'7010900155';
        $api_data = array_merge($api_data,$api_pam_data);
        $mdl_ectools = app::get('ectools')->model('regions');
        $area_code = $mdl_ectools->region_decode($api_data['manage_area']);
        $api_data['province_code'] = $area_code['province']['code'];
        $api_data['city_code'] = $area_code['city']['code'];
        $api_data['district_code'] = $area_code['district']['code'];
        $v_area_code = $mdl_ectools->region_decode($api_data['area']);
        $api_data['v_province_code'] = $v_area_code['province']['code'];
        $api_data['v_city_code'] = $v_area_code['city']['code'];
        $api_data['v_district_code'] = $v_area_code['district']['code'];

        if(empty($api_data['code']))
        {
            unset($api_data['code']);
        }

        //调用接口更新数据
        $rpc_editor = app::get('freeze')->rpc("editor");
        $result = $rpc_editor->request(array('account_data'=>$api_data));
        if(!empty($result['status']) && !empty($result['result']['account']) && !empty($result['result']['code']))
        {
            $this->update(array( 'account' => $result['result']['account'], 'code' => $result['result']['code']),array('freeze_id' => $data['freeze_id']));
        }
        return true;
    }



    /**
     * 得到管家账号
     */
    public function get_account($buyer_id)
    {

        $data = app::get('pam')->model('buyers')->getRow("login_account",array('buyer_id'=>$buyer_id));
        $count = $this->count(array('buyer_id' => $buyer_id));
        $account_name = $data['login_account'];
        if ($count < 10) {
            $account_name .= '0' . ($count + 1);
        } else {
            $account_name .= ($count + 1);
        }

        return $account_name;
    }


}
