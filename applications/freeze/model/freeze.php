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
    public function get_account($member_id)
    {
        $data = app::get('pam')->model('members')->getRow("login_account",array('member_id'=>$member_id));
        $buyer_id = app::get('buyer')->model('buyers')->getRow('buyer_id',array('member_id'=>$member_id));
        $buyer_id = $buyer_id['buyer_id'];
//        $object_obj = vmc::singleton('buyer_user_object');
//		$buyer_id = $object_obj->get_id();
        $count = $this->count(array('buyer_id' => $buyer_id));
        $account_name = $data['login_account'];
        if ($count < 10) {
            $account_name .= '0' . ($count + 1);
        } else {
            $account_name .= ($count + 1);
        }

        return $account_name;
    }

    //验证下手机号码

    function check_mobile($mobile)
    {
        $reg = "/^(13[0-9]|147|15[0-9]|17[0|6|7|8]|18[0-9])\d{8}$/";
        if(!preg_match($reg,$mobile))
        {
            return false;
        };
        return $mobile;
    }

    //验证身份证是否有效
    function check_id($IDCard) {
        if (strlen($IDCard) == 18) {
            return $this->check18IDCard($IDCard);
        } elseif ((strlen($IDCard) == 15)) {
            $IDCard = $this->convertIDCard15to18($IDCard);
            return $this->check18IDCard($IDCard);
        } else {
            return false;
        }
    }

    //计算身份证的最后一位验证码,根据国家标准GB 11643-1999
    function calcIDCardCode($IDCardBody) {
        if (strlen($IDCardBody) != 17) {
            return false;
        }

        //加权因子
        $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);
        //校验码对应值
        $code = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');
        $checksum = 0;

        for ($i = 0; $i < strlen($IDCardBody); $i++) {
            $checksum += substr($IDCardBody, $i, 1) * $factor[$i];
        }

        return $code[$checksum % 11];
    }

    // 将15位身份证升级到18位
    function convertIDCard15to18($IDCard) {
        if (strlen($IDCard) != 15) {
            return false;
        } else {
            // 如果身份证顺序码是996 997 998 999，这些是为百岁以上老人的特殊编码
            if (array_search(substr($IDCard, 12, 3), array('996', '997', '998', '999')) !== false) {
                $IDCard = substr($IDCard, 0, 6) . '18' . substr($IDCard, 6, 9);
            } else {
                $IDCard = substr($IDCard, 0, 6) . '19' . substr($IDCard, 6, 9);
            }
        }
        $IDCard = $IDCard . $this->calcIDCardCode($IDCard);
        return $IDCard;
    }

    // 18位身份证校验码有效性检查
    function check18IDCard($IDCard) {
        if (strlen($IDCard) != 18) {
            return false;
        }

        $IDCardBody = substr($IDCard, 0, 17); //身份证主体
        $IDCardCode = strtoupper(substr($IDCard, 17, 1)); //身份证最后一位的验证码

        if ($this->calcIDCardCode($IDCardBody) != $IDCardCode) {
            return false;
        } else {
            return true;
        }
    }


}
